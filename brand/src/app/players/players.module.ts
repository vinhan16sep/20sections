import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { PlayersRoutingModule } from "./players.routing";
import { PlayerListComponent } from "./player-list/player-list.component";

import { CommonModule } from '../common/common.module';

@NgModule({
    imports: [BrowserModule, FormsModule, CommonModule, PlayersRoutingModule],
    declarations: [PlayerListComponent]
})

export class PlayersModule {
}
