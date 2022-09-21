<?php
    $nombres = ["Juan" => "Tiene 16 años", "Marcos" => "Es chico", "Adrian" => "18"];
    print_r($nombres);
    uasort($nombres,"cmp");
    echo"<br>";
    function cmp($a , $b){
        if (strlen($a)  == strlen($b)){
            return 0;
        }else{
            return ($a < $b) ? -1 : 1;
        }
    }
    print_r($nombres);

?>