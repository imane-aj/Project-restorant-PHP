<?php

class database{
private static $user = 'ajroudim_restorantadmin';
private static $password='Ajroudi@123';
private static $db='ajroudim_restorantadmin';
private static $host='localhost';
private static $connection = null;

public static function connect(){

try{
self::$connection = new PDO('mysql:host=' .self::$host .';dbname=' . self::$db,self::$user,self::$password);
self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOexecption $e){
die($e->getMessage());
}
return self::$connection;
}


public static function disconnect(){
self::$connection=null;
}
}

?>