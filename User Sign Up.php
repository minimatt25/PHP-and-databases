<?php 
$host = "localhost";
$user = "root";
$pass  = "";
$db = "test";

$connection  = new mysqli($host,$user,$pass,$db);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fName = $_POST['firstName'] ?? null;
    $lName = $_POST['lastName'] ?? null;
    $email = $_POST['email'] ?? null;
    $Cemail = $_POST['Cemail'] ?? null;
    $password = $_POST['password'] ?? null;

    if(!$fName || !$lName || !$email || !$Cemail || !$password){
        echo 'please fill in all boxes';
        exit;
    }

    $sql = "SELECT COUNT(*) FROM people WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();

    $stmt->bind_result($emailRepeat);
    $stmt-> fetch();

    if($emailRepeat>0){
        echo "this email is already in use by another account";
        $stmt->close();
        $connection->close();
        exit;
    }

    $stmt->close();

    $sqlAdd = "INSERT INTO people (firstName, lastName, email, password) VALUES (?,?,?,?)";
    $stmtAdd = $connection->prepare($sqlAdd);

    $stmtAdd->bind_param("ssss",$fName,$lName,$email,$password);
    
    if($stmtAdd->execute()){
        echo 'success';
    } else{
        echo 'user not added to table';
    }

    $stmtAdd->close();
    $connection->close();
}
?>