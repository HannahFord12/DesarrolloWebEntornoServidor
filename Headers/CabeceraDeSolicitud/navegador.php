<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($user_agent, 'Firefox') !== FALSE){
    echo"se puede visualizar";
}else{
    echo"No se puede visualizar";
}
?>