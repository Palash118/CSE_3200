<?php

// Already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password,verified FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password,$verified);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password) && $verified === '1')
                        {
                            //Password is corrct and allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["name"] = $username;
                            //Redirect welcome page
                            header("location: welcome.php");
                            
                        }
                        else
                        {
                            echo"
                            <script>
                                alert('Please Enter username and Password Correctly');
                                window.location.href = 'login.php';
                            </script>
                            ";
                        }
                    }

                }
                else
                {
                    echo"
                            <script>
                                alert('Please Enter username and Password Correctly');
                                window.location.href = 'login.php';
                            </script>
                            ";
                }

    }
}    
}



?>











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olympiad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    
</style>
</head>
<body>

    <section class="sect1">
        <div class="first">
        <div class="container">
            <div class="row w-100 d-flex justify-content-center align-items-center main-div">
                <div class="col-12 col-md-8 col-xxl-5">
                    <div class="card py-3 px-2">
                        <h2 class="text-center mb-3"><span>Have an account?</span></h2>
                        <div class="division">
                            <form action="login.php" method="POST">
                            <div class="mb-3 mt-4">
                            <input type="text" name="username" class="form-control input-field" id="exampleFormControlInput1" placeholder="Username">
                            </div>
                            <div class="mb-3">
                            <input type="password" name="password" class="form-control input-field" id="myInput" placeholder="Password">
                            </div>
                            <div class="my-4">
                                <button type="submit" name="submit" class="btn btn-lg sign">
                                    <small>LOG IN </small>
                                </button>
                            </div>
                            <div class="row">
                                <div class="form-group form-check col-8 ms-3">
                                <input type="checkbox" onclick="myFunction()" class="check-box">
                                <span>Show Password</span>
                                </div>
                                <div class="col-3">
                                    <a href="register.php" class="register">Register Here</a>
                                </div>
                            </div>
                            <p class="text-center mb-3 mt-3"><span>— Or Log In With —</span></p>
                            <div class="row mt-4">
                                <div class="col-6">
                        
                                    
                                           <button type="button" class="btn btn-light btn-lg sign1">
                                           
                                           <a href="#">Google</a>
                                           
                                           </button>
                                          
                                        
                    
                                </div>
                                <div class="col-6">
                                <button type="button" class="btn btn-light btn-lg sign1">
                                    <a>Facebook </a>
                                </button>
                                </div>
                            </div>
                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script>
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>



</body>
</html>