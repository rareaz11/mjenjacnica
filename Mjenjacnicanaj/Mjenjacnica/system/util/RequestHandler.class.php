<?php

require_once('system/controller/Abstract.class.php');
class RequestHandler{
    function __construct($className)
    {
        $className=$className.'Page';
        require_once('system/controller/'.$className.'.class.php');
        new $className();
        //prima naziv klase, generira ime klase dodavanjem "Page" na taj naziv, uključuje odgovarajuću PHP datoteku koja sadrži definiciju te klase, te stvara novu instancu te klase.
    }

    static function handle(){
        $request=$_GET['page']?? 'Index';
        new RequestHandler($request);
        //dobiva vrijednost 'page' iz URL parametara, a zatim stvara novu instancu klase RequestHandler s tim parametrom za daljnju obradu zahtjeva.
    }
    
}



?>