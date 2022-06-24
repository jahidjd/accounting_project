<?php
include 'inc/database.php';
$id = $_GET['id'];
$q = "delete from account_heads where id=$id";
$db->query($q);
header("Location:account_heads_list.php");
?>