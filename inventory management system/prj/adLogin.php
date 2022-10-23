<!doctype html>
<html lang="en">

<head>

  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System-Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type = "text/css" href="css/login1.css"> 
	
</head>

<body>
    <h1><center>Hello, Welcome to Inventory Management System!</center></h1>
    <h3><center>Admin Login Page</center></h3>
    <div class = "loginform">
        <img src = "css/avatar.png" class = "av">
        <form method="POST">
        <br><b>Enter your username or email address here:</b><br>
        <input type="text" name="na" placeholder="Give your username" required><br>
        <b>Enter your password here:</b><br>
        <input type="password" name="pa" placeholder="Give your password" required><br>
        <input type="submit" name="login" value="Login"><br>
    </form>
    </div>


    <?php
    include 'connect.php';
    if (isset($_POST['login'])) {
        $u = $_POST['na'];
        $pass = $_POST['pa'];
        $sql = "SELECT * FROM `ad_info` WHERE name = '$u' or mail = '$u' and password = '$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $s = $row['name'];
                $e = $row['mail'];
                $p = $row['password'];
            }
            if ($s === $u and $p === $pass) {
                session_start();
                $_SESSION['na'] = $s;
                header('Location: adPage.php');
            } elseif ($e == $u and $p == $pass) {
                session_start();
                $_SESSION['na'] = $s;
                header('Location: adPage.php');
            }
        } else {
            echo "<script>alert('Incorrect Username or Password!! Try Again.');</script>";
        }
    }   
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>