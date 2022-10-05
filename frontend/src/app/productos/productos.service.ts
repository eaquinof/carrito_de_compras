import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
@Injectable({
  providedIn: 'root'
})
export class ProductosService {
  readonly BASE_URL = environment.url_api;
  constructor(private readonly httpClient: HttpClient) { }

  get(): Observable<any> {
    return this.httpClient.get(
      `${this.BASE_URL}/producto`,
      
    );
  }

  getbyId(id:any): Observable<any> {
    return this.httpClient.get(
      `${this.BASE_URL}/producto/${id}`,
      
    );
  }
}
