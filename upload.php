<?php
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location: login.php");
    }
    include 'config.php';
    
        $insert = false;
        if(isset($_POST['upload']))
        {

        /*-------  Recorded Video   ------*/
                  

            if($_FILES['video']['error'] === 0)
            {
            $video = $_FILES['video'];
            $videoName = $_FILES['video']['name'];
            $videoTmpName = $_FILES['video']['tmp_name'];
            $videoSize = $_FILES['video']['size'];
            $videoError = $_FILES['video']['error'];
            $videoType = $_FILES['video']['type'];
                    
            $videoExt = explode('.',$videoName);
            $videoActualExt = strtolower(end($videoExt));
                    
            $allowed = array('mp4');
                    
            if(in_array($videoActualExt,$allowed))
            {
                if($videoError === 0)
                {
                        $videoDestination = 'video/'.$videoName;
                        move_uploaded_file($videoTmpName,$videoDestination);
                }
                }

                $sql = "INSERT INTO video(video_name)
                VALUES('$videoName');";
                $stmt = mysqli_query($conn,$sql);
            }
                
        /*----- Recorded Video ------*/


        /*-------- Books and Notes -------*/

        if($_FILES['book']['error'] === 0)
        {
        $book = $_FILES['book'];
        $bookName = $_FILES['book']['name'];
        $bookTmpName = $_FILES['book']['tmp_name'];
        $bookSize = $_FILES['book']['size'];
        $bookError = $_FILES['book']['error'];
        $bookType = $_FILES['book']['type'];                   
        $bookExt = explode('.',$bookName);
        $bookActualExt = strtolower(end($bookExt));                   
        $allowed = array('pdf');
                    
        if(in_array($bookActualExt,$allowed))
        {
            if($bookError === 0)
            {
                    $bookDestination = 'resource/'.$bookName;
                    move_uploaded_file($bookTmpName,$bookDestination);
            }
            }

            $sql = "INSERT INTO resource(book_name)
            VALUES('$bookName');";
            $stmt = mysqli_query($conn,$sql);
            $sql = "SELECT * FROM resource ORDER BY cur_time DESC LIMIT 1";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $var = $row['book_name'];
                $tmp_name = 'C:\xampp\htdocs\CSE_3200\resource/'.$var;
                $filename = basename($tmp_name, '.pdf');
                //output directory path
                $outputDir = 'C:\xampp\htdocs\CSE_3200\image/';

                //Create the output directory if it doesn't exist
                if (!file_exists($outputDir)) {
                    mkdir($outputDir, 0777, true); // Set the permissions to 777 to allow write access
                }

                // Set the output file name and path
                $outputFile = $outputDir . pathinfo($filename, PATHINFO_FILENAME) . '.jpg';

                // Write the first page of the PDF to the output file

                $imagick = new \Imagick();
                $imagick->readImage($tmp_name . '[0]');
                $imagick->setImageFormat('jpg');
                $result = $imagick->writeImage($outputFile);
                if (!$result) {
                echo 'Error: Unable to extract first page.';
                }


                    

                    }

    /*-------- Books and Notes -------*/


        if($stmt){ 
            $insert = true;
            echo"
                <script>
                    alert('You have successfully uploaded the file!');
                    window.location.href = 'upload.php';
                </script>
                ";
        }
        else{
            echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
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
    <link rel="stylesheet" href="upload.css">
   
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
                <form action="upload.php" id="pdf-form" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email address">
                    </div>
                    <div class="mb-3">
                        <label for="video" class="form-label">Recorded Video</label>
                        <input type="file" name="video" class="form-control">
                    </div>
                    
                    
                    <div class="mb-3">
                        <label for="books" class="form-label">Books & Resources</label>
                        <input type="file" id="pdf-file" name="book" class="form-control" accept="application/pdf">
                    </div>
                    
                    <button type="submit" name="upload" class="btn btn_up">Submit</button>
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
    <script src="extract-pdf.js">
            </script>

</body>
</html>
