<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['na'])) {
  header('Location: adLogin.php');
} else {
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

  <title>Purchase-Inventory Management Panel</title>
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
  <h1>Hello, <?php echo $adname; ?></h1>
  <h4>Purchase Entry Page</h4>
  <center><div class="centre">
  <form method="POST">
    <b>Enter date of Purchase here:</b><br>
    <input type="date" name="pdate" placeholder="Enter Date" required><br>
    <b>Enter Product Name here:</b><br>
    <input type="name" name="prname" placeholder="Product Name" required><br>
    <b>Enter Unit of the Product here:</b>(select one option)<br>
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
    <b>Enter quantity of the Product here:</b><br>
    <input type="number" name="prquantity" placeholder="Product Quanity" required><br>
    <b>Enter Unit Price of the Product here:</b><br>
    <input type="number" name="prprice" placeholder="Product Price per Unit" required><br>
    <button name="purchase" class="btn btn-secondary">Entry Purchase</button>
  </form>
  <?php
  if (isset($_POST['purchase'])) {
    $total = $_POST['prquantity'] * $_POST['prprice'];
    $sql = "INSERT INTO `purch`(`date`, `proName`, `unt`, `quantity`, `untPrice`, `total`) VALUES ('$_POST[pdate]','$_POST[prname]','$_POST[prunit]','$_POST[prquantity]','$_POST[prprice]','$total')";
    $result = $conn->query($sql);
    if ($result == TRUE) {
      echo "<br><br><b>The record is inserted Successfully.</b>";
      $sql1 = "SELECT `proName` FROM `inventory` WHERE `proName` = '$_POST[prname]'";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows == 0) {
        $sql2 = "INSERT INTO `inventory`(`proName`, `proDes`, `unt`, `untPrice`) VALUES ('$_POST[prname]','','$_POST[prunit]','$_POST[prprice]')";
        $result2 = $conn->query($sql2);
        if ($result2 == TRUE) {
          echo "<br><br><b>This record is inserted Successfully.</b>";
        }
      }
    }
  }
  ?>
  <br><br>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" class="btn btn-outline-dark" value="Back" placeholder="Back" name="back">
  </form>
  <?php
  if (isset($_POST['back'])) {
    $_SESSION['na'] = $adname;
    header('Location: adPage.php');
  }
  ?>
 </center></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>