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

    <title>Add Item-Inventory Management System</title>
    <style>
        body
        {
            font-family: garamond;
            background: url(css/addinv.jpg);
            background-size: cover;
            background-position: center;
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
  <h4>Add Product Page</h4>
  <center>
  <div class="centre">
      <form method="POST">
          <b>Enter New Product Name:</b><br>
          <input type="text" name="prname" placeholder="Product Name" required><br>
          <b>Enter The Product Description:</b><br>
          <input type="text" name="prdes" placeholder="Product Description"><br>

          <b>Enter Unit of the Product:</b> (select one option)<br>
          <select name="prunit" id="prunit" required>
              <option></option>
            <option value="Number">Number</option>
            <option value="Litre">Litre</option>
            <option value="Metre">Metre</option>
			  <option value="Pound">Pound</option>
			  <option value="Kg">Kg</option>
            <option value="Gram">Gram</option>
          
            </select><br>
          <!--<input type="number" name="prounit" placeholder="Product Unit"><br>-->
          <b>Enter Unit Price of the Product:</b><br>
          <input type="number" name="prprice" placeholder="Product Price per Unit" required><br><br>
          <button name="add" class="btn btn-secondary">Add Product</button>
        </form>
  </div>
  </center>
    <?php
        if(isset($_POST['add'])){
            $sql = "SELECT `proName` FROM `inventory` WHERE `proName` = '$_POST[prname]'";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                echo "<br><b><center>Already Existed Product!!!If you want to update then go back then go to update item</center></b>";
            }
            else{
                $sql1 = "INSERT INTO `inventory`(`proName`, `proDes`, `unt`, `untPrice`) VALUES ( '$_POST[prname]' , '$_POST[prdes]' , '$_POST[prunit]' , '$_POST[prprice]' )";
                $result1 = $conn->query($sql1);
                if($result1==TRUE){
                    echo "<br><b><center>The product is inserted Successfully!!</center></b>";
                }

            }
        }
    ?>
    <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" class="btn btn-outline-info" value="Back" placeholder="Back" name="back">
    </form>
    <div class="back">
    <?php
    if(isset($_POST['back'])){
        $_SESSION['na'] = $adname;
        header('Location: adPage.php');
    }
    ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>