<?php

namespace App;

class Route{

    static public function pathArr($name){
        $parts = explode("/",$name);
        if(str_starts_with($name,"/")){
            array_shift($parts);
            return $parts;
        }
        return $parts;
    }

    static public function params($pathArr){
        if($pathArr[0] == args()[0] && sizeof($pathArr) === sizeof(args()) && sizeof(args()) > 1)
        {
            
            $paramValues = args();
            array_shift($paramValues);

            array_shift($pathArr);
            $paramKeys =  array_filter($pathArr,function($path){
                if(str_starts_with($path,":"))
                {
                    return $path;
                }
            });
            $paramKeys = array_map(function($param){
                return substr($param,1);
            },$paramKeys);
            
            $params = [];
            for($i =0;$i<count($paramKeys);$i++)
            {
                $params[$paramKeys[$i]] = $paramValues[$i];
            }
            
            return $params;
        }
        return "no param";
    }

    static public function get($name,$fn){
        if($_SERVER['REQUEST_METHOD'] === "GET")
        {
            if(str_starts_with($name,"/") && strlen($name)>1 && str_ends_with($name,"/"))
            {
                if(preg_match($name,args()[0]))
                {
                    $fn();
                    die();
                }
            }

            if(Route::pathArr($name)[0] == args()[0] && Route::params(Route::pathArr($name))=="no param" && !isset(args()[1])){
                $fn();
                die();
            }
            elseif(Route::pathArr($name)[0] == args()[0] && Route::params(Route::pathArr($name))!="no param"){
                
                $fn(...Route::params(Route::pathArr($name)));
                die();
            }
            elseif(str_starts_with(Route::pathArr($name)[0],":") && isset(args()[0])){
                $paramKey = substr(Route::pathArr($name)[0],1);
                $paramValue = args()[0];

                $param[$paramKey] = $paramValue;
                $fn(...$param);
                die();
            }
        }        
    }

    static public function post($name,$fn){
     
        if($_SERVER['REQUEST_METHOD']=="POST" && Route::pathArr($name)[0] ===args()[0])
        {
            $fn();
            die();
        }
        else return;
    }

    static public function destroy($name,$fn){

        if($_SERVER['REQUEST_METHOD']=="DELETE" && Route::pathArr($name)[0] === args()[0] && sizeof(Route::params(Route::pathArr($name))) == 1)
        {
            $fn(...Route::params(Route::pathArr($name)));
            die();
        }
        else return;
    }

    static public function update($name,$fn){

        if($_SERVER['REQUEST_METHOD']=="PUT" && Route::pathArr($name)[0] === args()[0] && sizeof(Route::params(Route::pathArr($name))) == 1)
        {
            $fn(...Route::params(Route::pathArr($name)));
            die();
        }
        else return;
    }
}