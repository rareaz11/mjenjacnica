<?php

class CreateValutaPage extends AbstractClass
{
    public $templateName = 'Create';
    function execute()
    {
//NAPOMENA U VARIJABLU $app_id uspisujete svoj id koji ste dobili od openexchangerates

        try {
            $app_id = '';
            $oxr_url = "https://openexchangerates.org/api/latest.json?app_id=" . $app_id;

            // Open CURL session:
            $ch = curl_init($oxr_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // Get the data:
            $json = curl_exec($ch);
            curl_close($ch);

            $valuta = $_GET['valuta'];

            $oxr_latest = json_decode($json, true);
            $rates = $oxr_latest['rates'];

            $number = 0;
            $datum = date("Y-m-d H:i:s");

            foreach ($rates as $key => $vrijednost) {
                if ($key == $valuta) {
                    $sql = "INSERT INTO tecaj (valuta)
                        VALUES ('$key')";
                    $result = AppCore::getDB()->sendquery($sql);
                    $number++;

                    $sql2 = "SELECT id FROM tecaj where valuta='$valuta'";
                    $result2 = AppCore::getDB()->sendquery($sql2);

                    $provjera2 = 0;
                    $resursi = [];
                    while ($row = AppCore::getDB()->fetchArray($result2)) {
                        $resursi[$row['id']] = $row;
                        $provjera2 = $row['id'];
                    }
                    $sql3 = "INSERT INTO history(valutaID,tecaj,datum)
                        Values('$provjera2','$vrijednost','$datum')";
                    $result3 = AppCore::getDB()->sendquery($sql3);
                }
            }
            if ($number == 1) {
                $this->data = "Uspješno uneseno";
                header('HTTP/1.1 200 OK');
                http_response_code(200);
            } else {
                header('HTTP/1.1 404 Not found');
                http_response_code(404);
                $this->data = "Valuta ne postoji";
            }
        } catch (Exception $e) {
            throw new Exception("Message: " . $e->getMessage());}}

}