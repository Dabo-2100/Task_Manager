<?php
include "/xampp/htdocs/taskato/php/backend/Database_Connection.php";
include "/xampp/htdocs/taskato/php/backend/Database_Function.php";
$Action_name = @$_GET['Action_name'];
if($Action_name == "get_user_tasks"){
    echo "i'm from php";
}
if($Action_name == "get_user_date_of_brith"){

}