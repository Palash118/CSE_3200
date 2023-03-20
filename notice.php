<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
include 'config.php';

if(isset($_POST['upload1']))
{
    $title = $_POST['title'];
    $detail = $_POST['detail'];

    $sql1 = "INSERT INTO notice(title,detail) VALUES ('$title','$detail');";
    $stmt1 = mysqli_query($conn, $sql1);
    
    if($stmt1)
    {
        echo"
            <script>
                alert('Notice Upload Successful!');
                window.location.href = 'notice.php';
            </script>
            ";
    }
}

if(isset($_POST['upload2']))
{
    $topic1 = $_POST['topic1'];
    $time1 = $_POST['time1'];
    $date1 = $_POST['date1'];
    $class_link = $_POST['class_link'];

    $var1 = rand(1000,99999);
    $var2 = rand(99999,11000000);

    $sql = "INSERT INTO class_created(class_topic,class_date,class_time,class_code,class_pass,class_link) VALUES ('$topic1','$date1','$time1','$var1','$var2','$class_link');";
    $stmt = mysqli_query($conn, $sql);
    
    if($stmt)
    {
        echo"
            <script>
                alert('Notice Upload Successful!');
                window.location.href = 'notice.php';
            </script>
            ";
    }
}

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
    <link rel="stylesheet" href="notice.css">
   
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

<section class="sect2 pb-5 pt-4">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
            <h2>Notifications</h2>
        <hr>
                <form action="notice.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email address">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Notification Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Notification Title">
                    </div>

                    <div class="mb-3">
                        <label for="noti" class="form-label">Notification Detail</label>
                        <textarea class="form-control" name="detail" id="Textarea1" rows="5" placeholder="Enter Notification Detail"></textarea>
                    </div>
                    
                    <button type="submit" name="upload1" class="btn btn_up">Submit</button>
                </form>
              
            </div>
        </div>
    </div>
    </section>


    <section class="sect2 pb-5 pt-4">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
            <h2>Live Class Announcement</h2>
        <hr>
                <form action="notice.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email address">
                    </div>
                    <div class="mb-3">
                        <label for="tile" class="form-label">Class Topic</label>
                        <input type="text" name="topic1" class="form-control" id="title" placeholder="Enter Class Title">
                    </div>

                    <div class="mb-3">
                        <label for="tile" class="form-label">Live Class Date</label>
                        <input type="date" name="date1" class="form-control" id="title">
                    </div>

                    <div class="mb-3">
                        <label for="tile" class="form-label">Live Class Time</label>
                        <input type="time" name="time1" class="form-control" id="title">
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Class Link</label>
                        <input type="text" class="form-control" id="class_link" name="class_link" placeholder="Enter your Class Link">
                    </div>

                    
                    <button type="submit" name="upload2" class="btn btn_up">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </section>




<section class="sect3 pt-5">
    <footer class="bg-light mt-5 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Contact Information</h4>
                    <ul class="list-unstyled">
                        <li><strong>Address</strong>
                        <address>
                            CSE Building<br>
                            Rajshahi University of Engineering and Technology<br>
                            Talaimari, Rajshahi, Bangladesh<br>
                        </address></li>
                        <li><strong>Phone:</strong> 01846027457</li>
                        <li><strong>Email:</strong> palashislam1049@gmail.com</li>
                    </ul>
                </div>
                <div class="col-md-8">
                    <h4>Stay Connected</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Enter your email address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn_up mb-3">Subscribe</button>
                            </div>
                        </div>
                    </form>
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
    <!-- Bootstrap 5 JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

</body>
</html>
