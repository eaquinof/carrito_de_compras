import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { User } from 'src/app/@core/models/user';
import { AuthService } from 'src/app/@core/services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent {
  authForm: FormGroup = new FormGroup({
    email: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
  });

  constructor(private authService: AuthService, private router: Router) {}

  login() {
    const payload: User = {
      ...this.authForm.value,
    };

    this.authService.login(payload).subscribe({
      next: (value) => {
        // mandar al login o retornar el token en el backend
        // y ponerlo como header, o en todo caso usar un interceptor de angular
        // el value de aqui trae el access_token (revisar interface
        // UserResponse)
        console.log(value);
        this.router.navigateByUrl('/');
      },
      error: (error) => {
        // validar errores, mostrar un alert
        console.error(error);
      },
    });
  }
}
