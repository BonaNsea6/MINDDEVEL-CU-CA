<?php

function userfullName(){//permet de recuperer les infos sur les users
    return auth()->user()->name;
}

function getRolesName(){//permet de recuper les info sur le statut
    $rolesName = "";
    $i = 0 ;
    foreach(auth()->user()->roles as $role){
      $rolesName .= $role->name;
      //saoir le dernier ele
      if($i < sizeof(auth()->user()->roles)-1){
        $rolesName .= " , ";
      }
      $i++;
    }
    return $rolesName;
}


