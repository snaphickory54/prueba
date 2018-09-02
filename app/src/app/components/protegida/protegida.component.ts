import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators, FormsModule, ReactiveFormsModule  } from '@angular/forms';
import {LoginService} from '../../services/login.service';
import {ListaService} from '../../services/lista.service';
import {ActividadesService} from '../../services/actividades.service';
import {EstadoService} from '../../services/estado.service';
import {EtiquetaService} from '../../services/etiqueta.service';

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
    this.listaService.getActividades($id).subscribe( data => {

      if(data[0].empty != 'true'){
        this.mostrar = true;
        this.crear = false;
        this.crearLista = false;
        this.listaActividades = data;
      this.getEstado();
      this.getEtiquetas();
      this.getColaboradores();

      }else{
        this.listaActividades = null;
      }

    });
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

    getColaboradores(){

      this.listaColaboradores = [];
      this.actividadesUsuarios = [];
      for (var _i = 0; _i < this.listaActividades.length; _i++){
        this.actividades.getColaboradores(this.listaActividades[_i].id).subscribe( data => {
          //this.etiquetas.push(data);
          this.listaColaboradores.push(data);


      });
    
      }
    
      for (let item of this.listaColaboradores) {
        this.listaFinalColaboradores.push(item);
        console.log(this.listaFinalColaboradores);
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