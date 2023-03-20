<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            //param username
            $param_username = trim($_POST['username']);

            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    echo "<script>
                    alert('This username is already taken!');
                    window.location.href = 'register.php';
                    </script>";
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);



if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 6){
    $password_err = "Password cannot be less than 6 characters";
}
else{
    $password = trim($_POST['password']);
}


if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}



if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $email = trim($_POST['email']);
    $v_code = bin2hex(random_bytes(16));

    $sql = "INSERT INTO users (username,email, password,v_code,verified) VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sssss", $param_username,$param_email, $param_password,$param_code,$param_verfied);

        
        $param_username = $username;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_code = $v_code;
        $param_verfied = '0';

        
        if (mysqli_stmt_execute($stmt))
        {
            $receiver = $email;
            $subject = "Verification Of Email";
            $body = "For Verification, Please Click the verify link
            <a href='http://localhost/CSE_3200/verify.php?email=$email & v_code=$v_code'>Verify</a>";
            $header = "From:palashislam1049@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            if(mail($receiver, $subject, $body, $header)){
                echo"
                <script>
                     alert('Registration is Successful! Please Verify your Email');
                     window.location.href = 'login.php';
                 </script>
                 ";
            }else{
                echo "<script>
                alert('Something went wrong... cannot redirect!');
                window.location.href = 'login.php';
            </script>";
            }
            //header("location: login.php");
        }
        else{
            echo "<script>
                alert('Something went wrong... cannot redirect!');
                window.location.href = 'login.php';
            </script>";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
    <link rel="stylesheet" href="register.css">
</head>
<body>

    <section class="sect1">
        <div class="first">
        <div class="container">
            <div class="row w-100 d-flex justify-content-center align-items-center main-div">
                <div class="col-12 col-md-8 col-xxl-5">
                    <div class="card py-3 px-2">
                        <h2 class="text-center mb-3"><span>Registration Form</span></h2>
                        <div class="division">
                            <form action="register.php" method="POST" enctype="multipart/form-data">
                                <div class="mt-4">
                                <input type="text" name="username" class="form-control input-field" id="exampleFormControlInput1" placeholder="UserName" required>
                                </div>
                                <div class="mb-3 mt-3">
                                <input type="email" name="email" class="form-control input-field" id="exampleFormControlInput1" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                <input type="password" name="password" class="form-control input-field" id="exampleFormControlInput1" placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                <input type="password" name="confirm_password" class="form-control input-field" id="exampleFormControlInput1" placeholder="Confirm Password" required>
                                </div>
                                <div class="my-4">
                                    <button type="submit" name="submit" class="btn btn-lg sign">
                                        <small>SIGN IN </small>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="form-group form-check col-8 ms-3">
                                        <input type="checkbox" class="form-check-input" name="" required>
                                        <label class="form-check-label">I agree to the terms & conditions</label>
                                    </div>
                                    <div class="col-3">
                                        <a href="login.php" class="log">Login Here</a>
                                    </div>
                                </div>
                                <p class="text-center mb-3 mt-3"><span>— Or Sign In With —</span></p>
                                <div class="row mt-4">
                                    <div class="col-6">
                                    <button type="button" class="btn btn-light btn-lg sign1">
                                        <small>Google </small>
                                    </button>
                                    </div>
                                    <div class="col-6">
                                    <button type="button" class="btn btn-light btn-lg sign1">
                                        <small>Facebook </small>
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
        
</body>
</html>