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
    $password = $_POST['password'] ?? null;

    if(!$fName || !$lName || !$email || !$password){
        echo 'please fill in all boxes';
        exit;
    }

    $sql = 'SELECT * FROM people WHERE firstName = ? AND lastName = ? AND email = ?';
    $stmt = $connection->prepare($sql);
    
    if($stmt){
        $stmt->bind_param("sss",$fName,$lName,$email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows>0){
            $user = $result->fetch_assoc();

            if($password == $user['password']){
                echo 'success';
            } else{
                echo 'invalid password, please try again';
            }
        } else{
            echo 'user not found, please try again, or make a new account';
        }
        $stmt->close();
    }
}
$connection->close();
?>