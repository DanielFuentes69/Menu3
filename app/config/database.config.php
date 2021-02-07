<?php

//******************************************************************************
// Initializes the configuration array
//******************************************************************************
$CONFIG = array();
//******************************************************************************
//******************************************************************************
// Connection block database 2
//******************************************************************************
$index = 1;
$CONFIG["DBNAME"][$index] = "agrocenter_website";
$CONFIG["USERNAME"][$index] = "root";
$CONFIG["PASSWORD"][$index] = "";
$CONFIG["PORT"][$index] = "3306";
$CONFIG["HOST"][$index] = "localhost";
$CONFIG["DRIVER"][$index] = "mysql";
$CONFIG["DRIVER_OPTIONS"][$index] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES \"UTF8\"");
$CONFIG["DB_DEBUG"][$index] = false;
//******************************************************************************
//******************************************************************************
// Connection block database 1
//******************************************************************************
$index = 2;
$CONFIG["DBNAME"][$index] = "mertelimportacio_bdwebsite";
$CONFIG["USERNAME"][$index] = "mertelimportacio_padmin";
$CONFIG["PASSWORD"][$index] = "admin2019";
$CONFIG["PORT"][$index] = "5432";
$CONFIG["HOST"][$index] = "localhost";
$CONFIG["DRIVER"][$index] = "pgsql";
$CONFIG["DRIVER_OPTIONS"][$index] = array();
$CONFIG["DB_DEBUG"][$index] = false;
//******************************************************************************
//******************************************************************************
// Reset index
//******************************************************************************
unset($index);
//******************************************************************************
?>