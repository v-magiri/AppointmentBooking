<?php
    declare(strict_types= 1);
    function sendEmail(string $to,string $subject,string $body){
        $headers="From: magiri4vic@gmail.com";

        if(mail($to,$subject,$body,$headers)){
            return true;
        }else{
            return false;
        }
    }
?>