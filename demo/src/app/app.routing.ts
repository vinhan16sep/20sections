import { ModuleWithProviders } from "@angular/core";
import { RouterModule, Routes } from "@angular/router";

import { DemosComponent } from "./demos/demos.component";
import { NewDemoComponent } from "./new-demo/new-demo.component";
import { SignupComponent } from "./signup/signup.component";
import { SigninComponent } from "./signin/signin.component";

const APP_ROUTES: Routes = [
    {path: '', component: DemosComponent},
    {path: 'new-demo', component: NewDemoComponent},
    {path: 'signup', component: SignupComponent},
    {path: 'signin', component: SigninComponent},
];

export const routing: ModuleWithProviders = RouterModule.forRoot(APP_ROUTES);