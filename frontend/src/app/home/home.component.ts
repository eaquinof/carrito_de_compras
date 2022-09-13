import { Component, OnInit } from '@angular/core';
import { AuthService } from '../@core/services/auth.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss'],
})
export class HomeComponent implements OnInit {
  public usuarioLogueado:string = "nouser"
  constructor(
    public authService: AuthService
  ) {
    if(this.authService.bIslogin)
    this.usuarioLogueado = <string>localStorage.getItem("user")

  }

  ngOnInit(): void {}

  logout(){
    
    this.authService.bIslogin = false;
    localStorage.clear();
    
  }
}
