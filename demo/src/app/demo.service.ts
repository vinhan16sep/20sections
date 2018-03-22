import { Injectable } from "@angular/core";
import { Http, Response, Headers } from "@angular/http";
import 'rxjs/Rx';
import { Observable } from "rxjs";

@Injectable()
export class DemoService {
    constructor(private http: Http) {

    }

    addDemo(content: string) {
        const body = JSON.stringify({
            content: content
        });

        const headers = new Headers({
            'Content-Type': 'application/json'
        });
        return this.http.post('http://localhost/20sections/api/demo', body, {headers: headers});
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
        const body = JSON.stringify({
            content: newContent
        });

        const headers = new Headers({
            'Content-Type': 'application/json'
        });

        return this.http.put('http://localhost/20sections/api/demo/' + id, body, {headers: headers})
            .map(
                (response: Response) => response.json()
            );
    }

    deleteDemo(id: number) {
        return this.http.delete('http://localhost/20sections/api/demo/' + id);
    }
}