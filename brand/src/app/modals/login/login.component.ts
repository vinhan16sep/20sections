import { Component, OnInit } from '@angular/core';
import {NgForm} from '@angular/forms';

import {UserService} from './../../user/user.service';

import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

    closeResult: string;

    constructor(private modalService: NgbModal, private userService: UserService) {
    }

    ngOnInit() {
    }

    open(content) {
        this.modalService.open(content, {size: 'lg'}).result.then((result) => {
            this.closeResult = `Closed with: ${result}`;
        }, (reason) => {
            this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
        });
    }

    private getDismissReason(reason: any): string {
        if (reason === ModalDismissReasons.ESC) {
            return 'by pressing ESC';
        } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
            return 'by clicking on a backdrop';
        } else {
            return  `with: ${reason}`;
        }
    }

    onLogin(form: NgForm) {
        this.userService.login(form.value.email, form.value.password)
            .subscribe(
                tokenData => console.log(tokenData),
                error => console.log(error)
            );

        // window.location.href='http://localhost:8098/dashboard';
    }


}
