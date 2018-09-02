import { Injectable } from '@angular/core';
import { Http} from '@angular/http';
import { Observable } from 'rxjs/Observable'
@Injectable()
export class ListaService {
  urlLista: string = "http://danzacontemporanea.co/todoList/todoListApp/services/lista/ListaUser?key=q6qoqZ2jmpyq&id=";
  urlActividades: string = "http://danzacontemporanea.co/todoList/todoListApp/services/actividades/ListaActividades?key=q6qoqZ2jmpyq&id=";
  urlPostLista: string = "http://danzacontemporanea.co/todoList/todoListApp/services/lista?key=q6qoqZ2jmpyq";
  public listacreada:any;

  constructor(private http:Http) { }

  getListas(id){
    let url = this.urlLista+id;
    return this.http.get(url).map( res => {

      return res.json();
    });
}

  getActividades(id){
    let url = this.urlActividades+id;
    return this.http.get(url).map( res => {
      return res.json();
    });
  }

  postLista(id, id_propietario, nombre:string ){

    let url = this.urlPostLista;
 
    return this.http.post(url, JSON.stringify ({id,id_propietario,nombre}))
    .map( res=>{
      this.listacreada = res;
      if(this.listacreada != 'Datos Incorrectos'){
       this.listacreada = res.json();
       console.log(this.listacreada);
     }
      return res;
    })
 
    }


}
