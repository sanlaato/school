<?php

class Database
{
    private function connect()
    {
        $string = DBDRIVER . ":host=" . DBHOST . ";dbname=". DBNAME;
        if(!$con = new PDO($string, DBUSER, DBPASS)) {
            die("could not connect to database");
        }

        return $con;
    }

    public function query($query, $data = array(), $afterSelect = array(), $data_type = "object") 
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        if($stm) {
            $check = $stm->execute($data);
            // if query succeed
            if($check) {

                if($data_type == "object") {
                    $data = $stm->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                }

                if(count($afterSelect) > 0)
                {
                    foreach($afterSelect as $func)
                    {
                        $data = $this->$func($data);
                    }
                }

                /*
                if(is_array($data) && count($data) > 0) {
                    return $data;
                }
                return true;
                */

                return $data;
            }
        }
        return false;
    }
}