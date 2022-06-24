<?php
include 'inc/database.php';
$type = $_POST['type'];
$name = $_POST['name'];
$id=$_POST['id'];
$q = "update account_heads set type='$type', name='$name' where id='$id'";
$db->query($q);
header("Location:account_heads_list.php");
?>