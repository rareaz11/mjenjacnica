<?php
abstract class AbstractClass{
    public $data = null;
    public $provjera=null;
    public $templateName=null;
    function __construct()
    {
        $this->execute();
        $this->show();
    }

    function show(){
        $templateName=$this->templateName;
        $data=$this->data ?? [];
        include_once('system/view/'.$templateName.'.tpl.php');
        // prikazuje template na temelju zadane vrijednosti imena template-a. Podaci se mogu prenijeti u template-a putem svojstva $data, a template datoteka se uključuje za prikazivanje.
    }
}
