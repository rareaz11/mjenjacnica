<?php

class UpdateValutaPage extends AbstractClass
{
    public $templateName = 'Update';
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

            // Decode JSON response:
            $oxr_latest = json_decode($json, true);
            $valuta = $oxr_latest['rates'];
            $vrijeme = date('Y-m-d:H-m-s');

            $sql = "SELECT * FROM tecaj";
            $result = AppCore::getDB()->sendquery($sql);
            while ($row = AppCore::getDB()->fetchArray($result)) {
                $provjera = $row['valuta'];
                $id = $row['id'];


                if (isset($valuta[$provjera])) { //provjerava jeli postoji varijabla provjera u nizu valuta
                    $tecaj = $valuta[$provjera];

                    $sql1 = "INSERT INTO history (valutaID, tecaj, datum) VALUES ('$id', '$tecaj', '$vrijeme')";
                    $result1 = AppCore::getDB()->sendquery($sql1);
                    header('HTTP/1.1 200 OK');
                        $this->data = "Uspješno";
                        http_response_code(200);

                    if (!$result1) {
                        header('HTTP/1.1 404 Not found');
                        $this->data = "Greška: Unos krivog ID";
                        http_response_code(404);
                    }
                }
            }
        } catch (Exception $e) {
            $this->data = "Error: " . $e->getMessage();
        }
    }
}
