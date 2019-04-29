<?php
 session_start();
 include 'config/database.php';


 $database = new Database();
 $db = $database->getConnection();

 $table_name = "users";

 $username = $_POST['username'];
 $password = $_POST['password'];

 $query = "SELECT * FROM " . $table_name . " WHERE username='" . $username . "' AND password=:password";        

 // prepare query statement
 $stmt = $db->prepare( $query );

 // bind category id variable
 $stmt->bindParam(":password", $password);
 // execute query
 $stmt->execute();

 $rows = $stmt->fetch(PDO::FETCH_NUM);
 $result = $stmt->fetch(PDO::FETCH_COLUMN);


 if($rows[0] > 0){
     $_SESSION['loggedin']=1;
     $_SESSION['user_id']=$result['user_id'];
     header("Location: products.php");
 }
 else{
     die('Login Failed');
 }

?>
