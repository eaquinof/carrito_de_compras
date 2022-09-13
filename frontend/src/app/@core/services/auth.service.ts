import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { User, UserResponse } from '../models/user';
import { BaseService } from './base.service';

@Injectable({
  providedIn: 'root',
})

export class AuthService extends BaseService {
  constructor(private readonly httpClient: HttpClient) {
    super();
    if(localStorage.getItem("user"))
    this.bIslogin = true
  }
  public bIslogin = false;
  register(user: User): Observable<UserResponse> {
    return this.httpClient.post<UserResponse>(
      `${this.BASE_URL}/auth/register`,
      user
    );
  }

  login(user: User): Observable<UserResponse> {
    return this.httpClient.post<UserResponse>(
      `${this.BASE_URL}/auth/login`,
      user
    );
  }
}
