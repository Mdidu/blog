<?php
//    session_start();
require "../models/backend.php";

if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['checkPassword']) && isset($_POST['page'])){
    switch ($_POST['page']){
        case "inscription":
            if($_POST['password'] === $_POST['checkPassword']){
                addUsers($_POST['pseudo'], password_hash($_POST['password'], PASSWORD_DEFAULT));
            }
            break;
        case "login":
            checkLog($_POST['pseudo'], $_POST['password']);
            break;
    }

}