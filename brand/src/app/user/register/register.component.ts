import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';

import { UserService } from "../user.service";

import { AppGlobal } from '../../app.global';

@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.scss'],
    providers: [AppGlobal]
})
export class RegisterComponent implements OnInit {

    constructor(private appGlobal: AppGlobal, private userService: UserService) {
    }

    ngOnInit() {
    }

    onRegister(form: NgForm) {
        this.userService.register(this.appGlobal.baseApiUrl, form.value.username, form.value.email, form.value.password)
            .subscribe(
                response => console.log(response),
                error => console.log(error)
            );
    }

}
