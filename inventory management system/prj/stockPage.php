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
        h1,h4,b
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
    <title>Stock Status-Inventory Management System</title>
  </head>
  <body>
  <h1>Hello, <?php echo $adname; ?></h1>
  <h4>Stock Status page</h4>
  <center>
  <form method="POST" >
  
          <?php
            $sql="SELECT * FROM `inventory`";
            $result=$conn->query($sql);
            if($result->num_rows>0){
                echo "<b>Inventory Stock Table</b><br>";
                    echo "<table border=2>
                            <tr>
                                <th>Product Name</th>
                                <th>Total Purchase</th>
                                <th>Total Sale</th>
                                <th>Remain Stock</th>
                            </tr>";
                    while ($row=$result->fetch_assoc()) {
                        $name = $row['proName'];
                        $qp=0;
                        $sqlp="SELECT `quantity` FROM `purch` WHERE `proName` = '$name'";
                        $resultp = $conn->query($sqlp);
                        if($resultp->num_rows>0){
                            while($rowp=$resultp->fetch_assoc()){
                                $qp=$qp+$rowp['quantity'];
                            }
                        }
                        $qs=0;
                        $sqls="SELECT `quantity` FROM `sales` WHERE `proName` = '$name'";
                        $results = $conn->query($sqls);
                        if($results->num_rows>0){
                            while($rows=$results->fetch_assoc()){
                                $qs=$qs+$rows['quantity'];
                            }
                        }
                        $sq=$qp-$qs;
                        if($sq>0){
                            echo "<tr>
                            <td>{$name}</td>
                            <td>{$qp}{$row['unt']}</td>
                            <td>{$qs}{$row['unt']}</td>
                            <td>{$sq}{$row['unt']}</td>
                            </tr>";
                        }
                        else{
                            echo "<tr>
                            <td>{$name}</td>
                            <td>{$qp}{$row['unt']}</td>
                            <td>{$qs}{$row['unt']}</td>
                            <td>Out of Stock</td>
                            </tr>";
                        }
                        
                    }
                    echo "</table>";}
            
                else{echo "<b>There is no product in this system!!</b><br>";}
          ?>
  </form>
  <?php
        
  ?>
  <br>
  <b>*If any item is out of stock, it means it should be deleted or have to be purchased again by admin.*</b><br>
  <br><br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" class="btn btn-outline-dark" value="Back" placeholder="Back" name="back">
    </form>
    <?php
    if(isset($_POST['back'])){
        $_SESSION['na'] = $adname;
        header('Location: adPage.php');
    }
    ?>
  </center>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>