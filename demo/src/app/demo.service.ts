import { Injectable } from "@angular/core";
import { Http, Response, Headers } from "@angular/http";
import 'rxjs/Rx';
import { Observable } from "rxjs";

import { AuthService } from "./auth.service";

@Injectable()
export class DemoService {
    constructor(private http: Http, private authService: AuthService) {

    }

    addDemo(content: string) {
        const token = this.authService.getToken();
        const body = JSON.stringify({content: content});
        const headers = new Headers({
            'Content-Type': 'application/json'
        });
        return this.http.post('http://localhost/20sections/api/demo?token=' + token, body, {headers: headers});
    }

    getDemos(): Observable<any> {
        return this.http.get('http://localhost/20sections/api/demos')
            .map(
                (response: Response) => {
                    return response.json().demos
                }
            )
    }

    updateDemo(id: number, newContent: string) {
        const token = this.authService.getToken();
        const body = JSON.stringify({content: newContent});
        const headers = new Headers({
            'Content-Type': 'application/json'
        });

        return this.http.put('http://localhost/20sections/api/demo/' + id + '?token=' + token, body, {headers: headers})
            .map(
                (response: Response) => response.json()
            );
    }

    deleteDemo(id: number) {
        const token = this.authService.getToken();

        return this.http.delete('http://localhost/20sections/api/demo/' + id + '?token=' + token);
    }
}