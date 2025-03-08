<?php
try{
    echo bin2hex(random_bytes(32));
} catch(Exception $e){
    "error gegnerating key";
}