<?php
include 'connection.php';

if(!empty($_POST['email'])){

  $email = mysqli_real_escape_string($conn, $_POST['email']);

  $sql = "SELECT * FROM `users` WHERE email = '$email'";
  $res = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($res);
  if($count == 1){
    $user_detail = mysqli_fetch_assoc($res);
    $password = rand();

$update_password = "UPDATE
`users` SET `password` = '".$password."'
 WHERE `email`= '".$user_detail['email']."'";

    $check_update = mysqli_query($conn, $update_password);
    if ($check_update > 0) {

      $to = $user_detail['email'];
      $name = $user_detail['name'];
      $subject = "Your Recovered Password";
      $from = 'no-reply@email.com';
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      $headers .= 'From: '.$from."\r\n".
      'Reply-To: '.$from."\r\n" .
      'X-Mailer: PHP/' . phpversion();

      $message = '<html><body>';
      $message .= '<h3 style="font-style:italic;text-transform:none;color:#f40;">Hey!'.$name.'</h3>';
      $message .= '<p style="color:#080;font-size:12px;">Please use this password to login-<b><br>'.$password.'</b></p>';
      $message .= '</body></html>';

      if (mail($to, $subject, $message, $headers)){
        echo json_encode(array('msg' =>'success','response' =>'Your Password has been sent to your email id'));
        exit;
      }else{
        echo  json_encode(array('msg' =>'error', 'response' => 'Failed to Recover your password, try again'));
        exit;
      }
    }
    else{
      echo  json_encode(array('msg' =>'error', 'response' => 'Something Wrong.'));
      exit;
    }
  }else{
    echo json_encode(array('msg' => 'error' , 'response' => 'Email does not exist in database'));
  }
}
?>