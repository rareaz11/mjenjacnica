<?php
//NAPOMENA U VARIJABLU $app_id uspisujete svoj id koji ste dobili od openexchangerates
class ChangeValutaPage extends AbstractClass
{
    public $templateName = 'Change';
    function execute()
    {
        $app_id = ' ';
        $base = $_GET['baza'];
        $url = "https://openexchangerates.org/api/latest.json?app_id=" . $app_id . "&base=" . $base;

        // Open CURL session:
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Get the data:
        $json = curl_exec($ch);
        curl_close($ch);

        var_dump($json);

    }
}
