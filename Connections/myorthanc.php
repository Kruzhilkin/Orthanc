<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_myorthanc = "localhost";
$database_myorthanc = "***";
$username_myorthanc = "***";
$password_myorthanc = "***";
$myorthanc = mysql_pconnect($hostname_myorthanc, $username_myorthanc, $password_myorthanc) or trigger_error(mysql_error(),E_USER_ERROR); 
?>