<?php
include_once 'shared.php';
//creating or cleaning all tables. DANGER!!!
mysqli_query($mysqli,"DROP TABLE IF EXISTS sites");
mysqli_query($mysqli,"CREATE TABLE sites(id varchar(15) NOT NULL UNIQUE, url_long varchar(250) NOT NULL, usage_count int DEFAULT 0);");
mysqli_query($mysqli,"DROP TABLE IF EXISTS config");
mysqli_query($mysqli,"CREATE TABLE config(name varchar(10) NOT NULL UNIQUE, value varchar(10));");
mysqli_query($mysqli,"DROP TABLE IF EXISTS errors");
mysqli_query($mysqli,"CREATE TABLE config(code int NOT NULL UNIQUE, message text);");
//settings
mysqli_query($mysqli,"INSERT INTO config VALUES ('next','a');");		//value for the _next_ item
mysqli_query($mysqli,"INSERT INTO config VALUES ('prefix','https://');");// https:// prefix by default
mysqli_query($mysqli,"INSERT INTO config VALUES ('count_fail','1');");	// 1 if we should count failed attends to open shorten link 

/*
 * Error codes description. 
 * May be used to describe every error code
 * Willwork with any code except 200(OK)
 * Notice that code is INT 
 */
mysqli_query($mysqli,"INSERT INTO config VALUES (404,'Still this page may be avaliable with VPN or another similar service.');");

?>
