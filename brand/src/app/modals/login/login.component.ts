import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';

import { AppGlobal } from '../../app.global';

import { UserService } from './../../user/user.service';

import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { Router } from "@angular/router";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss'],
    providers: [AppGlobal]
})
export class LoginComponent implements OnInit {

    closeResult: string;
    modalReference: any;

    constructor(private modalService: NgbModal, private appGlobal: AppGlobal, private userService: UserService, private router: Router) {
    }

    ngOnInit() {
    }

    open(content) {
        this.modalReference = this.modalService.open(content, {size: 'lg'})
        this.modalReference.result.then((result) => {
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
            return `with: ${reason}`;
        }
    }

    onLogin(form: NgForm) {
        this.userService.login(this.appGlobal.baseApiUrl, form.value.email, form.value.password)
            .subscribe(
                (tokenData) => {
                    this.modalReference.dismiss();

                    if (this.userService.getToken() === tokenData.token) {
                        this.router.navigate(['/dashboard']);
                    }else{
                        this.router.navigate(['']);
                    }
                },
                (error) => {
                    this.modalReference.dismiss();
                    console.log(error);
                }
            );
    }


}
