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
    <link rel="stylesheet" type = "text/css" href="css/adpage.css"> 
    <title>Admin Page-Inventory Management System</title>
</head>

<body>
    <h1>Welcome to Admin Page, <?php echo $adname; ?></h1>
    <div class="logout">
    <form method="POST">
        <button name="logout" class="btn btn-outline-secondary">Log Out</button>
    </form>
    </div>
    <centre>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: adLogin.php');
    }
    
    echo "<div class='info'" ;
    $sql = "SELECT * FROM `inventory`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<br><br><br><center><b>The list of Inventory</b></center><br>";
        echo "<table border='4' class='center'>
                        <tr>
                      <th>Product Name</th>
                      <th>Product Description</th>
                      <th>Unit</th>
                      <th>Unit Price</th>
                      </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td> {$row['proName']} </td>
                    <td> {$row['proDes']} </td>
                    <td> {$row['unt']} </td>
                    <td> {$row['untPrice']} </td>
                    </tr>";
        }
        echo "</table><br><br><br>";
    }
    else {echo "<br><br><br><b>No inventory record in this system!!!</b><br><br><br>";}
    echo "</div>";
    ?>
    </centre>
    <centre>
    <div class= "option">
    <form method="POST">
        <b>Product Information Management: </b><br>
        <button name="add" class="btn btn-secondary">Add Item</button>
        <button name="delete" class="btn btn-secondary">Delete Item</button>
        <button name="update" class="btn btn-secondary">Update Item</button>
    </form>
    <br><br>
    <?php
    if (isset($_POST['add'])) {
        $_SESSION['na'] = $adname;
        header("Location: addPage.php");
    } elseif (isset($_POST['delete'])) {
        $_SESSION['na'] = $adname;
        header("Location: dltPage.php");
    } elseif (isset($_POST['update'])) {
        $_SESSION['na'] = $adname;
        header("Location: updatePage.php");
    }
    ?>
    <form method="POST">
        <b>Stock Management: </b><br>
        <button name="pur" class="btn btn-dark">Purchase Entry</button>
        <button name="sale" class="btn btn-dark">Sale entry</button>
        <button name="ss" class="btn btn-dark">Stock Status</button><br><br>
        <b>Transaction Report Management: </b><br>
        <button name="trd" class="btn btn-secondary">Daily Transaction report</button>
    </form>
    <?php
    if (isset($_POST['pur'])) {
        $_SESSION['na'] = $adname;
        header('Location: purchPage.php');
    } else if (isset($_POST['sale'])) {
        $_SESSION['na'] = $adname;
        header('Location: salePage.php');
    } else if (isset($_POST['ss'])) {
        $_SESSION['na'] = $adname;
        header('Location: stockPage.php');
    } else if (isset($_POST['trd'])) {
        $_SESSION['na'] = $adname;
        header('Location: dreport.php');
    }
    ?>
    </div>
    </centre>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>