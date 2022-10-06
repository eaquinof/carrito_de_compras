import { environment } from 'src/environments/environment';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/@core/services/auth.service';
import { ProductosService } from '../productos.service';

@Component({
  selector: 'app-productos-list',
  templateUrl: './productos-list.component.html',
  styleUrls: ['./productos-list.component.scss']
})
export class ProductosListComponent implements OnInit {
  public productos : any
  public usuarioLogueado:string = "nouser"
  public images:string = `${environment.url_storage}/images`
  constructor(
    public authService: AuthService,
    public router: Router,
    public productservice: ProductosService) {
      if(this.authService.bIslogin)
      this.usuarioLogueado = <string>localStorage.getItem("user")
     }

  ngOnInit(): void {
    this.productservice.get().subscribe(
      response =>{
        console.log(response)
        this.productos = response.productos
      },
      error =>{
        console.error(error)
      }
    )
  }

  logout(){

    this.authService.bIslogin = false;
    localStorage.clear();
    this.router.navigateByUrl('/');

  }

}
