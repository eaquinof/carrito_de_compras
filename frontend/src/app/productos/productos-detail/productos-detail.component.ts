import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/@core/services/auth.service';
import { ActivatedRoute } from '@angular/router';
import { ProductosService } from '../productos.service';
@Component({
  selector: 'app-productos-detail',
  templateUrl: './productos-detail.component.html',
  styleUrls: ['./productos-detail.component.scss']
})
export class ProductosDetailComponent implements OnInit {
  public usuarioLogueado:string = "nouser"
  public product : any
  constructor(public authService: AuthService, public router: Router, 
    private _Activatedroute:ActivatedRoute,
    public productservice: ProductosService) {
    if(this.authService.bIslogin)
    this.usuarioLogueado = <string>localStorage.getItem("user")

    const id=this._Activatedroute.snapshot.paramMap.get("id");
    this.productservice.getbyId(id).subscribe(
      response =>{
        console.log(response)
        this.product = response.producto[0]
      },
      error =>{
        console.error(error)
      }
    )
   }

  ngOnInit(): void {
  }

  logout(){
    
    this.authService.bIslogin = false;
    localStorage.clear();
    this.router.navigateByUrl('/');
    
  }

}
