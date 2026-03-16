<?php
$ini = parse_ini_file('userpw.ini',FALSE);
//MySQLに接続
$db = new PDO($ini['DBSERVER'], $ini['DBUSER'], $ini['DBPASSWORD']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
