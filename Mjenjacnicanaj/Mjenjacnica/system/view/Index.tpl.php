<h1>Dobrodošli u Mjenjačnicu</h1><br><br>
<h2>Resursi:</h2>
<?php 
foreach($data['resursi'] as $key => $_data){?>
    <strong>
        http://localhost/Mjenjacnica/?page=<?=$_data['url']?>
    </strong>
    <br>
    <?=$_data['method']?>
    <br>
    <?=$_data['description']?>
    <br>
    ----------------------------------------------------------------
    <br><br>
<?php }?>


<h2>Tecajevi:</h2>
Baza tecaja je USD (Američki dolar)<br>
----------------------------------------------------
<br>

<?php 
foreach ($data['history'] as $key => $_data) {
    $valutaID = $_data['valutaID'];

    if (isset($data['tecaj'][$valutaID])) {
        $tecajData = $data['tecaj'][$valutaID];
        echo "<strong>Naziv valute: " . $tecajData['valuta'] . "</strong><br><br>"; 
        echo "<strong>Tecaj valute: " . $_data['tecaj'] . "</strong><br>";
        echo "--------------------------------<br><br>";
    }
}
?>

