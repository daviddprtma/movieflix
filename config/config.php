<?php
try{
 $HOST = "localhost";

 $DBNAME = "movieflix";

 $USER = "root";

 $PASS = "";

$conn = new PDO('mysql:host='.$HOST.';dbname='.$DBNAME,$USER,$PASS);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
    echo $e->getMessage();
}
?>