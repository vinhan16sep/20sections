import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { DemoService } from "../demo.service";

@Component({
    selector: 'app-new-demo',
    templateUrl: './new-demo.component.html',
    styleUrls: ['./new-demo.component.css']
})
export class NewDemoComponent implements OnInit {

    constructor(private demoService: DemoService) {
    }

    ngOnInit() {
    }

    onSubmit(form: NgForm) {
        this.demoService.addDemo(form.value.content)
            .subscribe(
                () => alert('Demo created')
            );

        form.reset();
    }
}
