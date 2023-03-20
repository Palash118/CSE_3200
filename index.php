<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
include 'C:/xampp/htdocs/CSE_3200/config.php';

if(isset($_GET['logout'])){    
	
	//Simple exit message 
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
	
	//session_destroy();
	header("Location: welcome.php"); //Redirect the user 
}
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
function loginForm(){
    echo 
    '<div id="loginform"> 
<p>Please enter your name to continue!</p> 
<form action="index.php" method="post"> 
<label for="name">Name &mdash;</label> 
<input type="text" name="name" id="name" /> 
<input type="submit" name="enter" id="enter" value="Enter" /> 
</form> 
</div>';
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
    <link rel="stylesheet" href="style.css">
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
    <a class="navbar-brand" href="C:/xampp/htdocs/CSE_3200/welcome.php">Olympiad</a>
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
    if(!isset($_SESSION['name'])){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
                <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
            </div>
            <div id="chatbox">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
            </div>
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
        </div>

        
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
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document 
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); 
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; 
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');  
                            }	
                        }
                    });
                }
                setInterval (loadLog, 2500);
                $("#exit").click(function () {
                    var exit = confirm("Are you sure you want to end the session?");
                    if (exit == true) {
                    window.location = "index.php?logout=true";
                    }
                });
            });
        </script>
    </body>
</html>
<?php
}
?>