import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import {APP_ROUTING} from './app.Routes';
import { HttpModule  } from '@angular/http';
import {FormsModule, ReactiveFormsModule } from '@angular/forms';


import { AppComponent } from './app.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { HomeComponent } from './components/home/home.component';
import { ProtegidaComponent } from './components/protegida/protegida.component';

import {AuthService} from './services/auth.service';
import {AuthGuardService} from './services/auth-guard.service';
import {LoginService} from './services/login.service';
import {ListaService} from './services/lista.service';
import {ActividadesService} from './services/actividades.service';
import {EstadoService} from './services/estado.service';
import {EtiquetaService} from './services/etiqueta.service';

@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    HomeComponent,
    ProtegidaComponent
  ],
  imports: [
    BrowserModule,
    APP_ROUTING,
    HttpModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [
    AuthService,
    AuthGuardService,
    LoginService,
    ListaService,
    ActividadesService,
    EstadoService,
    EtiquetaService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
