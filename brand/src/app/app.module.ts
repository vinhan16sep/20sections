import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { DashboardModule } from "./dashboard/dashboard.module";
import { TeamsModule } from './teams/teams.module';
import { PlayersModule } from './players/players.module';
import { AppRoutingModule } from "./app.routing";

import { AppComponent } from './app.component';
import { NotFoundComponent } from './not-found.component';

@NgModule({
    declarations: [
        AppComponent,
        NotFoundComponent,
    ],
    imports: [
        BrowserModule,
        FormsModule,
        DashboardModule,
        TeamsModule,
        PlayersModule,
        AppRoutingModule,
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule {
}
