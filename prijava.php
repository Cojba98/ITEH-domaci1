<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test REST Api</title>

    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
</head>
<?php
    
    include "Obrada.php";
    ?>
<body>
<form action="" method="post">
        <div id="odabir_metode">
            <input type="radio" name="odabir_metode" id="radio_prijava" value="prijava">
            <label for="radio_prijava">Prijava studenta u sobu</label>
            <input type="radio" name="odabir_metode" id="radio_odjava" value="odjava">
            <label for="radio_odjava">Odjava studenta iz sobe</label>
        </div>
<div id="neprijavljeni">
    <table border="1">
    <thead>
        <tr>
            <th>Ime:</th>
            <th>Prezime:</th>
            <th>BrojIndeksa:</th>
            <th>Pol:</th>
            <th>Fakultet:</th>
            <th>Soba:</th>
            <th>Prijavi</th>     
        </tr>
    </thead>
    <tbody>
       
        <?php
        $mydb->selectNeprijavljeni();
        while($red = $mydb->getResult()->fetch_object()): ?>
        <tr>
            <td><?php echo $red->Ime?></td>
            <td><?php echo $red->Prezime?></td>
            <td><?php echo $red->BrojIndeksa?></td>
            <td><?php echo $red->Pol?></td>
            <td><?php echo $red->Fakultet?></td>
            <td><select name="soba<?php echo $red->idStudenta?>" id="soba">
            <?php
            $mydb2 = new Database('dom');
                $mydb2->select("soba","brojSobe",null,null,null, "pol="."'".$red->Pol."'");
                while($red2=$mydb2->getResult()->fetch_object()):
            ?>
                <option value="<?php echo $red2->brojSobe;?>"><?php echo $red2->brojSobe;?></option>
                <?php endwhile;?>        
            </select></td>
            <td><input type="submit" name="prijaviStudenta" id="prijaviStudenta" value="Prijavi studenta<?php echo ($red->idStudenta)?>"></td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>
</div>
<div id="prijavljeni">

<table border="1">
    <thead>
        <tr>
            <th>Ime:</th>
            <th>Prezime:</th>
            <th>BrojIndeksa:</th>
            <th>Pol:</th>
            <th>Fakultet:</th>
            <th>Soba:</th>
            <th>Odjavi:</th>     
        </tr>
    </thead>
    <tbody>
       
        <?php
        $mydb->select("student", "*", "prijava", "idstudenta", "idstud", 'datumOdjava is null');
        while($red = $mydb->getResult()->fetch_object()): ?>
        <tr>
            <td><?php echo $red->Ime?></td>
            <td><?php echo $red->Prezime?></td>
            <td><?php echo $red->BrojIndeksa?></td>
            <td><?php echo $red->Pol?></td>
            <td><?php echo $red->Fakultet?></td>
            <td><?php echo $red->brojSobe?></td>
            <td><input type="submit" name="odjaviStudenta" id="odjaviStudenta" value="Odjavi studenta<?php echo ($red->idStudenta)?>"></td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>
</div>
<br>
</form>
<form action="http://localhost/domaci">
    <input type="submit" id="Nazad" value="Nazad">
</form>


</body>
<script>
$.getScript("http://localhost/domaci/skripta.js");

</script>