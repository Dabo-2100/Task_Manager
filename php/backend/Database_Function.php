<?php
include "Database_Connection.php";
function Select($conn, $TableName, $Needs, $Condtions)
{
    mysqli_query($conn, 'SET NAMES utf8');
    $fieldLength = count($Needs);
    $SQL_statement = "SELECT * From $TableName $Condtions";
    $SQl_Excute   = mysqli_query($conn, $SQL_statement);
    if ($SQl_Excute === false) {
        die("Sql_statement_is_Faild");
    } else {
        echo '[';
        $i = 0;
        $cont = mysqli_num_rows($SQl_Excute);
        while ($row0 = mysqli_fetch_assoc($SQl_Excute)) {
            $i++;
            echo "{";
            for ($a = 0; $a < $fieldLength; $a++) {
                $JsonobjectName = $Needs[$a];
                $JsonobjectValue = $row0["$Needs[$a]"];
                if (gettype($JsonobjectValue) == 'object') {
                    $JsonobjectValue = date_format($JsonobjectValue, 'Y-m-d');
                }
                echo '"' . $JsonobjectName . '":' . '"' . $JsonobjectValue . '"';
                if ($a < ($fieldLength - 1)) {
                    echo ",";
                }
            }
            echo "}";
            if ($i != $cont) {
                echo ',';
            }
        }
        echo "]";
    }
}
//-------------------------------------------------------------------*/
function Insert($conn, $TableName, $Table_Fields, $Inserted_Data/*---$Inserted_Data is Array Of Arrays----*/)
{
    mysqli_set_charset($conn, 'SET NAMES utf8');
    mysqli_query($conn, 'SET NAMES utf8');
    $Table_Fields_Details   = '';
    $Inserted_Datas_Details = '';

    for ($i = 0; $i < count($Table_Fields); $i++) {
        $Table_Fields_Details = $Table_Fields_Details . $Table_Fields[$i];
        if ($i < count($Table_Fields) - 1) {
            $Table_Fields_Details = $Table_Fields_Details . ",";
        }
    }

    if (count($Inserted_Data) != 0) {
        for ($i = 0; $i  < count($Inserted_Data); $i++) {
            $Inserted_Datas_Details = $Inserted_Datas_Details . "(";
            for ($b = 0; $b < count($Inserted_Data[$i]); $b++) {
                $Inserted_Datas_Details = $Inserted_Datas_Details . "'" . $Inserted_Data[$i][$b] . "'";
                if ($b < count($Inserted_Data[$i]) - 1) {
                    $Inserted_Datas_Details = $Inserted_Datas_Details . ",";
                }
            }
            $Inserted_Datas_Details = $Inserted_Datas_Details . ")";

            if ($i < count($Inserted_Data) - 1) {
                $Inserted_Datas_Details = $Inserted_Datas_Details . ",";
            }
        }
    }

    $SQL_statement = "INSERT INTO " . $TableName . "(" . $Table_Fields_Details . ")" . " Values " . $Inserted_Datas_Details;
    $SQl_Excute   = mysqli_query($conn, $SQL_statement);
    //echo $SQL_statement;
}
//-------------------------------------------------------------------*/    
function Update($conn, $TableName, $Updade_Fields, $Updade_Data, $Conditions)
{
    mysqli_set_charset($conn, 'SET NAMES utf8');
    mysqli_query($conn, 'SET NAMES utf8');
    $Updated_things = 'SET ';
    for ($i = 0; $i < count($Updade_Fields); $i++) {
        $Updated_things = $Updated_things . $Updade_Fields[$i] . "='" . $Updade_Data[$i] . "'";
        if ($i < count($Updade_Fields) - 1) {
            $Updated_things = $Updated_things . ",";
        }
    }
    $SQL_statement = "Update $TableName $Updated_things $Conditions";
    $SQl_Excute   = mysqli_query($conn, $SQL_statement);
    //echo $SQL_statement;
}
//-------------------------------------------------------------------*/
function Delete($conn, $TableName, $Conditions)
{
    mysqli_set_charset($conn, 'SET NAMES utf8');
    mysqli_query($conn, 'SET NAMES utf8');
    $SQL_statement = "DELETE FROM $TableName $Conditions";
    $SQl_Excute   = mysqli_query($conn, $SQL_statement);
}
/*-------------------------------------------------------------------*/