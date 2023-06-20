<?php
class ReadValutaPage extends AbstractClass
{
    public $templateName = 'Read';

    function execute()
    {
        $valuta = $_GET['valuta'];

        //provjeri jel unesena valuta
        if ($valuta == "" || $valuta == null) {
            $this->data = "Unesi valutu!!!!";
            header('HTTP/1.1 404 Not found');
            http_response_code(404);
        } else {
            $sql3 = "SELECT COUNT(*) as rez from tecaj where valuta ='$valuta'";
            $result2 = AppCore::getDB()->sendquery($sql3);
            $provjera = 0; //varijablom provjeravamo jeli postoje ili ne tako što ako jednako 1 znači da postoji
            $resursi = [];
            while ($row = AppCore::getDB()->fetchArray($result2)) {
                $resursi[$row['rez']] = $row;
                $provjera = $row['rez'];
            }
            $this->provjera = $provjera;

            //ispis valute ako postoji
            if ($provjera == 1) {
                $ispis = "SELECT * FROM tecaj";
                $ispis .= " WHERE valuta = '" . $valuta . "'";
                $result = AppCore::getDB()->sendQuery($ispis);

                $ispisValuta = array(); //kreiraj prazan niz

                while ($row = AppCore::getDB()->fetchArray($result)) {
                    $ispisValuta[$row['id']] = $row;
                }
                header('HTTP/1.1 200 OK');
                http_response_code(200);
                $this->data = "Valuta postoji";

                $this->data = [
                    'tecaj' => $ispisValuta
                ];
            } else {
                //u slučaju da valuta unesena ne postoji
                $this->data = "Valuta ne postoji";
                header('HTTP/1.1 404 Not found');
                http_response_code(404);
            }
        }
    }
}
