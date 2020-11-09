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
        <div id="odabir_tabele">
            <input type="radio" name="odabir_tabele" id="radio_student" value="kategorije">
            <label for="radio_student">STUDENT</label>
            <input type="radio" name="odabir_tabele" id="radio_soba" value="novosti">
            <label for="radio_soba">SOBA</label>
        </div>

        <div id="http_zahtev" >
            <input type="radio" name="http_zahtev" id="get" value="get">
            <label for="get">PRETRAZI</label>
            <input type="radio" name="http_zahtev" id="post" value="post">
            <label for="post">UBACI</label>
            <input type="radio" name="http_zahtev" id="put" value="put">
            <label for="put">IZMENI</label>
            
        </div>

        <div id="student_post">
            <input type="text" name="ime_studenta" id="ime_studenta" placeholder="Ime:">
            <br>
            <input type="text" name="prezime_studenta" id="prezime_studenta" placeholder="Prezime:">
            <br>
            <input type="text" name="indeks_studenta" id="indeks_studenta" placeholder="Broj indeksa:">
            <br>
            <label for="pol_student">Pol:</label>
            <input type="radio" name="pol_student" id="muski_student" value="muski">
            <label for="muski">Muski</label>
            <input type="radio" name="pol_student" id="zenski_student" value="zenski">
            <label for="zenski">Zenski</label>
            <br>
            <label for="fakultet">Fakultet</label>
            <select name="fakultet" id="fakultet">
            <?php
                $mydb->select("fakultet","*",null,null,null);
                while($red=$mydb->getResult()->fetch_object()):
            ?>
                <option value="<?php echo $red->naziv;?>"><?php echo $red->naziv;?></option>
                <?php endwhile;?>        
            </select>
            <div id="submit">
            <input type="submit" name="posalji" id="posalji" value="Unesi studenta">
        </div>
        </div>

        <div id="soba_post">
        <input type="text" name="broj_sobe" placeholder="Broj sobe:">
            <br>
            <input type="text" name="broj_kreveta" placeholder="Broj kreveta:">
            <br>
            <label for="pol_soba">Pol:</label>
            <input type="radio" name="pol_soba" id="muski" value="muski">
            <label for="muski">Muski</label>
            <input type="radio" name="pol_soba" id="zenski" value="zenski">
            <label for="zenski">Zenski</label>
            <div id="submit">
            <input type="submit" name="posalji" id="posalji" value="Unesi sobu">
        </div>
        </div>

        <div id="student_get">

        <div id = "pretraga_studenta">
        <table border="1">
            <thead>
                <tr>
                    <th>Ime:</th>
                    <th>Prezime:</th>
                    <th>BrojIndeksa:</th>
                    <th>Pol:</th>
                    <th>Fakultet:</th>
                    
                </tr>
            </thead>
            <br>           
            <br>
            <br>

            <tbody>
              
                <tr>
                    <td> <input type="text" name="pretraga_ime"></td>
                    <td> <input type="text" name="pretraga_prezime"></td>
                    <td> <input type="text" name="pretraga_indeks"></td>
                    <td> <input type="text" name="pretraga_pol"></td>
                    <td> <input type="text" name="pretraga_fakultet"></td>
                    <td><input type="submit" name="pretraziStudenta" id="pretrazi_studenta" value="Pretrazi Studente"></td>

                </tr>
               
            </tbody>
        </table>

        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>Ime:</th>
                    <th>Prezime:</th>
                    <th>BrojIndeksa:</th>
                    <th>Pol:</th>
                    <th>Fakultet:</th>
                    <th>OBRISI:</th>
                    <th>IZMENI:</th>                    
                </tr>
            </thead>
            <tbody>
               
                <?php
                $mydb->select("student", "*", null, null, null);
                while($red = $mydb->getResult()->fetch_object()): ?>
                <tr>
                    <td><?php echo $red->Ime?></td>
                    <td><?php echo $red->Prezime?></td>
                    <td><?php echo $red->BrojIndeksa?></td>
                    <td><?php echo $red->Pol?></td>
                    <td><?php echo $red->Fakultet?></td>
                    <td><input type="submit" name="obrisiStudenta" id="<?php echo ('obrisi'.$red->idStudenta)?>" value="Obrisi studenta<?php echo ($red->idStudenta)?>"></td>
                    <td><input type="submit" name="promeniStudenta" id="promeniStudenta" value="Izmeni studenta<?php echo ($red->idStudenta)?>"></td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
        </div>

        <div id="izmeniStudenta"> <table border="1">
            <thead>
                <tr>
                    <th>Ime:</th>
                    <th>Prezime:</th>
                    <th>BrojIndeksa:</th>
                    <th>Pol:</th>
                    <th>Fakultet:</th>
                    
                </tr>
            </thead>
            <br>           
            <br>
            <br>

            <tbody>
              
                <tr>
                    <td> <input type="text" name="izmena_ime"></td>
                    <td> <input type="text" name="izmena_prezime"></td>
                    <td> <input type="text" name="izmena_indeks"></td>
                    <td> <input type="text" name="izmena_pol"></td>
                    <td> <input type="text" name="izmena_fakultet"></td>
                   

                </tr>
               
            </tbody>
        </table></div>

        <div id="soba_get">
        <table border="1">
            <thead>
                <tr>
                    <th>Broj:</th>
                    <th>Broj kreveta:</th>
                    <th>Broj slobodnih kreveta</th>
                    <th>Pol:</th>
                    <th>OBRISI:</th>
                    <th>IZMENI:</th>
                    
                </tr>
            </thead>
            <tbody>
               
                <?php
                $mydb->select("soba", "*", null, null, null);
                while($red = $mydb->getResult()->fetch_object()): ?>
                <tr>
                    <td><?php echo $red->brojSobe?></td>
                    <td><?php echo $red->brojKreveta?></td>
                    <td><?php echo $red->brojDostupnihKreveta?></td>
                    <td><?php echo $red->pol?></td>
                    <td><input type="submit" name="obrisiSobu" id="<?php echo ('obrisi'.$red->idsobe)?>" value="Obrisi sobu<?php echo ($red->idsobe)?>"></td>
                    <td><input type="submit" name="izmeni_sobu" id="izmeni_sobu" value="Izmeni sobu<?php echo ($red->idsobe)?>"></td>
                </tr>
                <?php endwhile;?>
                    
                    

            </tbody>
        </table>
        </div>
