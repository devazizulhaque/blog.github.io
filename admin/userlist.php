<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
	<div class="box round first grid">
	<h2>User List</h2>
	<?php 
		if(isset($_GET['deluser'])) {
			$delid = $_GET['deluser'];
			$delquery = "DELETE FROM tbl_user WHERE id = '$delid'";
			$deluser = $db->delete($delquery);
			if($deluser) {
				echo "<span class='success'>User Deleted Successfully</span>";
			} else {
				echo "<span class='error'>User Not Deleted</span>";
			}
		}
	?>
		<div class="block">        
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Details</th>
                    <th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * FROM tbl_user ORDER BY id DESC";
					$user = $db->select($query);
					if ($user) {
						$i = 0;
						while ($result = $user->fetch_assoc()) {
							$i++;
							?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['username']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $fm->textShorten($result['details'], 30); ?></td>
                    <td>
                        <?php 
                            if ($result['role'] == '1') {
                                echo "Admin";
                            }
                            elseif ($result['role'] == '2') {
                                echo "Author";
                            }
                            else{
                                echo "Editot";
                            }
                        ?>
                    </td>
					<td>
						<a href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a> 
					<?php 
                        if (Session::get('userRole') == '1') {
                            ?>
					|| 
					<a onclick="return confirm('Are you sure to Delete!!');" href="?deluser=<?php echo $result['id']; ?>">Delete</a>
						<?php
                        }
						?>
				</td>
				</tr>
				<?php } } ?>
			</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>

<?php include 'inc/footer.php'; ?>