<?php


$uname = $_POST['uname'];
$upswd1 = $_POST['upswd1']; 

$conn = new mysqli('localhost','root','','music');
if($conn->connect_error){
    die('connection Failed: '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("select * from signuptable where uname = ?");
    $stmt->bind_param("s",$uname,);
    $stmt->execute();
    $stmt_result=$stmt->get_result();
    if($stmt_result->num_rows>0)
    {
      $data=$stmt_result->fetch_assoc();
      
      if($data['upswd1'] === $upswd1 )
      {
         header("Location: http://localhost/musicproject/main.html");  
      }
      else
      {
         echo "<h2>Invalid UserName or Password</h2>";
      }
    }
    else
    {
      echo "<h2>Invalid UserName or Password</h2>";
    }
}
?>