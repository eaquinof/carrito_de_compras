import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { User, UserResponse } from '../models/user';
import { BaseService } from './base.service';

@Injectable({
  providedIn: 'root',
})
export class AuthService extends BaseService {
  constructor(private readonly httpClient: HttpClient) {
    super();
  }

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
