<?php 
include'connection.php';

if(isset($_POST))
{   
 $name = $_POST['name'];
 $email = $_POST['email'];
 $password = $_POST['password'];

 if(!empty($email)){

  $sql = "SELECT email FROM users WHERE email='$email'";
  $result = mysqli_query($conn,$sql);
  if (mysqli_num_rows($result) > 0 ) {
    mysqli_close($conn);
    echo json_encode( array('msg' => 'error', 'response' => 'Email already Exists with another user!'));
    exit;
  }
}

$sql = "INSERT INTO users (name,email,password)
VALUES ('$name', '$email','$password')";

if (mysqli_query($conn, $sql)) {

  mysqli_close($conn);
  echo json_encode( array('msg' => 'success', 'response' => 'Sign Up successfully!') );
  exit;

} else {
  mysqli_close($conn);
  echo json_encode( array('msg' => 'error', 'response' => "Error:" . $sql . ":-" . mysqli_error($conn)));
  exit;
}

} else {
  mysqli_close($conn);
  echo json_encode( array('msg' => 'error', 'response' => 'Invalid request.') );
  exit;
}
?>