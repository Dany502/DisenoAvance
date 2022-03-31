<?php
function user_verify(){
    return isset($_SESSION['usuario']);
}
user_verify();
session_start();