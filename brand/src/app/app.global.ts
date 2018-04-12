import { Injectable } from '@angular/core';

@Injectable()

export class AppGlobal {
    readonly baseAppUrl: String = 'http://localhost:8098/';
    readonly baseApiUrl: String = 'http://localhost/20sections/api/v1/';
}