<?php

class ConvertValutaPage extends AbstractClass
{
    public $templateName = 'Convert';
    function execute()
    {

        try {
            $kolicina = $_GET['kolicina'];
            $valuta1 = $_GET['valuta1'];
            $valuta2 = $_GET['valuta2'];

            //usporedba tablice tecaj i history pomoću valutaID i id za valutu1
            $sql1 = "SELECT tecaj FROM history 
                     INNER JOIN tecaj ON history.valutaID = tecaj.id 
                     WHERE tecaj.valuta = '$valuta1'";
            //ON history.valutaID = tecaj.id: Ovo specificira uvjet za spajanje, označavajući da se stupac "valutaID" u tablici "history" treba podudarati s stupcem "id" u tablici "tečaj".
            $result1 = AppCore::getDB()->sendquery($sql1);
            $row1 = AppCore::getDB()->fetchArray($result1);

            if (!$row1) {
                header('HTTP/1.1 404 Not found');
                $this->data = "Valuta 1 ne postoji";
                http_response_code(404);
            }
            $rez1 = $row1['tecaj'];

            //usporedba tablice tecaj i history pomoću valutaID i id za valutu2
            $sql2 = "SELECT tecaj FROM history 
                     INNER JOIN tecaj ON history.valutaID = tecaj.id 
                     WHERE tecaj.valuta = '$valuta2'";
            $result2 = AppCore::getDB()->sendquery($sql2);
            $row2 = AppCore::getDB()->fetchArray($result2);

            if (!$row2) {
                header('HTTP/1.1 404 Not found');
                $this->data = "Valuta 2 ne postoji";
                http_response_code(404);
            }
            $rez2 = $row2['tecaj'];

            //konvertiranje
            if ($rez1 > 0) {
                $convert = ($kolicina / $rez1) * $rez2;
                $this->data = "Conversion from " . $valuta1 . ' to ' . $valuta2 . ' is ' . $convert;
            } else {
                header('HTTP/1.1 404 Not found');
                $this->data = "Greška: Dijeljenje s nulom!!!!";
                http_response_code(404);
            }
        } catch (Exception $e) {
            throw new Exception("Greška: " . $e->getMessage());
        } catch (DivisionByZeroError $e) {
            throw new DivisionByZeroError($e->getMessage());
        }
    }
}
