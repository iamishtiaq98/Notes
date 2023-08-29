<?php 
session_start();
include'connection.php';
if(isset($_POST))
{   

$sql = "SELECT * FROM notes (subject, note) WHERE id=$user_id
VALUES ('$subject','$note','$user_id')";

if (mysqli_query($conn, $sql)) {
  mysqli_close($conn);
  // echo "New record has been added successfully !";
  echo json_encode( array('msg' => 'success', 'response' => 'Note saved successfully !') ); 
  exit;
} else {
  mysqli_close($conn);
  echo json_encode( array('msg' => 'error', 'response' => "Error: " . $sql . ":-" . mysqli_error($conn)) );
  exit;
}
} else {
  mysqli_close($conn);
  echo json_encode( array('msg' => 'error', 'response' => 'Invalid request.') );
  exit;
}
// print_r($_POST);
?>