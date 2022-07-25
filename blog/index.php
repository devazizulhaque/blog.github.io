<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">

		<!-- start pagination -->
		<?php 
			$per_page = 3;
			if (isset($GET['page'])) {
				$page = $GET['page'];
			}
			else{
				$page = 1;
			}
			$start_from = ($page-1) * $per_page;
			
		?>
		<!-- end pagination -->

		<?php
			$query = "SELECT * FROM tbl_post limit $start_from, $per_page";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()){
		?>
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
			<h4><?php echo $fm->formatDate($result['date']); ?>, by <a href="#"><?php echo $result['author']; ?></a></h4>
			 <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
			<?php echo $fm->textShorten($result['body']); ?>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
			</div>
		</div>
		<?php } ?> </-- end while loop -->

		<!-- start pagination -->
		<div class="pagination">
		<?php
			$query = "SELECT * FROM tbl_post";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_pages = ceil($total_rows / $per_page);
			echo "<a class='pagination' href='index.php?page=1'>".'First Page'."</a>";
			for ($i=1; $i <= $total_pages; $i++) {
				echo "<a class='pagination' href='index.php?page=".$i."'>".$i."</a>";
			};
			echo "<a class='pagination' href='index.php?page=$total_pages'>".'Last Page'."</a></span>"; 
		?>
		</div>
		<!-- end pagination -->

		<?php } 
		else { header("Location:404.php"); } 
		?>
	</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>