<?php

//$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
//$url = parse_url(getenv("JAWSDB_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);


$server = "t07cxyau6qg7o5nz.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "u8qsxfwtq45kuru8";
$password = "mcu53mhjv2r02pxg";
$db = "mzi5uddz2oacjhoe";


/*
$server = "localhost";
$username = "root";
$password = "";
$db = "quaiantique";

var_dump($server);
var_dump($username);
var_dump($password);
var_dump($db);
var_dump($conn);
*/
$conn = mysqli_connect($server, $username, $password, $db);

//$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn){
    die("Connection failed:" .mysqli_connect_error());
}
?>

