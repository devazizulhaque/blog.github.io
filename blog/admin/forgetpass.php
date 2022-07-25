<?php 
	include '../lib/Session.php';
	Session::init();
?>

<?php include '../config/config.php' ?>
<?php include '../lib/Database.php' ?>
<?php include '../helpers/Format.php' ?>

<?php
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php 
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$email = $fm->validation($_POST['email']);

				$email = mysqli_real_escape_string($db->link, $email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "Invalid Email Address!!!";
                }
                else {
                    $query = "SELECT * FROM tbl_user WHERE email = '$email'";
                    $result = $db->select($query);
                    if ($result != false) {
                        while ($value = $result->fetch_assoc()) {
                            $userid = $value['id'];
                            $username = $value['username'];
                        }
                        $text = substr($email, 0, 3);
                        $rand = rand(10000, 999999);
                        $newpass = "$text$rand";
                        $password = md5($newpass);

                        $query = "UPDATE tbl_user SET password = '$password' WHERE id = '$userid'";
                        $updated_row = $db->update($query);
                        $to = "$email";
                        $from = "azizulhaque4198@gmail.com";
                        $headers = "From: $from\n";
                        $headers .= 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
                        $subject = "Your Password";
                        $message = "Your Username is ".$username." And Your Password is ".$newpass." Pleasse visit website to login...";
                        $sendemail = mail($to, $subject, $message, $headers);
                        if ($sendemail) {
                            echo "<span style='color:green;font-size:18px;'>Please Check Your Email foe new Password!!!</span>";
                        }
                        else{
                            echo "<span style='color:red;font-size:18px;'>Email Not Send!!!</span>";
                        }
                    } else {
                        echo "<span style='color:red;font-size:18px;'>Email Not Exist!!!</span>";
                    }
                }
			}
		?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your Email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Code" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div>
		<div class="button">
			<a href="#">live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>