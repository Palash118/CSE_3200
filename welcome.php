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
    <link rel="stylesheet" href="welcome.css">
</head>
<body>
    <?php

        $var = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = $var ";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $str = $row['username'];
        $str1 = $str[0];
        $email_name = $row['email'];
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
    <div class="h_page py-5">
		<div class="row">
			<div class="col-md-3">
				<div class="card shadow-sm">
                    <?php
                    if($row['profile_picture'] != 'k')
                    {
                    ?>
					<img src="profile/<?php echo $row['profile_picture']?>" alt="Profile Picture" class="card-img-top img1">
                    <?php }
                    else
                    { ?>
                        <div class="span_col text-center text-black rounded-circle d-flex justify-content-center align-items-center" style="width: 190px; height: 190px; margin-left:70px;">
                        <span class="font-weight-bold" style="font-size: 130px;"><?php echo $str1 ?></span>
                        </div>

                    <?php } ?>
					<div class="card-body"  style="margin:auto">
						<h4 class="card-title"><?php echo $str ?></h4>
						<p class="card-text text-muted"><?php echo $email_name ?></p>
                        <hr>
                        <a href="myclass.php" class="card1"><h5>My Classes </h5></a>
                        <hr>
                        <a href="index.php" class="card1"><h5> Chat Room </h5></a>
                        <a href="notification.php" class="card1"><h5> Notifications </h5></a>
					</div>
				</div>
			</div>
			<div class="col-md-9">
            <div class="row">
                <h4>Live Classes</h4>
					<hr>
                    <?php
                    date_default_timezone_set("Asia/Dhaka");
                    $sql = "SELECT * FROM class_created ORDER BY class_date";
                    $result = mysqli_query($conn,$sql);
                    $num = mysqli_num_rows($result);
                    $num5 = 0;
                    if($num>0)
                    {
                    while($row = mysqli_fetch_assoc($result))
                    {
                    $var = $row['class_topic'];
                    $var1 = $row['class_time'];
                    $var2 = $row['class_date'];
                    $var3 = date("Y-m-d");
                    $var4 = date("H:i:s");
                    $var5 = $row['class_id'];
                    if($var2==$var3)
                    {
                        if($var1<$var4)
                        {
                            $num5++;
                    ?>
                <div class="col-md-3 mb-5">
                        <a href="join.php" style="text-decoration:none;color:black">
                        <div class="card flex-fill card2">
                            <div class="card-img-top" alt="Book Cover"><img src="image/live.jpg" style="height:212px;width:235px"></div>
                            <div class="card-body">
                            <h5 class="card-title">Topic: <?php echo $var ?></h5>
                            <h6 class="card-title">Time: <?php echo $var1 ?></h6>
                            <h6 class="card-title">Date: <?php echo $var2 ?></h6>
                            </div>
                        </div>
                    </a>
                        </div>
                    <?php }}
                    else
                    {
                        $sql1 = "DELETE FROM class_created WHERE class_id='$var5' AND valid=1";
                        $result1 = mysqli_query($conn,$sql1);
                    }
                }
            }
            if($num5 == 0)
            {
            ?>
                <div class="extra">
                        <p>There is no live video at this moment</p>
                    </div>
                    <?php
            }   
                    ?>
                    </div>

                <div class="row">
                <h4>Upcoming Classes</h4>
					<hr>
                    <?php
                    date_default_timezone_set("Asia/Dhaka");
                    $sql = "SELECT * FROM class_created ORDER BY class_date";
                    $result = mysqli_query($conn,$sql);
                    $i = 0;
                    $num = mysqli_num_rows($result);
                    if($num>0)
                    {
                    while($row = mysqli_fetch_assoc($result))
                    {
                    $var = $row['class_topic'];
                    $var1 = $row['class_time'];
                    $var2 = $row['class_date'];
                    $var3 = date("Y-m-d");
                    $var4 = date("H:i:s");
                    $var5 = $row['class_id'];
                    if($var2>$var3)
                    {
                        $i++;
                    ?>
                <div class="col-md-3 mb-5">
                        <div class="card flex-fill card2">
                            <form action="welcome.php" method="POST">
                            <button type="submit" name="submit_btn<?php echo $i ?>" class="d-flex align-items-center btn position-absolute bt-col"><h1 style="padding-right:5px">+</h1></button>
                            </form>
                            <div class="card-img-top" alt="Book Cover"><img src="image/up.jpg" style="height:212px;width:235px"></div>
                            <div class="card-body">
                            <h5 class="card-title">Topic: <?php echo $var ?></h5>
                            <h6 class="card-title">Time: <?php echo $var1 ?></h6>
                            <h6 class="card-title">Date: <?php echo $var2 ?></h6>
                            </div>
                        </div>
                        </div>
                    <?php
                    $val = 'submit_btn'.$i;
                    $name_id = $_SESSION['id'];
                    if(isset($_POST[$val]))
                    {
                        $sql10 = "SELECT * FROM registration WHERE class_id = '$var5' AND id = '$name_id';";
                        $result10 = mysqli_query($conn,$sql10);
                        $var10 = mysqli_num_rows($result10);
                        
                        if($var10 != 0)
                        {
                            echo"
                                <script>
                                    alert('You are already registered!');
                                    window.location.href = 'welcome.php';
                                </script>
                                ";
                        }
                        else
                        {
                            $var11 = $_SESSION['id'];
                            $sql11 = "INSERT INTO registration(id,class_id) VALUES('$var11','$var5')";
                            $result11 = mysqli_query($conn,$sql11);
                            if($result11){
                                $sql12 = "SELECT * FROM class_created WHERE class_id='$var5'";
                                $result12 = mysqli_query($conn,$sql12);
                                $row12 = mysqli_fetch_assoc($result12);
                                $var_topic = $row12['class_topic'];
                                $var_code = $row12['class_code'];
                                $var_pass = $row12['class_pass'];
                                $detail = 'Class Code: '.$var_code.'  Class Password: '.$var_pass;
                                $name_id = $_SESSION['id'];
                                $sql13 = "INSERT INTO notice(id,title,detail) VALUES ('$name_id','$var_topic','$detail');";
                                $stmt = mysqli_query($conn, $sql13);
                                if($stmt)
                                {
                                    echo"
                                        <script>
                                            alert('You are Registerred Successfully!');
                                            window.location.href = 'welcome.php';
                                        </script>
                                        ";
                                }
                            }
                        }
                    }
                    
                
                
            }
            else if($var2==$var3)
            {
                if($var4 < $var1)
                {
                $i++;
            ?>
        <div class="col-md-3 mb-5">
                <div class="card flex-fill card2">
                    <form action="welcome.php" method="POST">
                    <button type="submit" name="submit_btn<?php echo $i ?>" class="d-flex align-items-center btn position-absolute bt-col"><h1 style="padding-right:5px">+</h1></button>
                    </form>
                    <div class="card-img-top" alt="Book Cover"><img src="image/up.jpg" style="height:212px;width:235px"></div>
                    <div class="card-body">
                    <h5 class="card-title">Topic: <?php echo $var ?></h5>
                    <h6 class="card-title">Time: <?php echo $var1 ?></h6>
                    <h6 class="card-title">Date: <?php echo $var2 ?></h6>
                    </div>
                </div>
                </div>
            <?php
            $val = 'submit_btn'.$i;
            if(isset($_POST[$val]))
            {
                $name_val = $_SESSION['id'];
                $sql10 = "SELECT * FROM registration WHERE class_id = '$var5' AND id = '$name_val'";
                $result10 = mysqli_query($conn,$sql10);
                $var10 = mysqli_num_rows($result10);
                
                if($var10 != 0)
                {
                    echo"
                        <script>
                            alert('You are already registered!');
                            window.location.href = 'welcome.php';
                        </script>
                        ";
                }
                else
                {
                    $var11 = $_SESSION['id'];
                    $sql11 = "INSERT INTO registration(id,class_id) VALUES('$var11','$var5')";
                    $result11 = mysqli_query($conn,$sql11);
                    if($result11){
                        $sql12 = "SELECT * FROM class_created WHERE class_id='$var5'";
                        $result12 = mysqli_query($conn,$sql12);
                        $row12 = mysqli_fetch_assoc($result12);
                        $var_topic = $row12['class_topic'];
                        $var_code = $row12['class_code'];
                        $var_pass = $row12['class_pass'];
                        $detail = 'Class Code: '.$var_code.'  Class Password: '.$var_pass;
                        $name_val = $_SESSION['id'];
                        $sql13 = "INSERT INTO notice(id,title,detail) VALUES ('$name_val','$var_topic','$detail');";
                        $stmt = mysqli_query($conn, $sql13);
                        if($stmt)
                        {
                            echo"
                                <script>
                                    alert('You are Registerred Successfully!');
                                    window.location.href = 'welcome.php';
                                </script>
                                ";
                        }
                    }
                }
            }
            
        
        }
        else
        {
            $sql1 = "UPDATE class_created SET valid=1 WHERE class_id='$var5'";
        $result1 = mysqli_query($conn,$sql1);
        } 
    }
                    else
                    {
                        $sql1 = "UPDATE class_created SET valid=1 WHERE class_id='$var5'";
                    $result2 = mysqli_query($conn,$sql1);
                    } 
                   
                }
            }
            else
            {
            ?>
            <div class="extra">
                        <p>There is no upcoming video at this moment</p>
                    </div>
            <?php
            } 
                    ?>
                        
                </div><!--Second Row -->
				<div class="row">
                <h4>Recorded Class</h4>
					<hr>
                    <?php
                    $sql = "SELECT * FROM video ORDER BY cur_time DESC LIMIT 4";
                    $result = mysqli_query($conn,$sql);
                    $i = 0;
                    $num = mysqli_num_rows($result);
                    if($num>0)
                    {
                    while($row = mysqli_fetch_assoc($result))
                    {
                    $i++;
                    $var = $row['video_name'];
                    $var1 = basename($var, '.mp4');
                    $var2 = $var1.'.mp4';
                    ?>
                <div class="col-md-3 mb-5">
                    <div class="card flex-fill card3" style="height:270px">
                        <div class="card-img-top" alt="Book Cover"><video src="video/<?php echo $var2 ?>" style="height:auto;width:241px;"></video></div>
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
                    <?php }}
                    else
                    {
                    ?>
                    <div class="extra">
                        <p>There is no video at this moment</p>
                    </div>
                    <?php
                    }
                    
                    ?>
                        
                </div><!--Second Row -->
                <div class="row">
                <h4>Books and Resources</h4>
					<hr>
                    <?php
                    $sql = "SELECT * FROM resource ORDER BY cur_time DESC LIMIT 4";
                    $result = mysqli_query($conn,$sql);
                    $num = mysqli_num_rows($result);
                    if($num>0)
                    {
                    while($row = mysqli_fetch_assoc($result))
                    {
                    $var = $row['book_name'];
                    $var1 = basename($var, '.pdf');
                    $var2 = $var1.'.jpg';
                    ?>
                <div class="col-md-3 mb-5">
                        <div class="card flex-fill card2">
                            <div class="card-img-top" alt="Book Cover"><img src="image/<?php echo $var2 ?>" style="height:210px;width:241px"></div>
                            <div class="card-body">
                            <h6 class="card-title"><?php echo $var1 ?></h6>
                            <a href="resource/<?php echo $var?>" class="btn btn5">Read Now</a>
                            </div>
                        </div>
                        </div>
                        <?php }}

                    else
                    {
                    ?>
                    <div class="extra">
                        <p>There is no Books at this moment</p>
                    </div>
                    <?php
                    }
                    
                    ?>
                        
                </div><!--Second Row -->
        
			</div>
		</div>
	</div>
    </section>

    

    <section class="sect8">
        <div class="container join_col mt-5 rounded">
            <h1 class="text-white text-center pt-5"> Tomorrow's Champion are made Today</h1>
            <h4 class="text-white text-center"> We take classes for olympiad preperation and help a student for further preperation <h4>
            <div class="my-4">
            <a href="join.php"><button type="submit" name="com1" class=" mb-5 mt-3 class"> Join Class </button></a>
            </div>
        </div>
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