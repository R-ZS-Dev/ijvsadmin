<?php 
include './include/session.php';
include 'db_con.php';
include 'all_function.php';
if (!isset($_SESSION['ijv_sess'])) {
	echo "<script>window.location='./index.php'</script>";
}
?>