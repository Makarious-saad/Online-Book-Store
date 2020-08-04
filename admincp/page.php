<?php
include("../include/functions.php");

if(@$_GET['page'] != NULL){
	$file = $_GET['page'].".php";
	if(!file_exists($file)){
		echo 'Error 404 not Found <br> Contact us E-book <br> <a href="../">Back to home</a>';
	}else{
		@include($file);
	}
} ?>
