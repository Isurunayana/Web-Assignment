<?php
$fullname = $_GET['FullName'];
$username = $_GET['User'];
$email=$_GET['Email'];
$password=sha1($_GET['Password']);



if(!empty($fullname) || !empty($username) || !empty($email) ||!empty($pass)){
$host="localhost";
$dbUsername="root";
$dbPassword="";
$dbname="signuppage";

$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

if(mysqli_connect_error()){
die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
}else{
$SELECT = "SELECT email From register Where email=? Limit 1";
$INSERT = "INSERT Into register (fullname,username,email, password) values(?,?,?,?)";

$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();



if($stmt->num_rows==0){
    $stmt->close();

    $stmt=$conn->prepare($INSERT);
    $stmt->bind_param("ssss", $fulname,$username,$email, $password);
    $stmt->execute();
    echo "New record inserted sucessfully";
}else{
    echo "Someone already logged using this email";
}

}
$stmt->close();
$conn->close();
}else{

    echo "All field are required";
    die();

}
?>