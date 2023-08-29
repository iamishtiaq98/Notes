<?php
include 'connection.php';
session_start();
if(!isset($_SESSION["logged_in"])) {
  header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
    <label class="logo">Dashboard</label>
    <ul>
      <li><a class="active" href="home.php">Home</a></li>
      <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)  </a>
      </li>
    </ul>
  </nav>

    <div class="main">


        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sing in  Form -->
        <section>
            <div class="container">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="signup.php" class="signup-image-link">Create an account</a>
                    </div>
                    <div class="signin-form">
                        <table class="table" >
        <thead>
          <th>Sr_No.</th>
          <th>Subject</th>
          <th>Note</th>
          <th colspan="2">Action</th>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM notes where user_id=".$_SESSION['id'];
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) { ?>

              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["subject"]; ?></td>
                <td><?php echo $row["note"];?></td>
                <td>
                  <button class="fas fa-edit ebtn"></button>
                  <button class="fas fa-trash dbtn"></button>
                </td>
              </tr>
              <?php }
            } else {
           ?><tr><td colspan="5"><?php echo "0 results";?></td></tr>
           <?php
            }
            ?>
        </tbody>
      </table>
                </div>
            </div>
        </section>
    </div>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>