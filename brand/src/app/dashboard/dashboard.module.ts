import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

// import { DashboardRoutingModule } from './dashboard.routing';
import { DashboardComponent } from './dashboard.component';

@NgModule({
    imports: [BrowserModule, FormsModule],
    declarations: [DashboardComponent]
})

export class DashboardModule {

}