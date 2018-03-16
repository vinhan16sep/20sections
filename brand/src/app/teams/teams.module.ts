import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { TeamsRoutingModule } from './teams.routing';
import { TeamListComponent } from './team-list/team-list.component';

@NgModule({
    imports: [BrowserModule, FormsModule, TeamsRoutingModule],
    declarations: [TeamListComponent]
})

export class TeamsModule {

}