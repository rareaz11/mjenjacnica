<?php

class DeleteValutaPage extends AbstractClass
{
    public $templateName = 'Delete';
    function execute()
    {
        try {
            $username = $_GET['username'];
            $token = $_GET['token'];
            $valuta = $_GET['valuta'];
            // Check if both username and token are provided
            if ($username === "" || $token === "") {
                header('HTTP/1.1 404 Not found');
                http_response_code(404);
                $this->data = "Nedostaje korisničko ime ili token";
            } else {

                // Check if the username and token exist in the database
                $sql = "SELECT * FROM users WHERE username='$username' AND token='$token'";
                $result = AppCore::getDB()->sendQuery($sql);

                if ($valuta == "" || $valuta == null) {
                    $this->data = "Nije unesena valuta";
                    header('HTTP/1.1 404 Not found');
                    http_response_code(404);
                } else {
                    if ($result->num_rows > 0) {
                        // Username and token exist, perform the delete operation
                        $sql3 = "SELECT COUNT(*) as rez from tecaj where valuta ='$valuta'";
                        $result2 = AppCore::getDB()->sendquery($sql3);
                        $provjera = 0;
                        $resursi = [];
                        while ($row = AppCore::getDB()->fetchArray($result2)) {
                            $resursi[$row['rez']] = $row;
                            $provjera = $row['rez'];
                        }
                        if ($provjera == 1) {
                            $sql = "DELETE FROM tecaj WHERE valuta='$valuta'";
                            $result = AppCore::getDB()->sendQuery($sql);
                            $this->data = "Uspješno brisanje";
                            header('HTTP/1.1 200 OK');
                            http_response_code(200);
                        } else {
                            //$error = AppCore::getDB()->error(); // Get the error message
                            $this->data = "Neuspješno brisanje";
                            header('HTTP/1.1 404 Not found');
                            http_response_code(404);
                        }
                    } else {
                        // Username and token do not exist in the database
                        $this->data = "Korisničko ime ili token ne postoje";
                        header('HTTP/1.1 404 Not found');
                        http_response_code(404);
                    }
                }
            }
        } catch (Exception $e) {
            $this->data = "Greška: " . $e->getMessage();
        }
    }
}
