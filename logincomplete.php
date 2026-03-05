// https://www.geeksforgeeks.org/php/how-to-encrypt-and-decrypt-passwords-using-php/


<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>

    <h2>Login Page</h2>

    <form method ="POST">
        Username: <input type ="text" name ="username" required><br><br>
        Password: <input type ="password" name ="password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <?php
        $conn = new mysqli("localhost","root","","SocialMediaDB");

        $message ="";

        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $username =$_POST["username"];
            $password =$_POST["password"];

            
            $sql = "SELECT password FROM Users WHERE username='$username'";

            $result = $conn->query($sql);

            if($result && $result->num_rows>0){

                $row = $result->fetch_assoc();
                $hashedPassword = $row["password"];

                
                if(password_verify($password, $hashedPassword)){
                    $message ="Login Successful";
                }
                else{
                    $message ="Login Unsuccessful";
                }

            }
            else{
                $message ="Login Unsuccessful";
            }
        }

    ?>


    <p style="color:red;">
        <?php echo $message; ?>
    </p>

</body>
</html>