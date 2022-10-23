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
        <style>
        table,
th,
td {
    align-items: center;
    border: 3px solid white;
    border-collapse: collapse;
    text-align: center;
    background-color: rgb(217, 240, 63);
    border-color: black;
    font-size: 25px;
}
th {
    background-color: rgb(241, 95, 10);
}
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
        b
        {
            background-color: rgba(247, 136, 2,0.5);
            text-align: center;
            font-family: garamond;
            font-size: 25px;
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
    <title>Transaction Report-Inventory Management System</title>
  </head>
  <body>
  <h1>Hello, <?php echo $adname; ?></h1>
  <h4>Daily Transaction Report</h4>
  <b>*To generate daily report, you have to enter one date.Starting date*<br>
    *To generate monthly report, you have to enter two dates.Starting and Ending date*</b><br><br>
  <form method="POST">
      <b>Select Starting date:</b>
      <input type="date" name="sdate" required><br>
      <b>Select Ending date:</b>
      <input type="date" name="edate">
      <button name="Show">Generate Report</button>
  </form>
  <br>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" class="btn btn-outline-dark" value="Back" placeholder="Back" name="back">
    </form>
    <?php
    if(isset($_POST['back'])){
        $_SESSION['na'] = $adname;
        header('Location: adPage.php');
    }
    ?>
    <center><div class="centre">
  <?php
    if(isset($_POST['Show'])){
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];
        if($sdate==$edate or !$_POST['edate']){
            echo "<b>Showing Report of " . $sdate . ".</b><br><br>";
            $sqlp="SELECT * FROM `purch` WHERE `date` = '$sdate'";
            $sqls="SELECT * FROM `sales` WHERE `date` = '$sdate'";

        }
        else {
            echo "<b>Showing Report between " . $sdate . "and ". $edate . ".</b><br><br>";
            $sqlp="SELECT * FROM `purch` WHERE `date` >= '$sdate' and `date` <= '$edate'";
            $sqls="SELECT * FROM `sales` WHERE `date` >= '$sdate' and `date` <= '$edate'";

        }
        $ptotal=0;
        
        $resultp=$conn->query($sqlp);
        if($resultp->num_rows>0){
            echo "<b>Purchase Record:</b><br><table border=2>
                            <tr>
                                <th>Product Name</th>
                                <th>Purchase Quantity</th>
                                <th>Unit per Price</th>
                                <th>Total</th>
                                <th>Purchase Date</th>
                            </tr>";
            while($rowp=$resultp->fetch_assoc()){
                echo "<tr>
                            <td>{$rowp['proName']}</td>
                            <td>{$rowp['quantity']} . {$rowp['unt']}</td>
                            <td>{$rowp['untPrice']}</td>
                            <td>{$rowp['total']}</td>
                            <td>{$rowp['date']}</td>
                        </tr>";
                $ptotal=$ptotal+$rowp['total'];
                //echo $rowp['proName'] . $rowp['unt']. $rowp['quantity'] . $rowp['untPrice'] . $rowp['total'] . "<br>";
            }
            echo "</table><br><b>Total Purchase on this duration is ". $ptotal . "BDT.</b><br>";
        }
        else{echo"There is no purchase record in this Duration.";}
        echo "<br>";
        $stotal=0;
        $results=$conn->query($sqls);
        if($results->num_rows>0){
            echo "<b>Sale Record:</b><br><table border=2>
                            <tr>
                                <th>Product Name</th>
                                <th>Sale Quantity</th>
                                <th>Unit per Price</th>
                                <th>Total</th>
                                <th>Sale Date</th>
                            </tr>";
            while($rows=$results->fetch_assoc()){
                echo "<tr>
                            <td>{$rows['proName']}</td>
                            <td>{$rows['quantity']} . {$rows['unt']}</td>
                            <td>{$rows['untPrice']}</td>
                            <td>{$rows['total']}</td>
                            <td>{$rows['date']}</td>
                        </tr>";
                $stotal=$stotal+$rows['total'];
            }
            echo "</table><br><b>Total Sale on this duration is ". $stotal . "BDT.</b><br><br>";
        }
        else{echo"There is no sale record in this Duration.";}
        if($ptotal>$stotal){
            $oo = $ptotal - $stotal ;
            echo "<h4>Total Loss in this duration is " . $oo . "BDT.</h4><br>";
        }
        else if($stotal>$ptotal){
            $oo = $stotal - $ptotal ;
            echo "<h4>Total Revenue/Profit in this duration is " . $oo . "BDT.</h4><br>";
        }
        else{
            echo "<h4>There are no profit or loss. Thank you. </h4><br>";
        }
    }
  ?>
    </div></center>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>