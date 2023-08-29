<?php 
include'connection.php';
if(isset($_POST)){

 $email = $_POST['email'];
 $password = $_POST['password'];

 $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
if($count == 1){

    $user_detail = mysqli_fetch_assoc($result);
    session_start();

    $_SESSION['logged_in'] = true;
    $_SESSION['id'] = $user_detail['id'];
    $_SESSION['username'] = $user_detail['name'];
    $_SESSION['email'] = $user_detail['email'];


    mysqli_close($conn);
    echo json_encode( array('msg' => 'success', 'response' => 'Login Successful!'));
    exit;
}else{
    mysqli_close($conn);
    echo json_encode( array('msg' => 'error', 'response' => 'Invalid username or password!'));
    exit;
}
}
?>