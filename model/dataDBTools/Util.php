<?php

class Util {
    
    public static function dataFromBanco($data) {
        if($data) { 
            $data = explode("-", $data); 
            $data = $data[2]."/".$data[1]."/".$data[0];             
        }
        return $data;
    }
    
    
    
}
?>
