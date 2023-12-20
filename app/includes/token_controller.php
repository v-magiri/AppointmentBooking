<?php
    declare(strict_types= 1);

    function does_token_exist(bool|array $result){
        if(!$result){
            return true;
        }else{
            return false;
        }
    }

    function confirm_token(object $pdo, string $token){
        $timestamp=date('Y-m-d H:i:s');
        verify_token($pdo, $token,$timestamp);
    }
?>