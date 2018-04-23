import { Component, OnInit } from '@angular/core';

declare var $:any;

export interface RouteInfo {
    path: string;
    title: string;
    icon: string;
    class: string;
}

export const ROUTES: RouteInfo[] = [
    { path: 'dashboard', title: 'Dashboard',  icon: 'ti-panel', class: '' },
    { path: 'user', title: 'User Profile',  icon:'ti-user', class: '' },
    { path: 'table', title: 'Table List',  icon:'ti-view-list-alt', class: '' },
    { path: 'typography', title: 'Typography',  icon:'ti-text', class: '' },
    { path: 'icons', title: 'Icons',  icon:'ti-pencil-alt2', class: '' },
    { path: 'maps', title: 'Maps',  icon:'ti-map', class: '' },
    { path: 'notifications', title: 'Notifications',  icon:'ti-bell', class: '' }
];

@Component({
    selector: 'app-app-sidebar',
    templateUrl: './app-sidebar.component.html',
    styleUrls: ['./app-sidebar.component.scss']
})
export class AppSidebarComponent implements OnInit {

    constructor() {
    }

    public menuItems: any[];

    ngOnInit() {
        this.menuItems = ROUTES.filter(menuItem => menuItem);
    }

    isNotMobileMenu() {
        if (window.innerWidth > 991) {
            return false;
        }
        return true;
    }
}
