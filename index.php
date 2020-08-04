<?php
@include("include/pages.php");
$home = new Subsystem;


if(@$_GET['page'] == 'book'){
	$home->book();
}elseif(@$_GET['page'] == 'page'){
	$home->page();
}else{
	$home->home();
}
?>
