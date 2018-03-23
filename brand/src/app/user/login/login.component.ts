import { Component, OnInit } from '@angular/core';
import { NgForm } from "@angular/forms";

import { UserService } from "../user.service";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

    constructor(private userService: UserService) {
    }

    ngOnInit() {
    }

    onLogin(form: NgForm) {
        this.userService.login(form.value.email, form.value.password)
            .subscribe(
                tokenData => console.log(tokenData),
                error => console.log(error)
            );
    }
}