<div id = soba_izmeni>
<table border="1">
            <thead>
                <tr>
                    <th>Broj:</th>
                    <th>Broj kreveta:</th>
                    <th>Pol:</th>
                  
                </tr>
            </thead>
            <tbody>
               
               <br> <br> <br> <br>
                <tr>
                <td> <input type="text" name="izmeni_broj"></td>
                    <td> <input type="text" name="izmeni_broj_kreveta"></td>
                    <td> <input type="text" name="izmeni_pol"></td>
                    

                </tr>
                
                    
                    

            </tbody>
        </table>
</div>


</form>
<br>
<form action="http://localhost/domaci/prijava.php">
    <input type="submit" id="Prijava/Odjava" value="Prijava/Odjava">
</form>


<br>
<input type="submit" name="prikazi_autora" id="prikazi_autora" value="Prikazi autora">
<br>
<pre id="autor"></pre>
</body>

<script>

function dan(){document.write("Dobar dan");}
    var nizBlokova = ["soba_get", "student_get", "soba_post", "student_post", "izmeniStudenta", "pretraga_studenta", "soba_izmeni"];

    function skloniBlokove(){
        for(const blok of nizBlokova){
            document.getElementById(blok).style.display="none";
        }
    };

    skloniBlokove();
    function prikaziBlok(){
 
        skloniBlokove();

        if(document.getElementById("radio_student").checked){
            
        

        if(document.getElementById("get").checked){
            document.getElementById(nizBlokova[1]).style.display = "block";
            document.getElementById("pretraga_studenta").style.display = "block";
        } 
        if(document.getElementById("post").checked){
            document.getElementById(nizBlokova[3]).style.display = "block";
        }
        if(document.getElementById("put").checked){
            document.getElementById(nizBlokova[4]).style.display = "block";
            document.getElementById(nizBlokova[1]).style.display = "block";
            document.getElementById("pretraga_studenta").style.display = "none";
        }
        
        
        }else{
            if(document.getElementById("get").checked){
                document.getElementById(nizBlokova[0]).style.display = "block";
        }
        if(document.getElementById("post").checked){
            document.getElementById(nizBlokova[2]).style.display = "block";
        }
        if(document.getElementById("put").checked){
            document.getElementById(nizBlokova[6]).style.display = "block";
            document.getElementById(nizBlokova[0]).style.display = "block";

        }
      
        }

       
        
    }

   function prikaziAutora(){
    $.getJSON("http://localhost/domaci/ime.json", function(data){
        document.getElementById("autor").innerHTML = JSON.stringify(data, null, 2);

    });
    }

    function proveriPolja(){
        if(document.getElementById(ime_studenta).value=="" || 
        document.getElementById(prezime_studenta).value==null ||
        document.getElementById(indeks_studenta).value==null ||
        document.getElementById(pol_student).value==null ||
        document.getElementById(fakultet).value==null)
        alert("Unesite sve vrednosti");
    }

       $("input[name=http_zahtev]").on('click',prikaziBlok);
       $("input[name=odabir_tabele]").on('click',prikaziBlok);
       $("input[name=odabir_tabele]").on('click',prikaziBlok);
        $("input[name=prikazi_autora]").on('click',prikaziAutora);
        $("input[name=posalji]").on('click',proveriPolja);


    </script>