<?php 
    
    echo rand_Pass();

    function rand_Pass($upper = 1, $lower = 5, $numeric = 3, $other = 2){
        
        $password = "";
        for ($i=1; $i < $upper ; $i++) { 
            $password .= mayusculaAleatoria();
        };
        for ($i=1; $i < $lower ; $i++) { 
            $password .= minusculaAleatoria();
        };
        for ($i=1; $i < $numeric ; $i++) { 
            $password .= numeroAleatorio();
        };
        for ($i=1; $i < $other ; $i++) { 
            $password .= caracterAleatorio();
        };

        $arrayPassword = str_split($password,1);
        shuffle($arrayPassword);
        $password = implode("",$arrayPassword);
        return $password;

    };

    function mayusculaAleatoria(){
        return chr(rand(65,90));
    };
    function minusculaAleatoria(){
        return chr(rand(97,122));
    };
    function numeroAleatorio(){
        return rand(0,9);
    };
    function caracterAleatorio(){
        return chr(rand(173,254));
    };
?>