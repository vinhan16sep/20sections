import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';

import { UserService } from "../user.service";

@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

    constructor(private userService: UserService) {
    }

    ngOnInit() {
    }

    onRegister(form: NgForm) {
        this.userService.register(form.value.username, form.value.email, form.value.password)
            .subscribe(
                response => console.log(response),
                error => console.log(error)
            );
    }

}
