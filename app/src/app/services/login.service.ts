import { Injectable } from '@angular/core';
import { Http} from '@angular/http';
import { Observable } from 'rxjs/Observable'

import 'rxjs/add/operator/map';

@Injectable()
export class LoginService {
  public usuario: any;
  urlLogin: string = "http://danzacontemporanea.co/todoList/todoListApp/services/usuario/login?key=q6qoqZ2jmpyq";
  urlUsers: string = "http://danzacontemporanea.co/todoList/todoListApp/services/usuario?key=q6qoqZ2jmpyq";
   constructor( private http:Http) { }

  postUsuario( email:string, clave:string ){

   let url = this.urlLogin;

   return this.http.post(url, JSON.stringify ({email, clave}))
   .map( res=>{
     this.usuario = res;
     if(this.usuario != 'Datos Incorrectos'){
      this.usuario = res.json();
      console.log(this.usuario[0].nombre);
      localStorage.setItem('inicio', 'true');
      localStorage.setItem('id', this.usuario[0].id);
      localStorage.setItem('nombre', this.usuario[0].nombre);
      localStorage.setItem('email', this.usuario[0].email);
    }
     return res;
   })

   }

   public isAuthenticated(): boolean {
    // Check whether the current time is past the
    // access token's expiry time
    const inicio = JSON.parse(localStorage.getItem('inicio'));

    if(inicio == true){return true;}else{return false;}

  }


  getUsuario(){
  let url = this.urlUsers;
  return this.http.get(url).map( res => {
    return res.json();
  });

  }


}


