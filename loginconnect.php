<?php
$username = $_GET['username'];
$password = sha1($_GET['pass']);

if(!empty($username) || !empty($pass)){
$host="localhost";
$dbUsername="root";
$dbPassword="";
$dbname="loginpage";

$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

if(mysqli_connect_error()){
die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
}else{
$SELECT = "SELECT username From register Where username=? Limit 1";
$INSERT = "INSERT Into register (username, pass) values(?,?)";

$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($username);
$stmt->store_result();



if($stmt->num_rows==0){
    $stmt->close();

    $stmt=$conn->prepare($INSERT);
    $stmt->bind_param("ss", $username, $pass);
    $stmt->execute();
    echo "New record inserted sucessfully";
}else{
    echo "Someone already logged using this username";
}

}
$stmt->close();
$conn->close();
}else{

    echo "All field are required";
    die();

}
?>