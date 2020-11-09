<?php

class Database
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname;
    private $dblink;
    private $result;
    private $records;
    private $affected;

    function __construct($par_dbname)
    {
        $this->dbname = $par_dbname;
        $this->Connect();
    }

    function Connect(){
        $this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if($this->dblink->connect_errno){
            printf("Konekcija neuspešna: %s\n", $this->dblink->connect_error);
            exit();
        }
        $this->dblink->set_charset("utf8");
    }

    function ExecuteQuery($query){
       // echo("Upit je: ".$query);
        $this->result = $this->dblink->query($query);
        if($this->result){
            if(isset($this->result->num_rows)){
                $this->records = $this->result->num_rows;
            }
            if(isset($this->result->affected_rows)){
                $this->affected = $this->result->affected_rows;

            }
            return true;
        }else{
            return false;
        }
    }

    function getResult(){
        return $this->result;
    }

    function selectNeprijavljeni(){
        $q = "SELECT DISTINCT idStudenta, Ime, Prezime, BrojIndeksa, Fakultet, Pol FROM student WHERE idstudenta not in (select idstud from prijava where datumOdjava is null)";
    

        $this->ExecuteQuery($q);
    }

    function select($table, $rows, $join_table, $join_key1, $join_key2, $where=null, $order=null){
        $q = 'SELECT '.$rows.' FROM '.$table;
        //SELECT * FROM novosti
        if($join_table!=null){
            $q.=' JOIN '.$join_table.' ON '.$table.'.'.$join_key1.'='.$join_table.'.'.$join_key2;
            //SELECT * FROM novosti JOIN kategorije ON novosti.kategorija_id = kategorije.id
        }
        if($where!=null){
            $q.=' WHERE '.$where;
        }
        if($order!=null){
            $q.=' ORDER BY '.$order;
        }

        $this->ExecuteQuery($q);
    }
    function insert($table, $values){
        $q ='INSERT INTO '.$table; 
        $q.=" VALUES($values)";
        if($this->ExecuteQuery($q)){
            return true;
        }else{
            return false;
        }
    }
    function update($table, $idNaziv, $idVrednost, $keys, $values){
        $query_values ="";
        $set_query = array();
        for($i =0; $i<sizeof($keys); $i++){
            $set_query[] = "$keys[$i] = $values[$i]";
        }
        $query_values = implode(",", $set_query);  
        $q = "UPDATE $table SET $query_values WHERE $idNaziv=$idVrednost";
        if($this->ExecuteQuery($q) && $this->affected>0){
            return true;
        }else{
            return false;
        }
    }

    function uzmiBrojKreveta($id){
        $q = "select * from soba where brojsobe=".$id;
        
        if($this->ExecuteQuery($q) && $this->affected>0){
            
            return true;
        }else{
            return false;
        }
    }

    function smanjiBrojKreveta($id, $kreveti){
        $q = "update soba set brojdostupnihkreveta=".($kreveti - 1)." where brojsobe=".$id;
        if($this->ExecuteQuery($q) && $this->affected>0){
            return true;
        }else{
            return false;
        }
    }

    function povecajBrojKreveta($id){
        $this->uzmiBrojKreveta($id);
        $q = "update soba set brojdostupnihkreveta=".($this->getResult()->fetch_object()->brojDostupnihKreveta+1)." where brojsobe=".$id;
        if($this->ExecuteQuery($q) && $this->affected>0){
            
            return true;
        }else{
            return false;
        }
           
    }

    function odjaviStudenta($idStudenta){
        $iddSobe = 'select * from prijava where datumOdjava is null and idstud='.$idStudenta;
        $this->ExecuteQuery($iddSobe);
        $i = $this->getResult()->fetch_object()->brojSobe;
        $this->povecajBrojKreveta($i);
        $q = 'update prijava set datumOdjava = CURRENT_TIMESTAMP where datumOdjava is null and idstud='.$idStudenta;
        if($this->ExecuteQuery($q) && $this->affected>0){
            //povecajBrojKreveta($i);
            return true;
        }else{
            return false;
        }
    }

    function delete($table, $id, $id_value){
        $q = "DELETE FROM $table WHERE $id=$id_value";
        
        if($this->ExecuteQuery($q)){
            return true;
        }else{
            return false;
        }
    }


}

?>