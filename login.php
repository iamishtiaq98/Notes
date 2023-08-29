<?php 
session_start();
if(isset($_SESSION["id"])) {
    header("Location:home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ishiweb || Login</title>
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main">
        <!-- Login form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/login-img.jpg" alt="sign in image"></figure>
                        <a href="signup.php" class="signup-image-link">Create an account</a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Log in</h2>
                        <form id="loginform"  name="loginform" action="" method="" class="register-form" >
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock password"></i></label>
                                <input placeholder="Password" id="password" name="password" type="password" required=""/>
                            </div>
                            <div class="form-group form-button">
                                <button id="loginbtn" name="loginbtn" type="button" class="form-submit">log in</button>
                            </div>
                            <a href="forgot.php" class="signup-image-link">Forgot password?</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#loginform").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    email: "Enter valid Email.",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                },
            })
        });
    </script>

    <script>
        $('#loginbtn').click(function() {
            if ($("#loginform").valid()){
                var formData = $('#loginform').serialize();
                $.ajax({
                    type: "POST",
                    url: "getlogin.php",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function (result) {
                    if(result.msg == 'success') {
                        window.location.href = "home.php";
                    } else {
                        alert(result.response);
                    }
                });
            }
        });
    </script>
</body>
</html>