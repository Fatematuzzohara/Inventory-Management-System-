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

    <title>Update Item-Inventory Management System</title>
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
    <center><div class="centre">
    <?php
    $sql = "SELECT * FROM `inventory` WHERE `proName` = '$_SESSION[prname]'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pu = $row['unt'];
            echo "<form method='POST'>
                <h6>Updating " . $row['proName'] . "</h6>
                <b>Update Name:</b><br>
                <input type='name' name='prname' placeholder='$row[proName]'><br>
                <b>Update Description:</b><br>
                <input type='text' name='prdes' placeholder='$row[proDes]'><br>
                <b>Update Unit: (Select one)</b><br>
                <select name='prunit' id='prunit'>
                <option></option>
                    <option value='Kg'>Kg</option>
                    <option value='Litre'>Litre</option>
                    <option value='Gram'>Gram</option>
                    <option value='Number'>Number</option>
                </select><br>
                <b>Update Unit Price:</b><br>
                <input type='number' name='prprice' placeholder='$row[untPrice]'><br>
                <button name='update' class='btn btn-primary'>Update</button>
              </form>";
            $pn = $row['proName'];
            $pd = $row['proDes'];
            $pp = $row['untPrice'];
        }
    }

    if (isset($_POST['update'])) {
        //echo"clicked";
        $name = $_POST['prname'];
        if (!$_POST['prname']) {
            $name = $pn;
        }
        $desc = $_POST['prdes'];
        if (!$_POST['prdes']) {
            $desc = $pd;
        }
        $unit = $_POST['prunit'];
        if (!$_POST['prunit']) {
            $unit = $pu;
        }
        $up = $_POST['prprice'];
        if (!$_POST['prprice']) {
            $up = $pp;
        }
        //echo $name . $desc . $unit . $up . $pn;
        $sql1 = "UPDATE `inventory` SET `proName`='$name',`proDes`='$desc',`unt`='$unit',`untPrice`='$up' WHERE `proName` = '$pn'";
        $result1 = $conn->query($sql1);
        if ($result1 == TRUE) {
            echo "<br><b>The ". $_SESSION['prname']." is updated Successfully.</b>";
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