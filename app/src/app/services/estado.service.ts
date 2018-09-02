import { Injectable } from '@angular/core';
import { Http} from '@angular/http';
import { Observable } from 'rxjs/Observable'

@Injectable()
export class EstadoService {
  urlEstado: string = "http://danzacontemporanea.co/todoList/todoListApp/services/estado/?key=q6qoqZ2jmpyq";
  
  constructor(private http:Http) { }


  getEstado(){
    let url = this.urlEstado;
    return this.http.get(url).map( res => {
      return res.json();
    });
}


}
