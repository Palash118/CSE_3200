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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf_viewer.css">

    <title>Olympiad</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="library.css">
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
    <a class="navbar-brand" href="#">Olympiad</a>
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
            <li><a class="dropdown-item card1" href="upload.php"><i class="bi bi-arrow-up-circle-fill me-2"></i>Upload</a></li>
            <li><a class="dropdown-item card1" href="notice.php"><i class="bi bi-exclamation-triangle-fill me-2"></i>Notice</a></li>
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

 <!-- Hero Section -->
 <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 pt-5">
                    <h1 class="text-center mb-3">Unlimited Reading, Unlimited Listening</h1>
                    <form action="library.php" method="POST" class="d-flex justify-content-center">
                    <input class="form-control me-2 input-sm" type="search" name="search_val" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary btn-lg" type="submit" name="search1">Search</button>
                    </form>
                    <p class="text-center mb-5">Enjoy unlimited access to books, audiobooks, magazines, and more.</p>
                </div>
            </div>
        </div>
    </section>
    <?php

    if(isset($_POST['search1']))
    {
        $val = trim($_POST['search_val']);
        $sql2 = "SELECT * FROM video WHERE video_name Like '%$val%';";
        $result2 = mysqli_query($conn,$sql2);

        $sql3 = "SELECT * FROM resource WHERE book_name LIKE '%$val%'";
        $result3 = mysqli_query($conn,$sql3);
        $num_rows2 = mysqli_num_rows($result2);
        $num_rows3 = mysqli_num_rows($result3);
        if($num_rows2 != 0)
        {
        ?>

<!-- Search Section -->
<section class="featured mt-5">
        <div class="container">
            <div class="row">
            <div class="row">
                <h4>Search Results</h4>
					<hr>
                    <?php
                   
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result2))
                    {
                    $i++;
                    $var = $row['video_name'];
                    $var1 = basename($var, '.mp4');
                    $var2 = $var1.'.mp4';
                    $var3 = $row['video_id'];
                    ?>
                <div class="col-md-3 mb-5">
                    <div class="card flex-fill card3">
                        <div class="card-img-top position-relative" alt="Book Cover">
                            <video src="video/<?php echo $var2 ?>" style="height:auto;width:242px;"></video>
                            <form action="library.php" method="POST">
                            <?php

                                $var6 = $_SESSION['id'];
                                $sql6 = "SELECT * FROM users WHERE id = $var6;";
                                $result6 = mysqli_query($conn,$sql6);
                                $row6 = mysqli_fetch_assoc($result6);
                                if($row6['role'] == 1)
                                {?>
                                <button type="submit" name="video_btn<?php echo $i ?>" class="btn position-absolute top-0 end-0 bt-col"><i class="bi bi-trash icon1"></i></button>
                                <?php } ?>
                            </form>
                        </div>
                        <div class="card-body">
                        <h6 class="card-title"><?php echo $var1 ?></h6>
                        <a href="#" class="btn btn5 video-thumbnail" data-bs-toggle="modal" data-bs-target="#video-modal<?php echo $i ?>">Play Now</a>
                        </div>
                    </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="video-modal<?php echo $i ?>" tabindex="-1" aria-labelledby="video-modal-label<?php echo $i ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="video-modal-label<?php echo $i ?>"><?php echo $var1 ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <video id="video" src="video/<?php echo $var2 ?>" controls style="height:auto;width:100%;"></video>
                        </div>
                        </div>
                    </div>
                    </div>
                    <?php
                    
                    $val = 'video_btn'.$i;
                    if(isset($_POST['video_btn'.$i]))
                    {
                        $sql1 = "DELETE FROM video WHERE video_id='$var3'";
                        $result1 = mysqli_query($conn,$sql1);
                        if($result1)
                        {
                            echo"
                            <script>
                                alert('You have Successfully deleted the item!');
                                window.location.href = 'library.php';
                            </script>
                            ";
                        }
                    }
                }
                
                
                 ?>
                        
                </div><!--Second Row -->
            </div><!-- First Row -->
        </div><!--container-->
    </section>
        
        <?php
        }
        if($num_rows3 != 0)
        {
            ?>
     <!-- Search Section -->
     <section class="featured mt-5">
        <div class="container">
            <div class="row">
                <div class="row">
                <h2>Search Results</h2>
					<hr>
                    <?php
                   
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result3))
                    {
                    $var = $row['book_name'];
                    $var1 = basename($var, '.pdf');
                    $var2 = $var1.'.jpg';
                    $var3 = $row['book_id'];
                    $i++;
                    ?>
                <div class="col-md-3 mb-5">
                        <div class="card flex-fill card2">
                            <div class="card-img-top position-relative" alt="Book Cover">
                                <img src="image/<?php echo $var2 ?>" class="img-fluid" style="height:200px;width:244px">
                                <form action="library.php" method="POST">
                                <?php

                                $var6 = $_SESSION['id'];
                                $sql6 = "SELECT * FROM users WHERE id = $var6;";
                                $result6 = mysqli_query($conn,$sql6);
                                $row6 = mysqli_fetch_assoc($result6);
                                if($row6['role'] == 1)
                                {?>
                                <button type="submit" name="book_btn<?php echo $i ?>" class="btn position-absolute top-0 end-0 bt-col"><i class="bi bi-trash icon1"></i></button>
                                <?php } ?>
                            </form>
                            </div>
                            <div class="card-body">
                            <h6 class="card-title"><?php echo $var1 ?></h6>
                            <a href="resource/<?php echo $var?>" class="btn btn5">Read Now</a>
                            </div>
                        </div>
                        </div>
                    <?php
                    
                    $val = 'book_btn'.$i;
                    if(isset($_POST['book_btn'.$i]))
                    {
                        $sql1 = "DELETE FROM resource WHERE book_id='$var3'";
                        $result1 = mysqli_query($conn,$sql1);
                        if($result1)
                        {
                            echo"
                            <script>
                                alert('You have Successfully deleted the item!');
                                window.location.href = 'library.php';
                            </script>
                            ";
                        }
                    }
                }
                
                
                 ?>
                        
                </div><!--Second Row -->
            </div><!-- First Row -->
        </div><!--container-->
    </section>


    <?php    }
    }
    else{
        ?>
    <!-- video Section -->
   <section class="featured mt-5">
        <div class="container">
            <div class="row">
            <div class="row">
                <h4>Recorded Class</h4>
					<hr>
                    <?php
                    $sql = "SELECT * FROM video ORDER BY cur_time DESC";
                    $result = mysqli_query($conn,$sql);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result))
                    {
                    $i++;
                    $var = $row['video_name'];
                    $var1 = basename($var, '.mp4');
                    $var2 = $var1.'.mp4';
                    $var3 = $row['video_id'];
                    ?>
                <div class="col-md-3 mb-5">
                    <div class="card flex-fill card3">
                        <div class="card-img-top position-relative" alt="Book Cover">
                            <video src="video/<?php echo $var2 ?>" style="height:auto;width:242px;"></video>
                            <form action="library.php" method="POST">
                            <?php

                                $var6 = $_SESSION['id'];
                                $sql6 = "SELECT * FROM users WHERE id = $var6;";
                                $result6 = mysqli_query($conn,$sql6);
                                $row6 = mysqli_fetch_assoc($result6);
                                if($row6['role'] == 1)
                                {?>
                                <button type="submit" name="video_btn<?php echo $i ?>" class="btn position-absolute top-0 end-0 bt-col"><i class="bi bi-trash icon1"></i></button>
                                <?php } ?>
                            </form>
                        </div>
                        <div class="card-body">
                        <h6 class="card-title"><?php echo $var1 ?></h6>
                        <a href="#" class="btn btn5 video-thumbnail" data-bs-toggle="modal" data-bs-target="#video-modal<?php echo $i ?>">Play Now</a>
                        </div>
                    </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="video-modal<?php echo $i ?>" tabindex="-1" aria-labelledby="video-modal-label<?php echo $i ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="video-modal-label<?php echo $i ?>"><?php echo $var1 ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <video id="video" src="video/<?php echo $var2 ?>" controls style="height:auto;width:100%;"></video>
                        </div>
                        </div>
                    </div>
                    </div>
                    <?php
                    
                    $val = 'video_btn'.$i;
                    if(isset($_POST['video_btn'.$i]))
                    {
                        $sql1 = "DELETE FROM video WHERE video_id='$var3'";
                        $result1 = mysqli_query($conn,$sql1);
                        if($result1)
                        {
                            echo"
                            <script>
                                alert('You have Successfully deleted the item!');
                                window.location.href = 'library.php';
                            </script>
                            ";
                        }
                    }
                }
                
                
                 ?>
                        
                </div><!--Second Row -->
            </div><!-- First Row -->
        </div><!--container-->
    </section>

     <!-- Book Section -->
    <section class="featured mt-5">
        <div class="container">
            <div class="row">
                <div class="row">
                <h2>Books and Resources</h2>
					<hr>
                    <?php
                    $sql = "SELECT * FROM resource ORDER BY cur_time DESC";
                    $result = mysqli_query($conn,$sql);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result))
                    {
                    $var = $row['book_name'];
                    $var1 = basename($var, '.pdf');
                    $var2 = $var1.'.jpg';
                    $var3 = $row['book_id'];
                    $i++;
                    ?>
                <div class="col-md-3 mb-5">
                        <div class="card flex-fill card2">
                            <div class="card-img-top position-relative" alt="Book Cover">
                                <img src="image/<?php echo $var2 ?>" class="img-fluid" style="height:200px;width:244px">
                                <form action="library.php" method="POST">
                                <?php

                                $var6 = $_SESSION['id'];
                                $sql6 = "SELECT * FROM users WHERE id = $var6;";
                                $result6 = mysqli_query($conn,$sql6);
                                $row6 = mysqli_fetch_assoc($result6);
                                if($row6['role'] == 1)
                                {?>
                                <button type="submit" name="book_btn<?php echo $i ?>" class="btn position-absolute top-0 end-0 bt-col"><i class="bi bi-trash icon1"></i></button>
                                <?php } ?>
                            </form>
                            </div>
                            <div class="card-body">
                            <h6 class="card-title"><?php echo $var1 ?></h6>
                            <a href="resource/<?php echo $var?>" class="btn btn5">Read Now</a>
                            </div>
                        </div>
                        </div>
                    <?php
                    
                    $val = 'book_btn'.$i;
                    if(isset($_POST['book_btn'.$i]))
                    {
                        $sql1 = "DELETE FROM resource WHERE book_id='$var3'";
                        $result1 = mysqli_query($conn,$sql1);
                        if($result1)
                        {
                            echo"
                            <script>
                                alert('You have Successfully deleted the item!');
                                window.location.href = 'library.php';
                            </script>
                            ";
                        }
                    }
                }
                
                
                 ?>
                        
                </div><!--Second Row -->
            </div><!-- First Row -->
        </div><!--container-->
    </section>
 <?php
    }
    ?>

   


    <section class="sect3">
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