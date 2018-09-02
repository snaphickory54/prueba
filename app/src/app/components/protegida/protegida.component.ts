import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators, FormsModule, ReactiveFormsModule  } from '@angular/forms';
import {LoginService} from '../../services/login.service';
import {ListaService} from '../../services/lista.service';
import {ActividadesService} from '../../services/actividades.service';
import {EstadoService} from '../../services/estado.service';
import {EtiquetaService} from '../../services/etiqueta.service';
import { Observable } from 'rxjs/Rx';

@Component({
  selector: 'app-protegida',
  templateUrl: './protegida.component.html',
  styles: []
})
export class ProtegidaComponent implements OnInit {
  forma:FormGroup;
  formaList:FormGroup;
  idLista;
  estadoOption: string;
  etiquetaOption: string;
  profile:any = {};
  mostrar = false;
  crear = false;
  crearLista = false;
  estado:any [] = [];
  etiquetas:any [] = [];
  listaUsuario:any [] = [];
  listaColaboradores:any = {};
  listaFinalColaboradores = new Array();
  actividadesUsuarios:any  = new Array();
  listaActividades:any;
  estadoCrearPanel:any = [];
  etiquetaCrearPanel:any = [];
  estadoDeCreado = false;
  promesas:any = [];
  promesasUsuarios:any = [];
  public actividad:any;
  public lista:any;

  constructor(private login:LoginService, private listaService:ListaService, private actividades:ActividadesService, private estadoService:EstadoService, private etiquetaService:EtiquetaService) { 
    this.forma = new FormGroup({
      'nombre': new FormControl('', [
                                    Validators.required,
                                  ]),
      'date': new FormControl('', [
                                    Validators.required
                                  ])
                                  ,
      'estado': new FormControl('', [
                                    Validators.required
                                  ])
                                  ,
      'etiqueta': new FormControl('', [
                                    Validators.required
                                  ])
    });

    this.formaList = new FormGroup({
      'nombre': new FormControl('', [
                                    Validators.required,
                                  ])
    });
    
  }

  ngOnInit() {

    this.listaService.getListas(localStorage.getItem('id')).subscribe( data => {
      this.listaUsuario = data;

    });

     if (this.login.usuario) {
       this.profile = this.login.usuario;
     }else{
       this.profile.id = localStorage.getItem('id');
       this.profile.nombre = localStorage.getItem('nombre');
       this.profile.nombre = localStorage.getItem('email');
     }
   }

   crearListaPost(){
    
    this.listaService.postLista(null, localStorage.getItem('id'), this.formaList.value.nombre).subscribe( data => {
      this.lista = data;

      if(this.lista != 1){
        window.location.reload();
    }else{
      alert('ha ocurrido un error');
    }
    });

  }

  crearListaForm(){
    this.crear = false;
    this.crearLista = true;
    this.mostrar = false;
    console.log('hola');
  }

  crearData(){
    
    this.actividades.postActividad(null, this.idLista, this.forma.value.estado, this.forma.value.etiqueta, this.forma.value.nombre,this.forma.value.date).subscribe( data => {
      this.actividad = data;

      if(this.actividad != 1){
        window.location.reload();
    }else{
      alert('ha ocurrido un error');
    }
    });

  }
  
