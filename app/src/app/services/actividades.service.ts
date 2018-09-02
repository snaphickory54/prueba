import { Injectable } from '@angular/core';
import { Http} from '@angular/http';
import { Observable } from 'rxjs/Observable'


@Injectable()
export class ActividadesService {
  public actividad:any;
urlEstado: string = "http://danzacontemporanea.co/todoList/todoListApp/services/estado/?key=q6qoqZ2jmpyq&id=";
urlEtiqueta: string = "http://danzacontemporanea.co/todoList/todoListApp/services/etiquetas?key=q6qoqZ2jmpyq&id=";
urlColaboradores: string = "http://danzacontemporanea.co/todoList/todoListApp/services/actividades/actividadmiembros?key=q6qoqZ2jmpyq&id=";
urlUsuarios: string = "http://danzacontemporanea.co/todoList/todoListApp/services/usuario?key=q6qoqZ2jmpyq&id=";
urlPostActividad: string = "http://danzacontemporanea.co/todoList/todoListApp/services/actividades?key=q6qoqZ2jmpyq";

  constructor(private http:Http) { }

  getEstado(id){
    let url = this.urlEstado+id;
    return this.http.get(url).map( res => {
      return res.json();
    });
}

getEtiqueta(id){
  let url = this.urlEtiqueta+id;
  return this.http.get(url).map( res => {
    return res.json();
  });
}

  getColaboradores(id){
    let url = this.urlColaboradores+id;
    return this.http.get(url).map( res => {
      return res.json();
    });
  }
  
  getUsuarios(id){
    let url = this.urlUsuarios+id;
    return this.http.get(url).map( res => {
      return res.json();
    });
  }

  postActividad(id, id_lista:string,id_estado:string, id_etiqueta:string, nombre:string, fecha:string ){

    let url = this.urlPostActividad;
 
    return this.http.post(url, JSON.stringify ({id,id_lista,id_estado,id_etiqueta,nombre,fecha}))
    .map( res=>{
      this.actividad = res;
      if(this.actividad != 'Datos Incorrectos'){
       this.actividad = res.json().error;
       console.log(this.actividad);
     }
      return res;
    })
 
    }


}
