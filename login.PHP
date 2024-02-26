<!-- <?php
session_start();
if(isset($_SESSION["user"]))
{
    header("Location: index.php");
}
// $_SESSION["name"]="john";
// print_r($_SESSION);
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet", href="style.css">
</head>
<body>
    <div class="container">
        <?php
        // if login button is submitted is checked by below sattement isset function does that 
        if(isset($_POST["login"]))
        // after above code when login clicked collect email and password data 
        {   $email=$_POST["email"];
            $password=$_POST["password"];
            // now check whetehr email and passwor exit into user database or not for login so, for that first connect to database 
            require_once "database.php";
            $sql= "select * from users where email='$email' ";
            $result=mysqli_query($conn,$sql);
            $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($user)
            {
                if(password_verify($password,$user["password"]))
                {
                    session_start();
                    $_SESSION["user"]="yes";
                    header("Location: index.php");
                    die();
                }
                else{
                    echo"<div class='alert alert-danger'> PAssword doesn't match</div>";
                }

            }
            else
            {
                echo"<div class='alert alert-danger'>Email doesn't exist</div>";
            }

        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email", placeholder="enter email" name="email",class="form-control">
            </div>
            <div class="form-group">
                <input type="password", placeholder="enter password" name="password",class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit",class="btn btn-primary",value="Login", name="login">
            </div>
        </form>
        <div><p>Not registered yet?</p>
    <a href="registration.php" class="btn btn-success">Register Here</a></div>
    </div>
    
    
</body>
</html>