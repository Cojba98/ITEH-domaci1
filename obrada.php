<?php
    include "Database.php";
    $mydb = new Database('dom');

    if(isset($_POST["posalji"]) && $_POST["posalji"]=="Unesi studenta"){
         if($_POST["ime_studenta"]!=null && $_POST["prezime_studenta"]!=null && $_POST["indeks_studenta"]!=null && $_POST["pol_student"]!=null && $_POST["fakultet"]!=null){
             $vred = "'',"."'".$_POST["ime_studenta"]."', '".$_POST["prezime_studenta"]."', '".$_POST["indeks_studenta"]."', '".$_POST["pol_student"]."', '".$_POST["fakultet"]."'";
                     $mydb->insert("student", $vred );
                    ?><script>alert("Student je uspesno ubacen")</script> <?php
         }else{
            ?><script>alert("Student nije ubacen. Proverite da li ste uneli vrednosti u sva polja.")</script> <?php
                    }
                   // exit();
                }
                     
    if(isset($_POST["posalji"]) && $_POST["posalji"]=="Unesi sobu"){
        if($_POST["broj_sobe"]!=null && $_POST["broj_kreveta"]!=null && $_POST["pol_soba"]!=null){
             $vred = "'',"."'".$_POST["broj_sobe"]."', '".$_POST["broj_kreveta"]."', '".$_POST["broj_kreveta"]."', '".$_POST["pol_soba"]."'";
                     $mydb->insert("soba", $vred );
                     ?><script>alert("Soba je uspesno ubacena")</script> <?php
          }else{
            ?><script>alert("Soba nije ubacena. Proverite da li ste uneli vrednosti u sva polja.")</script> <?php
                      }
                  //exit();
                }
                  
    if(isset($_POST["obrisiStudenta"]) && substr($_POST["obrisiStudenta"], 0, 15)=="Obrisi studenta"){
        $mydb->delete("student", "idStudenta", str_split($_POST["obrisiStudenta"],15)[1]);
       // exit();
    }
                  
    if(isset($_POST["obrisiSobu"]) && substr($_POST["obrisiSobu"], 0, 11)=="Obrisi sobu"){
        $mydb->delete("soba", "idsobe", str_split($_POST["obrisiSobu"],11)[1]);
        //exit();
    }

    if(isset($_POST["pretraziStudenta"]) && $_POST["pretraziStudenta"]=="Pretrazi Studente"){
        $where = '';
        if($_POST["pretraga_ime"]!=null) $where = $where.'ime='."'".$_POST["pretraga_ime"]."'".' and ';
        if($_POST["pretraga_prezime"]!=null) $where = $where.'prezime='."'".$_POST["pretraga_prezime"]."'".' and ';
        if($_POST["pretraga_indeks"]!=null) $where = $where.'brojindeksa='."'".$_POST["pretraga_indeks"]."'".' and ';
        if($_POST["pretraga_pol"]!=null) $where = $where.'pol='."'".$_POST["pretraga_pol"]."'".' and ';
        if($_POST["pretraga_fakultet"]!=null) $where = $where.'fakultet='."'".$_POST["pretraga_fakultet"]."'".' and ';
        $where = substr($where, 0,(strlen($where)-5));
       // exit();
        
?>
<form action="" method="post">
<table border="1">
<thead>
    <tr>
        <th>Ime:</th>
        <th>Prezime:</th>
        <th>BrojIndeksa:</th>
        <th>Pol:</th>
        <th>Fakultet:</th>
        <th>OBRISI:</th>

    </tr>
</thead><tbody><?php
    
                $mydb->select("student", "*", null, null, null, $where);
                while($red = $mydb->getResult()->fetch_object()): ?>
                <tr>
                    <td><?php echo $red->Ime?></td>
                    <td><?php echo $red->Prezime?></td>
                    <td><?php echo $red->BrojIndeksa?></td>
                    <td><?php echo $red->Pol?></td>
                    <td><?php echo $red->Fakultet?></td>
                    <td><input type="submit" name="obrisiStudenta" id="<?php echo ('obrisi'.$red->idStudenta)?>" value="Obrisi studenta<?php echo ($red->idStudenta)?>"></td>
                </tr>
                <?php endwhile;?>
                </tbody>
                </table>
                </form>
<?php
      
       // exit();
    }
    if(isset($_POST["promeniStudenta"]) && str_split($_POST["promeniStudenta"],15)[0] == "Izmeni studenta" ){
    if($_POST["izmena_ime"]!=null && $_POST["izmena_prezime"]!=null && $_POST["izmena_indeks"]!=null && $_POST["izmena_pol"]!=null && $_POST["izmena_fakultet"]!=null){
        $nizKolona = ["Ime", "Prezime", "BrojIndeksa", "Pol" , "Fakultet"];
        $nizVrednosti = array("'".$_POST["izmena_ime"]."'", "'".$_POST["izmena_prezime"]."'", "'".$_POST["izmena_indeks"]."'", "'".$_POST["izmena_pol"]."'", "'".$_POST["izmena_fakultet"]."'");
        $mydb->update("student" , "idStudenta", str_split($_POST["promeniStudenta"],15)[1] , $nizKolona, $nizVrednosti );
    }else echo "Unesite sve vrednosti za izmenu";
}

if(isset($_POST["izmeni_sobu"]) && str_split($_POST["izmeni_sobu"],11)[0] == "Izmeni sobu" ){
    if($_POST["izmeni_broj"]!=null && $_POST["izmeni_broj_kreveta"]!=null && $_POST["izmeni_pol"]!=null){
        $nizKolona = ["brojSobe", "brojKreveta", "brojDostupnihKreveta", "pol"];
        $nizVrednosti = array("'".$_POST["izmeni_broj"]."'", "'".$_POST["izmeni_broj_kreveta"]."'","'".$_POST["izmeni_broj_kreveta"]."'", "'".$_POST["izmeni_pol"]."'");
        $mydb->update("soba" , "idsobe", str_split($_POST["izmeni_sobu"],11)[1] , $nizKolona, $nizVrednosti );
    }else echo "Unesite sve vrednosti za izmenu";
}

if(isset($_POST["prijaviStudenta"]) && str_split($_POST["prijaviStudenta"],16)[0] == "Prijavi studenta" ){
    $brojSobe3 = $_POST["soba".str_split($_POST["prijaviStudenta"],16)[1]];
    $vred = str_split($_POST["prijaviStudenta"],16)[1].', '.$_POST["soba".str_split($_POST["prijaviStudenta"],16)[1]].', CURRENT_TIMESTAMP , NULL';
    $mydb->uzmiBrojKreveta($brojSobe3);
    $redd = $mydb->getResult()->fetch_object();
    $kreveti = $redd->brojDostupnihKreveta;
    if($kreveti>0){
    $mydb->insert("prijava", $vred );
    $mydb->smanjiBrojKreveta($_POST["soba".str_split($_POST["prijaviStudenta"],16)[1]], $kreveti);
}else {
        ?><script>alert("U sobi nema vise mesta.")</script><?php
    }
}

   
if(isset($_POST["odjaviStudenta"]) && str_split($_POST["odjaviStudenta"],15)[0] == "Odjavi studenta" ){
    $mydb->odjaviStudenta(str_split($_POST["odjaviStudenta"],15)[1]);

}
    
?>