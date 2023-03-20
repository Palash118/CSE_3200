<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
	include 'config.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <title>Olympiad</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="profile.css">
</head>
<body>

<?php

$var = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = $var ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$str = $row['username'];
$str1 = $str[0];
?>

<section class="sect1">  

<nav class="navbar navbar-expand-lg navbar-light nav_col bg-light">
    <a class="navbar-brand" href="welcome.php">Olympiad</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto navi">
    <li class="nav-item active navi1">
        <a class="nav-link" href="welcome.php">Home</a>
    </li>
    
    <li class="nav-item navi1">
        <a class="nav-link" href="join.php">Live Sessions</a>
    </li>
    <li class="nav-item navi1">
        <a class="nav-link" href="library.php">Library</a>
    </li>
    <li class="nav-item navi1">
        <a class="nav-link" href="contact.php">Contact</a>
    </li>
    
    </ul>
    <ul class="navbar-nav ms-auto navi2">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
        if($row['profile_picture'] != 'k')
        {
            ?>
        <img src="profile/<?php echo $row['profile_picture']?>" alt="Profile picture" class="profile-img">
        <?php }
        else
        {?>
            <span class="badge span_col text-black rounded-circle">
                <h5 class="m-0"><?php echo $str1 ?></h5>
            </span>


        <?php } ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <?php
            if($row['role'] == 0)
            {
            ?>
            <li><a class="dropdown-item card1" href="profile.php"> <i class="bi bi-person me-2"></i>Profile</a></li>
            <li><a class="dropdown-item card1" href="notification.php"><i class="bi bi-bell me-2"></i>Notifications</a></li>
            <hr>
            <li><a class="dropdown-item card1" href="myclass.php"><i class="bi bi-journal me-2"></i>My Classes</a></li>
            <hr>
            <li><a class="dropdown-item card1" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Log out</a></li>
        
            <?php } elseif($row['role']==1)
            {?>
             <li><a class="dropdown-item card1" href="profile.php"> <i class="bi bi-person me-2"></i>Profile</a></li>
            <li><a class="dropdown-item card1" href="notification.php"><i class="bi bi-bell me-2"></i>Notifications</a></li>
            <hr>
            <li><a class="dropdown-item card1" href="myclass.php"><i class="bi bi-journal me-2"></i>My Classes</a></li>
            <li><a class="dropdown-item card1" href="upload.php"><i class="bi bi-arrow-up-circle-fill me-2"></i>Upload</a></li>
            <li><a class="dropdown-item card1" href="notice.php"><i class="bi bi-exclamation-triangle-fill me-2"></i>Notice</a></li>
            <hr>
            <li><a class="dropdown-item card1" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Log out</a></li>
            
            <?php } elseif($row['role']==2)
            {?>
             <li><a class="dropdown-item card1" href="profile.php"> <i class="bi bi-person me-2"></i>Profile</a></li>
            <li><a class="dropdown-item card1" href="notification.php"><i class="bi bi-bell me-2"></i>Notifications</a></li>
            <hr>
            <li><a class="dropdown-item card1" href="myclass.php"><i class="bi bi-journal me-2"></i>My Classes</a></li>
            <li><a class="dropdown-item card1" href="upload.php"><i class="bi bi-arrow-up-circle-fill me-2"></i>Upload</a></li>
            <li><a class="dropdown-item card1" href="superadmin.php"><i class="bi bi-gear-fill me-2"></i>Admin-Panel</a></li>
            <hr>
            <li><a class="dropdown-item card1" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Log out</a></li>
            <?php } ?>
        </ul>
    </li>
    </ul>
</div>
</nav>


