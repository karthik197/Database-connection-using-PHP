<?php
//connecting database
$con=mysqli_connect('localhost','root','','Database');
if(isset($_POST['register']))
{
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $gender=mysqli_real_escape_string($con,$_POST['gender']);
    if($gender=='')
    {
        echo "<script>alert('Fill the gender details')</script>";
        exit();
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        echo "<script>alert('Invalid email')</script>";
        exit();    
    }
    if(strlen($password)<8)
    {
        echo "<script>alert('Password length is less than 8')</script>";
        exit();
    }

    $select_email="select * from registration where email='$email'";
    $run_mail=mysqli_query($con,$select_email);
    $check_mail=mysqli_num_rows($run_mail);
    if($check_mail==1)
    {
        echo "<script>alert('This email is already registered')</script>";
        exit();
    }
    else{
        $insert="insert into registration(name,email,password,gender) values('$name','$email','$password','$gender')";  
        $run_insert=mysqli_query($con,$insert);
        if($run_insert)
        {
            echo "<script>alert('Registered Successfully');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>   
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" /> 
    <title>Register</title>
</head>
<body>
    <div class="form">
       <img id="profile" src="profile.svg" >
       <form action="index.php" method="post">
            <h1 id="welcome">welcome</h1>
            <div class="input one focus"><div class="i"><i class="fas fa-user-circle"></i></div></div>
            <div>
                <h5 id="idp">Name : </h5>
                <input id="name" type="text" name="name" placeholder="Enter your name" required="required"><br>
            </div>
            <div class="input two focus"><div class="i"><i class="fas fa-envelope"></i></div></div>
            <div>
                <h5 id="idp">Email : </h5>
                <input id="email" type="email" name="email" placeholder="Enter your Mail-Id" required="required"><br>
            </div>
            <div class="input three focus"><div class="i"><i class="fas fa-lock"></i></div></div>
            <div>
                <h5 id="idp">Password : </h5>
                <input id="password" type="password" name="password" placeholder="aA1@#$%&*" required="required"><br>  
                <a id="forgot" href="#">Forgot Password???</a>  
            </div>   
            <h5 id="gender">Gender : </h5>
            <div>
                <input id="radio" type="radio" name="gender" value="Male">
                <label for="male">Male</label><br><br>
                <input id="radio" type="radio" name="gender" value="Female">
                <label for="male">female</label><br><br>  
            </div>
            <input id="register" type="submit" name="register" value="REGISTER">
        </form>
        </div>        
</body>
</html>