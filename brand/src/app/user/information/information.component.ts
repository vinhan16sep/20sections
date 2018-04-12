import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { UserService } from "../user.service";

import { AppGlobal } from '../../app.global';

@Component({
    selector: 'app-information',
    templateUrl: './information.component.html',
    styleUrls: ['./information.component.scss'],
    providers: [AppGlobal]
})
export class InformationComponent implements OnInit {

    private info: any;

    constructor(private router: Router, private appGlobal: AppGlobal, private userService: UserService) {
    }

    ngOnInit() {
        if (!this.userService.checkLoggedIn()) {
            this.router.navigate(['']);
        }

        this.userService.getPersonalInformation(this.appGlobal.baseApiUrl)
            .subscribe(
                data => {this.info = data},
                error => {
                    if(error){
                        this.router.navigate(['']);
                    }
                }
            );

    }

}
