<?php 
include 'connection.php';
function getuser(){
    global $connection;
    if(isset($_POST['btn_register'])){
        $username   = $_POST['username'];
        $password   = md5($_POST['password']); // Encrypting password using md5
        $gender     = $_POST['gender'];
        $email      = $_POST['email'];
        $profile    = $_FILES['profile']['name'];
        $thumbnail  = date('y-m-d-h-i-s').$profile;
        uploadimage($thumbnail);
        
        if(!empty($username) && !empty($email) && !empty($password) && !empty($thumbnail) && !empty($gender)){
            // Using prepared statements to prevent SQL injection
            $sql_insert = "INSERT INTO `tbregister` (`username`, `email`, `password`, `profile`, `gender`) 
                           VALUES ('$username','$email','$password','$thumbnail','$gender')";
            $result = $connection->query($sql_insert);
            if($result){
                header('location:login.php');
            } 
        } 
    }
}

function uploadimage($picture){
    $path = 'assets/image/'.$picture;
    move_uploaded_file($_FILES['profile']['tmp_name'], $path);
}

getuser();
?>
