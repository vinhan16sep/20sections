import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { Demo } from "../demo.interface";
import { DemoService } from "../demo.service";

@Component({
    selector: 'app-demo',
    templateUrl: './demo.component.html',
    styleUrls: ['./demo.component.css']
})
export class DemoComponent implements OnInit {

    @Input() demo: Demo;
    @Output() demoDeleted = new EventEmitter<Demo>();

    editing = false;
    editValue = '';

    constructor(private demoService: DemoService) {
    }

    ngOnInit() {
    }

    onEdit() {
        this.editing = true;
        this.editValue = this.demo.content;
    }

    onUpdate() {
        this.demoService.updateDemo(this.demo.id, this.editValue)
            .subscribe(
                (demo: Demo) => {
                    this.demo.content = this.editValue;
                    this.editValue = '';
                }
            );
        this.editing = false;
    }

    onCancel() {
        this.editValue = '';
        this.editing = false;
    }

    onDelete() {
        this.demoService.deleteDemo(this.demo.id)
            .subscribe(
                () => {
                    this.demoDeleted.emit(this.demo);
                    console.log('Demo deleted');
                }
            );
    }
}