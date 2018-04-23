import { Component, OnInit } from '@angular/core';
import { NgForm } from "@angular/forms";

import { UserService } from "../user.service";

import { AppGlobal } from '../../app.global';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss'],
    providers: [AppGlobal]
})
export class LoginComponent implements OnInit {

    constructor(private appGlobal: AppGlobal, private userService: UserService) {
    }

    ngOnInit() {
    }

    onLogin(form: NgForm) {
        this.userService.login(this.appGlobal.baseApiUrl, form.value.email, form.value.password)
            .subscribe(
                tokenData => console.log(tokenData),
                error => console.log(error)
            );
    }
}
