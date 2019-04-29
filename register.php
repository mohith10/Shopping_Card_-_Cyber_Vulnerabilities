<?php

 include 'config/database.php';


 $database = new Database();
 $db = $database->getConnection();

 $table_name = "users";

 $username = $_POST['username'];
 $password = $_POST['password'];
 $repassword = $_POST['repassword'];

 $userid = substr(bin2hex(md5($username.$password)),0,9);

 if($password!=$repassword){
          die("Password is not same!!");
 }
 $query = "INSERT INTO " . $table_name . " VALUES(:user_id, :username, :password)";

 // prepare query statement
 $stmt = $db->prepare( $query );

 // bind category id variable
 $stmt->bindParam(":user_id", $userid);
 $stmt->bindParam(":username", $username);
 $stmt->bindParam(":password", $password);
 // execute query
 if($stmt->execute()){
     header("Location: index.html");
     echo "<script>alert('You can login now!!')</script>";
 }
 else{
     print_r($db->errorInfo());
     #die('Registration failed');
 }

?>
