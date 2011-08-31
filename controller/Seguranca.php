<?php
class Seguranca {

    public static function anti_injection($str) {            
                $pattern = array("'", "--", ";", "*", "=", "%");
                return trim(str_replace($pattern, "", $str));
    }
    
    
        
}

?>
