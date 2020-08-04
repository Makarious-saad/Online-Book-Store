<?php

//action.php

session_start();

if($_POST["action"] == 'add'){
  $_SESSION["wishlist"][] = $_POST["product_id"];
}elseif($_POST["action"] == 'delete_once'){
  $array = $_SESSION["wishlist"];
  foreach (array_keys($_SESSION["wishlist"], $_POST["product_id"]) as $key) {
      unset($array[$key]);
  }
  $_SESSION["wishlist"] = $array;
}elseif($_POST["action"] == 'delete_all'){
  $_SESSION["wishlist"] = array();
}


print_r($_SESSION["wishlist"]);
