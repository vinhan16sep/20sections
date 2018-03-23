import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from "@angular/http";

import { DashboardModule } from "./dashboard/dashboard.module";
import { TeamsModule } from './teams/teams.module';
import { PlayersModule } from './players/players.module';
import { UserModule } from "./user/user.module";
import { AppRoutingModule } from "./app.routing";

import { AppComponent } from './app.component';
import { NotFoundComponent } from './not-found.component';

import { UserService } from './user/user.service';

@NgModule({
    declarations: [
        AppComponent,
        NotFoundComponent
    ],
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        DashboardModule,
        TeamsModule,
        PlayersModule,
        UserModule,
        AppRoutingModule,
    ],
    providers: [UserService],
    bootstrap: [AppComponent]
})

export class AppModule {
}
