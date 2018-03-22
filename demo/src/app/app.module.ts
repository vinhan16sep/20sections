import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from "@angular/forms";
import { HttpModule } from "@angular/http";
import { routing } from "./app.routing";


import { AppComponent } from './app.component';
import { DemoComponent } from './demo/demo.component';
import { NewDemoComponent } from './new-demo/new-demo.component';
import { DemosComponent } from './demos/demos.component';
import { DemoService } from "./demo.service";


@NgModule({
    declarations: [
        AppComponent,
        DemoComponent,
        NewDemoComponent,
        DemosComponent
    ],
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        routing
    ],
    providers: [DemoService],
    bootstrap: [AppComponent]
})
export class AppModule {
}
