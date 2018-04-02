import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from "@angular/http";

import { NgbActiveModal, NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { DashboardModule } from "./dashboard/dashboard.module";
import { UserModule } from "./user/user.module";
import { AppRoutingModule } from "./app.routing";

import { AppComponent } from './app.component';
import { NotFoundComponent } from './not-found.component';

import { UserService } from './user/user.service';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './modals/login/login.component';
import { AppLayoutComponent } from './layout/app-layout/app-layout.component';
import { AppHeaderComponent } from './layout/app-header/app-header.component';
import { HomeLayoutComponent } from './layout/home-layout/home-layout.component';
import { HomeHeaderComponent } from './layout/home-header/home-header.component';
import { HomeFooterComponent } from './layout/home-footer/home-footer.component';

@NgModule({
    declarations: [
        AppComponent,
        NotFoundComponent,
        HomeComponent,
        LoginComponent,
        AppLayoutComponent,
        AppHeaderComponent,
        HomeLayoutComponent,
        HomeHeaderComponent,
        HomeFooterComponent
    ],
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        NgbModule.forRoot(),
        DashboardModule,
        UserModule,
        AppRoutingModule,
    ],
    providers: [UserService, NgbActiveModal],
    bootstrap: [AppComponent]
})

export class AppModule {
}
