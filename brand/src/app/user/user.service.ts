import { Injectable } from "@angular/core";
import { Headers, Http, Response } from '@angular/http';
import { Observable } from "rxjs";
import 'rxjs/Rx';

@Injectable()

export class UserService {

    constructor(private http: Http) {

    }

    register(baseApiUrl, username: string, email: string, password: string) {
        return this.http.post(baseApiUrl + 'brand-register',
            {name: username, email: email, password: password},
            {headers: new Headers({'X-Requested-With': 'XMLHttpRequest'})});
    }

    login(baseApiUrl, email: string, password: string) {
        return this.http.post(baseApiUrl + 'brand-login',
            {email: email, password: password},
            {headers: new Headers({'X-Requested-With': 'XMLHttpRequest'})})
            .map(
                (response: Response) => {
                    const token = response.json().token;
                    const base64Url = token.split('.')[1];
                    const base64 = base64Url.replace('-', '+').replace('_', '/');
                    return {token: token, decoded: JSON.parse(window.atob(base64))};
                }
            )
            .do(
                tokenData => {
                    localStorage.setItem('token', tokenData.token);
                }
            );
    }

    getToken() {
        return localStorage.getItem('token');
    }

    checkLoggedIn() {
        if (!this.getToken()) {
            return false;
        }
        return true;
    }

    getPersonalInformation(baseApiUrl): Observable<any> {
        return this.http.get(baseApiUrl + 'personal-information?token=' + this.getToken())
            .map(
                (response: Response) => {
                    return response.json().data;
                }
            )
    }
}