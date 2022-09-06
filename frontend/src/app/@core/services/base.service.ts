import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class BaseService {
  readonly BASE_URL = environment.url_api;

  constructor() {}
}
