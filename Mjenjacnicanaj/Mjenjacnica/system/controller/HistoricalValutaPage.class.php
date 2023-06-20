<?php
class HistoricalValutaPage extends AbstractClass
{
    public $templateName = 'history';

    function execute()
    {

        try {
            $date = $_GET['datum'];
            $dateCondition = date('Y-m-d', strtotime($date)); // Format the date for the database query

            if ($date = "" || $date == null) {
                header('HTTP/1.1 404 Not found');
                $this->data = "Unesi datum!!!!";
                http_response_code(404);
            } else {
                $sql = "SELECT * FROM history WHERE DATE(datum) = '$dateCondition'";
                $result = AppCore::getDB()->sendquery($sql);
                $history = [];
                while ($row = AppCore::getDB()->fetchArray($result)) {
                    $history[$row['valutaID']] = $row;
                }
                $count = "SELECT COUNT(*) as rez from history where DATE(datum) ='$dateCondition'";
                $result2 = AppCore::getDB()->sendquery($count);
                $provjera = 0;
                $resursi = [];
                while ($row = AppCore::getDB()->fetchArray($result2)) {
                    $resursi[$row['rez']] = $row;
                    $provjera = $row['rez'];
                }
                $this->provjera = $provjera;
                if ($provjera > 0) {
                    $sql = "SELECT * FROM tecaj";
                    $result = AppCore::getDB()->sendquery($sql);
                    $tecaj = [];
                    while ($row = AppCore::getDB()->fetchArray($result)) {
                        $tecaj[$row['id']] = $row;
                    }

                    $this->data = [
                        'history' => $history,
                        'tecaj' => $tecaj
                    ];
                } else {
                    header('HTTP/1.1 404 Not found');
                    $this->data = "Datum ne postoji";
                    http_response_code(404);
                }
            }
        } catch (Exception $e) {
            throw new Exception("Greška: " . $e->getMessage());
        }
    }
}
