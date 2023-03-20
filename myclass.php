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
    <link rel="stylesheet" href="myclass.css">
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
    <!--<li class="nav-item navi1">
        <a class="nav-link" href="#">Courses</a>
    </li>-->
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



    <section class="sect2">



    <div class="row">
                <h2>My Classes</h2>
					<hr>
                    <?php
                    $val = $_SESSION['id'];
                    date_default_timezone_set("Asia/Dhaka");
                    $sql1 = "SELECT * FROM class_created JOIN registration WHERE registration.id='$val' AND registration.class_id = class_created.class_id";
                    $result1 = mysqli_query($conn,$sql1);
                    $i = 0;
                    while($row1 = mysqli_fetch_assoc($result1))
                    {
                    $var = $row1['class_topic'];
                    $var1 = $row1['class_time'];
                    $var2 = $row1['class_date'];
                    $var3 = date("Y-m-d");
                    $var4 = date("h:i:sa");
                    $var5 = $row1['class_id'];
                    if($var2>=$var3)
                    {
                    $i++;
                    ?>
                <div class="col-md-3 mb-5">
                        <div class="card flex-fill card2">
                            <form action="myclass.php" method="POST">
                            <button type="submit" name="submit_btn<?php echo $i?>" class="d-flex align-items-center btn position-absolute bt-col"><h1 style="padding-right:5px"><i class="bi bi-camera-video-fill fs-3"></i></h1></button>
                            </form>
                            <div class="card-img-top" alt="Book Cover"><img src="image/up.jpg" style="height:212px;width:235px"></div>
                            <div class="card-body">
                            <h5 class="card-title">Topic: <?php echo $var?></h5>
                            <h6 class="card-title">Time: <?php echo $var1?></h6>
                            <h6 class="card-title">Date: <?php echo $var2?></h6>
                            </div>
                        </div>
                        </div>
                    <?php
                    $val1 = 'submit_btn'.$i;
                    if(isset($_POST[$val1]))
                    {
                        $sql10 = "SELECT * FROM class_created WHERE class_id = '$var5'";
                        $result10 = mysqli_query($conn,$sql10);
                        $row10 = mysqli_fetch_assoc($result10);
                       $class_link = $row10['class_link'];
                      echo "
                      <script>
                        window.location.href = '$class_link';
                            </script>
                      ";
                    }
                    
                
                }
                    else
                    {
                        $sql1 = "DELETE FROM class_created WHERE class_id='$var5'";
                    $result = mysqli_query($conn,$sql1);
                    } 
                   
                }
                    
                    ?>
                        
                </div><!--Second Row -->







    </section>


















   

<section class="sect9">
    <footer class="bg-light py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h5>Olympiad</h5>
				<p class="text-muted">Tomorrow's Champion are made Today.We take classes for olympiad preperation and help a student for further preperation</p>
			</div>
			<div class="col-md-4">
				<h5>Contact Us</h5>
				<address>
					CSE Building<br>
					Rajshahi University of Engineering and Technology<br>
					Talaimari, Rajshahi, Bangladesh<br>
				</address>
				<p class="mb-0"><strong>Phone:</strong> 01846027457</p>
				<p><strong>Email:</strong> palashislam1049@gmail.com</p>
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
				<p class="text-muted">&copy; 2023 Olympiad. All rights reserved.</p>
			</div>
		</div>
	</div>
    </footer>
</section>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
   <!-- JavaScript code -->
   <script>
      const videos = document.querySelectorAll('video');
      const modals = document.querySelectorAll('.modal');
      
      modals.forEach(modal => {
        modal.addEventListener('hidden.bs.modal', () => {
          videos.forEach(video => {
            video.pause();
          });
        });
      });
    </script>


</body>
</html>