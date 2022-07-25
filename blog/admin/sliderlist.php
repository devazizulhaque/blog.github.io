<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Slider List</h2>
		<div class="block">  
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="5%">No.</th>
					<th width="50%">Slider Title</th>
					<th width="35%">Image</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * FROM tbl_slider";
					$slider = $db->select($query);
					if ($slider) {
						$i = 0;
                        while ($result = $slider->fetch_assoc()) {
                            $i++; ?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td>
						<img src="<?php echo $result['image']; ?>" height="40px" width="150px" alt="">
					</td>
					<td>
						<?php 
                            if (Session::get('userRole') == '1') {
                                ?>
						<a href="editslider.php?editsliderid=<?php echo $result['id']; ?>">Edit</a>
						 || 
						<a onclick="return confirm('Are you sure to Delete!!!');" href="deleteslider.php?delsliderid=<?php echo $result['id']; ?>">Delete</a>
						<?php
                            } ?>
					</td>
				</tr>
				<?php
                    } } 
				?>
			</tbody>
		</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>

<?php include 'inc/footer.php'; ?>
