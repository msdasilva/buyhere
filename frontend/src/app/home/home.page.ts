import { Component } from "@angular/core";
import { NavController } from "@ionic/angular";
import { HTTP } from '@ionic-native/http/ngx';


@Component({
  selector: "app-home",
  templateUrl: "home.page.html",
  styleUrls: ["home.page.scss"]
})
export class HomePage {
  constructor(public navCtrl: NavController, private http: HTTP) {}
}
