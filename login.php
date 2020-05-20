<?php

require_once("config.php");
$username = $password = "";
$usernameErr = $passwordErr = "";
if(isset($_POST['login'])){
    if(empty($_POST["username"])){
        $usernameErr = "hantu po?";
    }else{
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    }
    if(empty($_POST["password"])){
        $passwordErr = "hmmmmmm";
    }else{
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);        
    }

    $sql = "SELECT * FROM users WHERE username = :username or email = :email";

    $stmt = $db->prepare($sql);
    
    $params = array(
        ":username" => $username,
        ":email" => $username
    );
    if($username && $password){
        $stmt->execute($params);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
            if(password_verify($password, $user["password"])){  
                if($user["level"] == "Produsen"){
                    session_start();
                    $_SESSION['username'] = $user;
                    $_SESSION['level'] = "Produsen";
                    //sesuaikan nama file tampilan untuk produsen
                    header("Location: produsen.php");
                }else if($user["level"] == "Kios"){
                    session_start();
                    $_SESSION['username'] = $user;
                    $_SESSION['level'] = "Kios";
                    //sesuaikan nama file tampilan untuk kios
                    header("Location: kios.php");
                }
            }
            else{
                $passwordErr = "Pun10, password salah";
            }
        }else{
            $usernameErr = "Daptar dulu voss";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <meta http-equiv = "X-UA-Compatible" content = "ie = edge">
    <title>Login BStore</title>
    <style>.error {color: #FF0000;}</style>
    <link rel = "stylesheet" href = "css/bootstrap.min.css"/>
</head>

<body class = "bg-light">
    <div class = "container mt-5">
        <div class = "row">
            <div class = "container md-6">
                <p>&larr; <a href="index.php">Home</a>

                <h4>Masuk di sini</h4>
                <p>Belum punya akun? <a href = "register.php">Sokin atuh euy</a></p>

                <form action ="" method = "POST">
                    <div class = "form-group">
                        <label for = "username">Username/Email</label>
                        <span class="error"><?php echo $usernameErr;?></span>
                        <input class="form-control" type="text" name="username" placeholder="Username atau Email"/>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <span class="error"><?php echo $passwordErr;?></span>
                        <input class="form-control" type="password" name="password" placeholder="Password" />
                    </div>

                    <input type = "submit" class = "btn btn-success btn-block" name = "login" value = "Masuk" />
                </form>
            </div>
            <div class="col-md-6">
                <img class="img img-responsive" src="img/back.png" />
            </div>
            <div class="col-md-6">
                <img class="img img-responsive" src="img/cat.png" />
            </div>
        </div>
    </div>
</body>
</html>