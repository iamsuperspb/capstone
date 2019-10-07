<?php
session_start();

if(!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')){
	header("location:index");
	exit();
}
if(!isset($_SESSION['usertype']) || (trim($_SESSION['usertype']) == '')){
	header("location:index");
	exit();
}
if(!isset($_SESSION['appno']) || (trim($_SESSION['appno']) == '')){
	header("location:index");
	exit();
}
?>