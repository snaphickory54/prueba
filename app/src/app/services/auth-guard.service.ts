import { Injectable } from '@angular/core';
import {Route, ActivatedRouteSnapshot,RouterStateSnapshot, CanActivate} from '@angular/router';
import {LoginService} from './login.service';

@Injectable()
export class AuthGuardService implements CanActivate {

  constructor(private login:LoginService) { }

  canActivate(next:ActivatedRouteSnapshot){
    console.log(next.url[0].path);

    if(this.login.isAuthenticated()){
      return true;
    }else{
      console.log('false');
      return false;
    }
  }

}
