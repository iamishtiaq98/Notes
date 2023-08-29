<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ishiweb || Forgot Password</title>
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/toastr.css">
</head>

<body>
    <div class="main">
        <!-- Forgot Password form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/forgot.jpg" alt="forgot password image"></figure>
                        <a href="login.php" class="signup-image-link">Back to login</a>
                    </div>
                    <div class="signin-form">
                     <h3 class="form-title">Forgot Password</h3>
                     <form id="forgotform"  name="forgotform" action="" method="" class="register-form" >
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                                <div class="form-group form-button">
                                    <button id="forgotbtn" name="forgotbtn" type="button" class="form-submit">Forgot Password</button>
                                </div>
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
        <script src="js/toastr.min.js"></script>

        <script>
            $(document).ready(function(){
                $("#forgotform").validate({
                    rules: {
                        email:{
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        email: {
                            email: "Enter valid Email.",
                            required: "Email is required.",
                        }
                    },
                })
            });
        </script>
        <script>
            $('#forgotbtn').click(function() {
                if ($("#forgotform").valid()){
                    var formData = $('#forgotform').serialize();
                    $.ajax({
                        type: "POST",
                        url: "forgotpass.php",
                        data: formData,
                        dataType: "json",
                        encode: true,
                    }).done(function (result) {
                        if(result.msg == 'success') {
                            toastr.success(result.response, 'Success');
                            $('#forgotform')[0].reset();
                        } else {
                            toastr.error(result.response, 'Error');
                        }
                    });
                }
            });
        </script>

    </body>
    </html>