<?php
$dbhost 	= "koo2dzw5dy.database.windows.net";
$db 		= "SenaQuiz";
$user 		= "TSI@koo2dzw5dy.database.windows.net";
$password 	= "SistemasInternet123";
$dsn 		= "Driver={SQL Server};Server=koo2dzw5dy.database.windows.net;Port=1433;Database=SenaQuiz;";

$db = odbc_connect($dsn, $user, $password);
//error_reporting(E_ALL);
//ini_set('display_errors', 'none');