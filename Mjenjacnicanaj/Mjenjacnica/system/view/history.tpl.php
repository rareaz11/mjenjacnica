<?php
if ($this->provjera > 0) {
    print(http_response_code()); ?>
    <h1>Tecajevi:</h1>
    <?php
    foreach ($data['history'] as $key => $_data) {
        $valutaID = $_data['valutaID'];
        $tecajData = $data['tecaj'][$valutaID];
        $valutaIme = $tecajData['valuta'];
        $tecaj = $_data['tecaj'];
        $datum = $_data['datum'];


    ?>
        <h3><strong>
                Valuta: <?php echo $valutaIme; ?><br>
                Tecaj: <?php echo $tecaj; ?><br>
                Datum: <?php echo $datum; ?>
            </strong></h3>
        <br><br>

    <?php }
} else { ?>
    <h2><?php
        print(http_response_code());
        echo "<br>";
        echo $data;
    } ?></h2>