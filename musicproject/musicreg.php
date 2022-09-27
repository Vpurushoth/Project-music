<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$upswd1 = $_POST['upswd1']; 
$upswd2 = $_POST['upswd2'];
$email = $_POST['email'];
$phno = $_POST['phno'];

if (!empty($fname) || !empty($lname) || !empty($uname) || !empty($upswd1) || !empty($upswd2) || !empty($email) || !empty($phno) )
{


$conn = new mysqli('localhost','root','','music');
if($conn->connect_error){
    die('connection Failed: '.$conn->connect_error);
}

else{
    $SELECT = "SELECT email From signuptable Where email = ? Limit 1";
    $INSERT = "insert into signuptable(fname,lname,uname,upswd1,upswd2,email,phno) values(?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

     if ($rnum==0) {
     $stmt->close();
     $stmt = $conn->prepare($INSERT);
     $stmt->bind_param("ssssssi",$fname,$lname,$uname,$upswd1,$upswd2,$email,$phno);
     $stmt->execute();
     header("Location: http://localhost/musicproject/musicindex.html");
    } else {
     echo "Someone already register using this email";
    }
    $stmt->close();
    $conn->close();
   }
} else {
echo "All field are required"; 
die();
}

?>