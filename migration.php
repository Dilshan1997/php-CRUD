<?php

$db=new PDO('mysql:dbname=crud;host=localhost;','root','');

if($db==true){
    //echo("connect");
}
else{
    //echo("Connection error");
}
