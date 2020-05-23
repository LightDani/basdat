<?php

require_once("config.php");
$name = $username = $password = $email = $level = "";
$nameErr = $usernameErr = $passwordErr = $emailErr = $levelErr = "";


if(isset($_POST['register'])){
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    }

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    }

    if (empty($_POST["level"])) {
        $levelErr = "Choose one";
    } else {
        $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_STRING);
    }

    $sql = "INSERT INTO `users` (name, username, password, email, level) VALUES (:name, :username, :password, :email, :level)";
    $stmt = $db->prepare($sql);

    $params = array(
        ":name" => $name,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email,
        ":level" => $level
    );
    if($name && $username && $password && $email && $level){
        $saved = $stmt->execute($params);
        if($saved){
            header("Location: login.php");
        }else{
            $emailErr = "Email is already used";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register BStore</title>
    <style>.error {color: #FF0000;}</style>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <p>&larr; <a href="index.php">Home</a></p>

            <h4>Hayuk kita mah</h4>
            <p>Sudah punya akun? <a href="login.php">Sokin atuh euy</a></p>

            <form action="" method="POST">

                <div class="form-group">
                    <label for="name">Nama</label>
                    <span class="error">* <?php echo $nameErr;?></span>
                    <input class="form-control" type="text" name="name" placeholder="Nama Kios/Produsen" />
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <span class="error">* <?php echo $usernameErr;?></span>
                    <input class="form-control" type="text" name="username" placeholder="Username"/>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <span class="error">* <?php echo $emailErr;?></span>
                    <input class="form-control" type="email" name="email" placeholder="Alamat Email" />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <span class="error">* <?php echo $passwordErr;?></span>
                    <input class="form-control" type="password" name="password" placeholder="Password" />
                    
                </div>

                <div class="form-check">
                    <label for="level">Daftar sebagai:</label>
                    <span class="error">* <?php echo $levelErr;?></span>
                </div>

                <input type="radio" name="level" <?php if (isset($level) && $level=="Produsen") echo "checked";?> value="Produsen">Produsen
                <input type="radio" name="level" <?php if (isset($level) && $level=="Kios") echo "checked";?> value="Kios">Kios

                <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />
            </form>  
        </div>

        <div class="col-md-6">
            <img class="img img-responsive" src="img/cat.png" />
        </div>
    </div>
</div>

</body>


</html>