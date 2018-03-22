import { ModuleWithProviders } from "@angular/core";
import { RouterModule, Routes } from "@angular/router";

import { DemosComponent } from "./demos/demos.component";
import { NewDemoComponent } from "./new-demo/new-demo.component";

const APP_ROUTES: Routes = [
    {path: '', component: DemosComponent},
    {path: 'new-demo', component: NewDemoComponent},
];

export const routing: ModuleWithProviders = RouterModule.forRoot(APP_ROUTES);