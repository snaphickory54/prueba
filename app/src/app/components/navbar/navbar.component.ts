import { Component, OnInit } from '@angular/core';
import {LoginService} from '../../services/login.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styles: []
})
export class NavbarComponent implements OnInit {

  constructor( private login:LoginService) {
    this.login.isAuthenticated();
   }

  ngOnInit() {
  }
  

  salir(){
    localStorage.removeItem('inicio');
    localStorage.removeItem('id');
    localStorage.removeItem('nombre');
    localStorage.removeItem('email');
    window.location.reload();
  }


}
