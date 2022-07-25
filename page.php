<?php include 'inc/header.php'; ?>

<?php 
	$pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);
	if (!isset($pageid) || $pageid == NULL) {
		header("Location:404.php");
	} else {
		$id = $pageid;
	}
?>

<?PHP 
	$pagequery = "SELECT * FROM tbl_page WHERE id = $id";
	$pagedetails = $db->select($pagequery);
	if ($pagedetails) {
		while ($result = $pagedetails->fetch_assoc()) {
			?>
<div class="contentsection contemplete clear" style="display:flex;">
	<div class="maincontent clear" style="height:fit-content;">
			<div class="about">
				<h2><?php echo $result['name']; ?></h2>
				<?php echo $result['body']; ?>
	</div>
</div>
<?php
		} // end of while loop
	} // end of if condition
	else{
		header("Location:404.php");
	}
?>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>