import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ProductosDetailComponent } from './productos-detail/productos-detail.component';
import { ProductosListComponent } from './productos-list/productos-list.component';

const routes: Routes = [
  {
    path: 'list',
    component: ProductosListComponent,
  },
  {
    path: 'detail/:id',
    component: ProductosDetailComponent,
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ProductosRoutingModule { }
