<?php 

session_start();
include'connection.php';
if(isset($_POST))
{   

  $note_id = $_POST['id'];
  $user_id = $_SESSION['id'];

  $sql = "DELETE FROM notes WHERE id = $note_id AND user_id = $user_id";

  if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
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
?>