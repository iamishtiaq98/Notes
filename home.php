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
  <link rel="stylesheet" href="style/style1.css">
  <link href='https://fonts.googleapis.com/css?family=Alegreya:400,900|Source+Sans+Pro' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/all.min.js"></script>
</head>
<body style="margin:0">
  <nav>
    <label class="logo">Dashboard</label>
    <ul>
      <li><a class="active" href="home.php">Home</a></li>
      <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>) </a>
      </li>
    </ul>
  </nav>

  <div class="main">
    <!-- Login form -->
    <section class="sign-in">
      <div class="container">
        <div class="signin-content">
          <div class="signin-form">
            <h2 class="form-title">Your Note</h2>
            <div class="quote" >
              <form id="notes"  name="notes" action="" method="" >
                <span class="text-center1"></span> 
                <span class="text-center2">Now! Save all your note. &#128522;</span>

                <div class="input-container">
                  <input placeholder="Enter you subject about note here!" id="subject" name="subject" type="text"><br><br>
                </div>


                <div class="input-container">
                  <textarea
                  style="
                  border: none;
                  margin: 10px 0px 0px !important;
                  text-align: left !important;
                  border-bottom: 1px solid #555 !important;
                  background: transparent !important;
                  width: 100% !important;
                  padding: 2px 0 1px 0 !important;
                  font-size: 16px !important;"
                  placeholder="Type your note here!" id="notes" name="notes" rows="1" cols="20"></textarea><br>
                  <button id="savenote" name="savenote" type="Button" class="btn form-submit">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <section class="sign-in" >
    <div class="container" style="width: 100%; margin-bottom: 2rem;">
      <div class="signin-content" style="display: flex; justify-content: center;">
        <div class="quote1">
          <span class="text-center2">Your all notes are these. &#128522;</span>
          <table class="table" >
            <thead>
              <th>Sr_No.</th>
              <th>Subject</th>
              <th>Note</th>
              <th colspan="2">Action</th>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM notes where user_id=".$_SESSION['id'] ;
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["subject"]; ?></td>
                    <td><?php echo $row["note"];?></td>
                    <td>
                      <button class="ebtn form-submit" data-id="<?php echo $row["id"]; ?>" disabled ><i class="fas fa-edit "></i></button>
                      <button class="dbtn form-submit" data-id="<?php echo $row["id"]; ?>"><i class="fas fa-trash"></i></button>
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
  </div>
  </section>
  <div class="blue-page-section">
    <p class="text-center3">Thank you!</p>
  </div>
  <footer>
    <p>
    Copyright 2021-2022 by Ishtiaq Amjad. All Rights Reserved.</p>
  </footer>
</body>
</html>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
  $(document).ready(function(){
    $("#notes").validate({

     rules: {
      subject: {
        required: true,
      },
      notes: {
        required: true,
      }
    },
    messages: {
      subject: "Please enter a valid email address",
      notes: {
        required: "Please provide a password",
      },
    },
  })
    $("#savenote").click(function(){ 
      $("#notes").valid();
    });
  });
</script>
<script>
  $('#savenote').click(function() {
    if($('#notes').valid()) {
      var formData = $('#notes').serialize();
      $.ajax({
        type: "POST",
        url: "savenote.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (result) {

        if(result.msg == 'success') {
          alert(result.response);
          location.reload();
        } else {
          alert(result.response);
        }
      });
    }

  });

$('.dbtn').click(function() {
  var id = $(this).data('id');
  var dataToSend = { id: id };

  $.ajax({
    type: "POST",
    url: "deleteNote.php",
    data: dataToSend, 
    dataType: "json",
    encode: true,
  }).done(function (result) {

    if (result.msg == 'success') {
      alert(result.response);
      location.reload();
    } else {
      alert(result.response);
    }
  });
});

</script>