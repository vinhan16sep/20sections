import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { UserRoutingModule } from './user.routing';
import { RegisterComponent } from './register/register.component';
import { LoginComponent } from './login/login.component';

import { CommonModule } from '../common/common.module';
import { InformationComponent } from './information/information.component';

@NgModule({
    imports: [BrowserModule, FormsModule, CommonModule, UserRoutingModule],
    declarations: [RegisterComponent, LoginComponent, InformationComponent]
})

export class UserModule {
}