   cargar($id){
    this.idLista=$id;
    this.mostrar = true;
    this.crear = false;
    this.crearLista = false;
    this.listaService.getActividades($id).subscribe( data => {

      if(data[0].empty != 'true'){

        this.listaActividades = data;
      this.getEstado();
      this.getEtiquetas();
      this.getColaboradores();

      }else{
        this.listaActividades = null;
      }

    });
  }

  
  getColaboradores(){
    let promesa;
    let usuario;
    this.listaColaboradores = [];
    this.actividadesUsuarios = [];
    let compare =0;
    let result = 0;
    let texto = '';
    let _q=0;

   
    try{
    for (var _i = 0; _i < this.listaActividades.length; _i++){
     promesa = this.actividades.getColaboradores(this.listaActividades[_i].id);
      
      this.promesas.push(promesa);
     
    }
  }finally{
    Observable.forkJoin(this.promesas).subscribe( data => {
      console.log(data);
      this.listaColaboradores = new Array(Object.keys(data).length);
    try{
  for (var _j = 0; _j < Object.keys(data).length; _j++){

    if(Object.keys(data[_j]).length < 2){

     if(data[_j][0].empty){
        this.listaColaboradores[_j] = 'sin asignar';

     }else{

      usuario = this.actividades.getUsuarios(data[_j][0].id_usuario);
      this.promesasUsuarios.push(usuario);
    }

    }else{


      for (var _h = 0; _h < Object.keys(data[_j]).length; _h++){  
        usuario = this.actividades.getUsuarios(data[_j][_h].id_usuario);
        this.promesasUsuarios.push(usuario);
      }
    }
 }

}finally{
  Observable.forkJoin(this.promesasUsuarios).subscribe( dataUsuario => {
    console.log(dataUsuario);
  let numbersArrays = [];
  for (var _m = 0; _m < data.length; _m++){  
    if(this.listaColaboradores[_m] == null){
      numbersArrays.push([_m]);
    }//finalIf
  }

  for (var _n = 0; _n < data.length; _n++){

    for (var _x = 0; _x < Object.keys(dataUsuario).length; _x++){  
      if(Object.keys(data[_n]).length < 2){

        if(data[_n][0].empty != 'true'){

          if(data[_n][0]['id_usuario'] == dataUsuario[_x]['id']){
            this.listaColaboradores[_n] = dataUsuario[_x]['nombre'];

          }
  
      }
      }else{
        if(Object.keys(data[_n]).length >= 2){

        if(data[_n][0].empty != 'true'){
      for (var _z = 0; _z < Object.keys(data[_n]).length; _z++){
            if(_q == dataUsuario.length) _q=0;

            if(data[_n][_z]['id_usuario'] == dataUsuario[_q]['id']){
              compare++;
              if(compare == Object.keys(data[_n]).length){
                texto = texto+dataUsuario[_q]['nombre'];
                this.listaColaboradores[_n] = texto;
               /*  console.log(data[_n][_z]);
                console.log('valor: '+compare);
                console.log('length data:' +Object.keys(data[_n]).length); */
                compare = 0;
                texto = '';
                result++;
                _z = Object.keys(data[_n]).length;
                _x = dataUsuario.length;
              }else{
                texto = texto+dataUsuario[_q]['nombre']+', ';
                this.listaColaboradores[_n] = texto;
              }

              //console.log(dataUsuario[_q]);
              _q=0;
            }
            
            _q++;
           }
          
      }
    }

      }//final else
      
    }//final _x

 }//finalfor

  //final
  });
}

    });//finalForkjoin


  }//final for




}

  crearActividad(){
    this.crear = true;
    this.mostrar = false;
    this.crearLista = false;
    this.getEstadoCrear();
    this.getEtiquetaCrear();
  }

  getEstado(){
    this.estado = [];
  for(let estado of this.listaActividades){
  this.actividades.getEstado(estado.id_estado).subscribe( data => {
    this.estado.push(data);
  });
  }

  }

  getEtiquetas(){
    this.etiquetas = [];
    for(let etiqueta of this.listaActividades){
    this.actividades.getEtiqueta(etiqueta.id_etiqueta).subscribe( data => {
      this.etiquetas.push(data);
    });
    }
  
    }


getEstadoCrear(){
this.estadoService.getEstado().subscribe( data => {
  this.estadoCrearPanel = data;

});
}

getEtiquetaCrear(){
  this.etiquetaService.getEtiquetas().subscribe( data => {
    console.log(data);
    this.etiquetaCrearPanel = data;
  
  });


}

}