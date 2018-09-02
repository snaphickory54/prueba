<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Snaps_BL
 *
 * @author pabhoz
 */
class Sisa_BL {
    
    public static function enviarSnap($sender,$adressee,$snap){
        //verificar que sean amigos
        if($sender->isMyfriend($adressee)){
            echo "Podemos mandarnos pendejadas";
        }else{
            Logger::alert("No son amigos",null,"enviarSnap");
        }
    }
    
    
    
 
    
}