</section>
	<?php
	$id = $_SESSION['id'];
	$sql = "SELECT * FROM users WHERE id = '$id';";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$str = $row['username'];
	$str1 = $str[0];
	$num = $row['profile_picture'];
	

	?>

    <section class="sect2">
    <div class="container py-5">
		<div class="row">
			<?php
			if($num == 'k')
			{
			?>
			<div class="col-md-3 mx-4">
				<div class="card shadow-sm">
					<div class="card_top rounded-circle ">
						<h1 class="size1"><?php echo $str1 ?>
					</div>
					<div class="card-body">
						<h3 class="card-title"><?php echo $row['username']?></h3>
						<p class="card-text text-muted"><?php echo $row['email']?></p>
					</div>
				</div>
			</div>
			<?php }
			else
			{
			?>
			<div class="col-md-3 mx-4">
				<div class="card shadow-sm">
				<img src="profile/<?php echo $row['profile_picture']?>" alt="Profile" class="card-img-top img1">
					<div class="card-body">
						<h3 class="card-title"><?php echo $row['username']?></h3>
						<p class="card-text text-muted"><?php echo $row['email']?></p>
					</div>
				</div>
			</div>
			<?php } ?>





			<div class="col-md-8">
				<div class="row">
				<div class="card shadow-sm">
					<div class="card-body">
						<h3 class="card-title">Profile Settings</h3>
						<form action="profile.php" method="POST" enctype="multipart/form-data">
							<div class="mb-3">
								<label for="name" class="form-label">Name</label>
								<input type="text" name="name" class="form-control" id="name" value="<?php echo $row['username']?>">
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">Email address</label>
								<input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']?>">
							</div>
							<div class="mb-3">
								<label for="profile" class="form-label">Add Profile Picture</label>
								<input type="file" name="profile" class="form-control">
							</div>
							<button type="submit" name="save_btn1" class="btn btn-primary">Save Changes</button>
							
						</form>
					</div>
				</div><!-- Row -->
				</div>
				<?php
	if(isset($_POST['save_btn1']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$id = $_SESSION['id'];
		if(!empty($_POST['name']))
		{
			$sql = "UPDATE users SET username='$name' WHERE id='$id';";
			$result = mysqli_query($conn,$sql); 
		}
		if(!empty($_POST['email']))
		{
			$sql = "UPDATE users SET email='$email' WHERE id='$id';";
			$result = mysqli_query($conn,$sql); 
		}
		if($_FILES['profile']['error'] === 0)
		{
			
			$file = $_FILES['profile'];

			$fileName = $_FILES['profile']['name'];
			$fileTmpName = $_FILES['profile']['tmp_name'];
			$fileSize = $_FILES['profile']['size'];
			$fileError = $_FILES['profile']['error'];
			$fileType = $_FILES['profile']['type'];

			$fileExt = explode('.',$fileName);
			$fileActualExt = strtolower(end($fileExt));

			$allowed = array('jpg','jpeg','png');

			if(in_array($fileActualExt,$allowed))
			{
				if($fileError === 0)
				{
					if($fileSize < 1000000)
					{
						$fileNameNew = uniqid('',true).".".$fileActualExt;
						$fileDestination = 'profile/'.$fileNameNew;
						move_uploaded_file($fileTmpName,$fileDestination);
					}
				}
				}
				$sql = "UPDATE users SET profile_picture='$fileNameNew' WHERE id='$id';";
				$result = mysqli_query($conn,$sql);
				
			}
			if($result)
			{
				echo "
					<script>
						alert('You have Successfully Changed your Profile!');
						window.location.href = 'profile.php';
					</script>
					";
			}
	}
	?>
				<div class="row mt-5">
				<div class="card shadow-sm">
					<div class="card-body">
						<h3 class="card-title">Password Change </h3>
						<form action="profile.php" method="POST">
							
                            <div class="mb-3">
								<label for="password" class="form-label">Old Password</label>
								<input type="password" name="old_password" class="form-control" id="password" placeholder="Enter Old Password" required>
							</div>
							<div class="mb-3">
								<label for="password" class="form-label">New Password</label>
								<input type="password" name="new_password" class="form-control" id="password" placeholder="Enter New Password">
							</div>
                            <div class="mb-3">
								<label for="password" class="form-label">Confirm Password</label>
								<input type="password" name="confirm_password" class="form-control" id="password" placeholder="Confirm Password">
							</div>
							<button type="submit" name="save_btn2" class="btn btn-primary">Save Changes</button>
						</form>
					</div>
				</div><!-- Row -->
				</div>

				<?php
					if(isset($_POST['save_btn2']))
					{
						$old_password = $_POST['old_password'];
						$id = $_SESSION['id'];
						$sql = "SELECT * FROM users WHERE id = '$id';";
						$result = mysqli_query($conn,$sql);
						$row = mysqli_fetch_assoc($result);
						$password = $row['password'];
						if(!password_verify($old_password, $password))
						{
							echo "
							<script>
								alert('Please Enter Password Correctly');
								window.location.href = 'profile.php';
							</script>
							";
						}
						else
						{
							if(empty($_POST['new_password']))
							{
								echo "
								<script>
									alert('Please Enter the new Password!');
									window.location.href = 'profile.php';
								</script>
								";
							}
							else
							{
								$new_password = $_POST['new_password'];
								$confirm_password = $_POST['confirm_password'];
								if($new_password != $confirm_password)
								{
									echo "
								<script>
									alert('Password Should be Matched!');
									window.location.href = 'profile.php';
								</script>
								";
								}
								else
								{
									$hash_password = password_hash($new_password, PASSWORD_DEFAULT);
									$sql = "UPDATE users SET password='$hash_password' WHERE id='$id';";
									$result = mysqli_query($conn,$sql);
									if($result)
									{
										echo "
										<script>
											alert('You change your password Successfully!');
											window.location.href = 'profile.php';
										</script>
										";
									}
								}
							}

						}
						
					}


					?>
				
			</div>
			
		</div>
	</div>
    </section>

	

    <section class="sect3">
    <footer class="bg-light py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h5>Company Name</h5>
				<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et tortor vitae lectus consectetur elementum a a elit.</p>
			</div>
			<div class="col-md-4">
				<h5>Contact Us</h5>
				<address>
					1234 Main Street<br>
					Suite 200<br>
					New York, NY 10001<br>
				</address>
				<p class="mb-0"><strong>Phone:</strong> (123) 456-7890</p>
				<p><strong>Email:</strong> info@company.com</p>
			</div>
			<div class="col-md-4">
				<h5>Follow Us</h5>
				<ul class="list-unstyled d-flex ms-5">
					<li><a href="#"><i class="bi bi-facebook ms-5 fs-2"></i></a></li>
					<li><a href="#"><i class="bi bi-twitter ms-4 fs-2"></i></a></li>
					<li><a href="#"><i class="bi bi-instagram ms-4 fs-2"></i></a></li>
					<li><a href="#"><i class="bi bi-linkedin ms-4 fs-2"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-md-12 text-center">
				<p class="text-muted">&copy; 2023 Company Name. All rights reserved.</p>
			</div>
		</div>
	</div>
</footer>

    </section>

   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        
</body>
</html>