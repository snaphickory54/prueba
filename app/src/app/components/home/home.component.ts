import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import {LoginService} from '../../services/login.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styles: []
})
export class HomeComponent implements OnInit {
  forma:FormGroup;
  usuario:any;
  constructor(private loginservice:LoginService, private router:Router) { 
    this.forma = new FormGroup({
      'email': new FormControl('', [
                                    Validators.required,
                                    Validators.pattern("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$")
                                  ]),
      'clave': new FormControl('', [
                                    Validators.required
                                  ])
    });
  }

  guardarCambios(){
    this.loginservice.postUsuario(this.forma.value.email,this.forma.value.clave).subscribe( data => {
      this.usuario = data;

      if(this.usuario != 'Datos Incorrectos'){
        console.log('hola');
      this.router.navigate(['/protegida']);
    }
    });
    /*
    this.loginservice.getUsuario().subscribe( data => {
      console.log(data);
    });
    */
    console.log(this.forma.value.email);
    console.log(this.forma.value.clave);
 
  }

  ngOnInit() {
  }

}
