import { Component, OnInit } from '@angular/core';
import { UserService } from "../user/user.service";
import { Router } from "@angular/router";

@Component({
    selector: 'app-dashboard',
    templateUrl: './dashboard.component.html',
    styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

    constructor(private userService: UserService, private router: Router) {
    }

    ngOnInit() {
        if (!this.userService.checkLoggedIn()) {
            this.router.navigate(['']);
        }
    }

}
