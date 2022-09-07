import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { User } from 'src/app/@core/models/user';
import { AuthService } from 'src/app/@core/services/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss'],
})
export class RegisterComponent {
  authForm: FormGroup = new FormGroup({
    name: new FormControl('', [Validators.required]),
    email: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
  });

  constructor(
    private authService: AuthService,
    private toastr: ToastrService,
    private router: Router
  ) {}

  register() {
    const payload: User = {
      ...this.authForm.value,
    };

    this.authService.register(payload).subscribe({
      next: (value) => {
        this.toastr.success(value.message, 'Registro');
        this.router.navigateByUrl('/auth/login');
      },
      error: (error) => {
        console.error(error);
      },
    });
  }
}
