<?php
set_exception_handler(array('AppCore', 'handleException'));
//postavlja za obradu iznimki metodu handleException() klase AppCore. Kada se dogodi neuhvaćena iznimka, ta metoda će biti pozvana za obradu i obradu iznimke na prilagođeni način.
?>

