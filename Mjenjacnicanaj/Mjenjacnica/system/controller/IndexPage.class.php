<?php
class IndexPage extends AbstractClass{
    public $templateName='index';
    public function execute(){
        $sql = "SELECT * FROM tecaj";
        $result = AppCore::getDB()->sendquery($sql);
        $tecaj = [];
        while ($row = AppCore::getDB()->fetchArray($result)){
            $tecaj[$row['id']] = $row;
        }
        // get resources
        $sql = "SELECT * FROM resursi";
        $result = AppCore::getDB()->sendquery($sql);
        $resursi = [];
        while($row = AppCore::getDB()->fetchArray($result)){
            $resursi[$row['resursID']]=$row;
        }

        $sql = "SELECT * FROM history";
        $result = AppCore::getDB()->sendquery($sql);
        $ispis = [];
        while($row = AppCore::getDB()->fetchArray($result)){
            $ispis[$row['valutaID']]=$row;
            
            
        }
        //assing variable to template
        $this->data = [
            'tecaj' => $tecaj,
            'resursi' => $resursi,
            'history'=>$ispis
        ];
       
    }
}
