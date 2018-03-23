import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from "@angular/http";

import { DashboardModule } from "./dashboard/dashboard.module";
import { UserModule } from "./user/user.module";
import { AppRoutingModule } from "./app.routing";

import { AppComponent } from './app.component';
import { NotFoundComponent } from './not-found.component';

import { UserService } from './user/user.service';
import { HomeComponent } from './home/home.component';

@NgModule({
    declarations: [
        AppComponent,
        NotFoundComponent,
        HomeComponent
    ],
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        DashboardModule,
        UserModule,
        AppRoutingModule,
    ],
    providers: [UserService],
    bootstrap: [AppComponent]
})

export class AppModule {
}
