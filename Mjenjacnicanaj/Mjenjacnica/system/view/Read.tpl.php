<h2><?php
    if ($this->provjera == 1) {
        print(http_response_code()); ?>
        <h1>Valuta:</h1>
        <h3>
        <?php
        foreach ($data['tecaj'] as $key => $_data) { ?>
            <?= "Naziv valute: " . $_data['valuta'] ?>
            <br><br></h3>
    <?php }
    } else {
        print(http_response_code());
        echo "<br>";
        echo $data;
    }
    ?>
</h2>