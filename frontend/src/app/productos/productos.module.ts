import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ProductosRoutingModule } from './productos-routing.module';
import { ProductosListComponent } from './productos-list/productos-list.component';
import { ProductosDetailComponent } from './productos-detail/productos-detail.component';
import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { BackEndTokenInterceptor } from '../back-end-token.interceptor';


@NgModule({
  declarations: [
    ProductosListComponent,
    ProductosDetailComponent
  ],
  imports: [
    CommonModule,
    ProductosRoutingModule
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: BackEndTokenInterceptor,
      multi: true,
    },
  ]
})
export class ProductosModule { }
