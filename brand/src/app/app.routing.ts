import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';

import{ HomeLayoutComponent } from './layout/home-layout/home-layout.component';
import{ AppLayoutComponent } from './layout/app-layout/app-layout.component';

import { HomeComponent } from './home/home.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { NotFoundComponent } from './not-found.component';

const routes: Routes = [
    // Home routes
    {
        path: '',
        component: HomeLayoutComponent,
        children: [
            { path: '', component: HomeComponent, pathMatch: 'full' }
        ]
    },

    // App routes
    {
        path: '',
        component: AppLayoutComponent,
        children: [
            { path: 'dashboard', component: DashboardComponent }
        ]
    },

    // Not-found routes
    {
        path: '**',
        component: NotFoundComponent
    }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})

export class AppRoutingModule {

}