<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['na'])){
        header('Location: adLogin.php');
    }
    else{
        $adname = $_SESSION['na'];
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Update Item-Inventory Management System</title>
    <style>
        body
        {
            font-family: garamond;
            background: url(css/dlt.jpg);
            background-size: fill;
            background-position: center;
            background-position: 100px 100px;
        }
        h1,h4
        {
            background-color: rgba(245, 136, 2,0.5);
            text-align: center;
            font-family: garamond;
            font-size: 40px;
            font-style: bold;
        }
        .centre
        {
            margin-left: auto;
            margin-right: auto;
            align-content: center;
            text-align: center;
            padding-top: 50px;
            background-color: rgba(137, 209, 92,0.4);
        }
        .back
{
    padding-left: 1500px;
    background-color: orange;
    margin-bottom: auto;
}
    </style>
  </head>
  <body>
  <h1>Hi, <?php echo $adname; ?></h1>
  <h4>Update Product Page</h4>
  <center><div class="centre">
      <form method="GET">
          <?php
            $sql="SELECT * FROM `inventory`";
            $result=$conn->query($sql);
            if($result->num_rows>0){
                echo "<b>Enter Existing Product Name:</b><br>";
                    echo "<select name='prname' id='prname' required>
                    <option></option>";
                    while ($row=$result->fetch_assoc()) {
                        echo "<option value='$row[proName]'>{$row['proName']}</option>";
                    }
                    echo "</select>";
                    echo "<button name='check' class='btn btn-primary'>Check Product</button>";
                }
                else {echo "<b>There is no product to be updated.</b><br>";}
          ?>
        
        </form></div></center>
    <?php
        if(isset($_GET['check'])){
            $_SESSION['prname'] = $_GET['prname'];
            $_SESSION['na'] = $adname;
            header('Location: updt.php');
          
        }
               
            
        
        
    ?>
    <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" class="btn btn-outline-secondary" value="Back" placeholder="Back" name="back">
    </form>
    <?php
    if(isset($_POST['back'])){
        $_SESSION['na'] = $adname;
        header('Location: adPage.php');
    }
    ?>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   
  </body>
</html>