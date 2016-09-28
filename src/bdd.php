<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 26/09/16
 * Time: 12:08
 */

function GetConnection ()
{
    include "configbase.php";

    $mysqli = new mysqli(host(), user(), password(), db()) ;
    if (false === $mysqli-> connect_errno) {
        echo "Failed to connect to MySQL : (" . $mysqli->connect_errno . " )" . $mysqli->connect_error;
        die();
    }
    return $mysqli;
}

function ExecSql($mysqli, $sql) {
    if (!$result = $mysqli-> query($sql)) {
        echo "failed to run query :(" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
    return $result;
}