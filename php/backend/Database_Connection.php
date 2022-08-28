<?php
// No Errors Appears At Application Production-----------------------*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*----------------------Database Connection--------------------------*/
$serverName     = "localhost";
$userName       = "root";/*--u633829885_Dabo2100--*/
$Password       = "";/*--Soo2taw2eet--*/
$Database_Name  = "taskato";/*--u633829885_dManger--*/
$conn           = mysqli_connect($serverName, $userName, $Password);
if (!$conn) {
    die("Connection Failed");
    exit();
} else {
    mysqli_select_db($conn, $Database_Name);
}
/*-------------------------------------------------------------------*/