<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ishiweb || SignUp</title>
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/toastr.css">
</head>
<body>
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form id="userForm" action="" method="POST" class="register-form" >
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="cpassword"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm password"/>
                            </div>
                            <div class="form-group form-button">
                                <button class="form-submit" type="button" name="submit" id="btn_save">SignUp</button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup_img.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<script src="js/jquery.min.js"></script>
<script src="js/toastr.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
    $(document).ready(function(){
        $("#userForm").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                cpassword: {
                    required: true,
                    equalTo : '[name="password"]',
                },
            },
            messages: {
                name: "Please enter your name.",
                email: "Please enter a valid email address.",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                cpassword: {
                    required: "Confirm Password required.",
                    equalTo: "Confirm Password Not Match."
                },
            }
        });
    });
</script>

<script>
    $('#btn_save').click(function() {
        if ($("#userForm").valid()) {
            var formData = $('#userForm').serialize();
            $.ajax({
                type: "POST",
                url: "submit.php",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (result) {
                if(result.msg == 'success') {
                    toastr.success(result.response, 'Success');
                    $('#userForm')[0].reset();
                } else {
                    toastr.success(result.response, 'Error');
                }
            });
        }
    });
</script>