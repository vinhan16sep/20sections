import { Component, OnInit } from '@angular/core';
import { Demo } from "../demo.interface";
import { DemoService } from "../demo.service";

@Component({
    selector: 'app-demos',
    templateUrl: './demos.component.html',
    styleUrls: ['./demos.component.css']
})
export class DemosComponent implements OnInit {

    demos: Demo[];

    constructor(private demoService: DemoService) {
    }

    ngOnInit() {
    }

    onGetDemos() {
        this.demoService.getDemos()
            .subscribe(
                (demos: Demo[]) => this.demos = demos,
                (error: Response) => console.log(error)
            )
    }

    onDeleted(demo: Demo) {
        const position = this.demos.findIndex(
            (demoEl: Demo) => {
                return demoEl.id == demo.id;
            }
        );

        this.demos.splice(position, 1);
    }
}
