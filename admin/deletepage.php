<?php 
	include '../lib/Session.php';
	Session::checkSession();
?>
<?php include '../config/config.php' ?>
<?php include '../lib/Database.php' ?>
<?php include '../helpers/Format.php' ?>
<?php
	$db = new Database();
	$fm = new Format();
?>
<?php 
    if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
        echo "<script>window.location = 'index.php.php';</script>";
    } else {
        $pageid = $_GET['delpage'];

        $delquery = "DELETE FROM tbl_page WHERE id = '$pageid'";
        $delData = $db->delete($delquery);
        if ($delData) {
            echo "<script>window.location = 'index.php';</script>";
        } else {
            echo "<span class='error'>Page not deleted!</span>";
        }
    }
?>