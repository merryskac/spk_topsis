<?php
$conn = mysqli_connect('localhost','root','','spk_pulsa');
if(mysqli_error($conn)){
  echo 'db not connected';
}
?>