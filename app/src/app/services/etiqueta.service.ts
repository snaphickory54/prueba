import { Injectable } from '@angular/core';
import { Http} from '@angular/http';
import { Observable } from 'rxjs/Observable'

@Injectable()
export class EtiquetaService {
  urlEtiquetas: string = "http://danzacontemporanea.co/todoList/todoListApp/services/etiquetas/?key=q6qoqZ2jmpyq";
  
  constructor(private http:Http) { }


  getEtiquetas(){
    let url = this.urlEtiquetas;
    return this.http.get(url).map( res => {
      return res.json();
    });
}


}