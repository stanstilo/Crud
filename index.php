<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<?php require_once "process.php";
?>
<!-- print session variable from process.php to index page -->
<?php
if (isset($_SESSION["message"])) ?>
<div class="alert alert- <?=$_SESSION['msg_type']?>">

<?php
echo $_SESSION["message"];
unset($_SESSION["message"]);
?>
</div>
<?phpendif; ?>

<div class="container">
<?php
$mysqli = new mysqli("localhost", "root", "", "crud") or die (mysqli_error());
$result = $mysqli->query("SELECT * FROM data") or die ($mysqli->error());
?>

<!-- pre_r($result); -->
<!-- pre_r($result->fetch_assoc()); -->
<!-- pre_r($result->fetch_assoc()); -->
<div class="row justify-content-center">
<table class= "table">
<thead>
   <tr>
   <th>Name</th>
   <th>Location</th>
   <th colspan="2">Action</th>
   </tr>
</thead>
<?php
while($row=$result->fetch_assoc()): 
?>
<tr>
<td><?php echo $row["name"];?></td>
<td><?php echo $row["location"];?></td>
<td>
<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">edit</a>
<a href="process.php?Delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
</tr>
<?php endwhile; ?>
</table>
</div>
</div>
<?php
function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>
<div class="container">
<div class="row justify-content-center">
    <form action="process.php" method="POST">
    <!-- input field with the value of the record id to access it from post -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
    <label>Name</label>
    <input type="text" value="<?php echo $name;?>" placeholder="Enter your name" name="name" class="form-control">
    </div>
    <div class="form-group">
    <label>location</label>
    <input type="text" name="location" value="<?php echo $location;?>" placeholder="Enter your location" class="form-control">
    </div>
    <div class="form-group">
    <?php 
    if ($update== true):
        ?>
          <button type="submit" name="update" class="btn btn-info">update</button>
    <?php else: ?>
    <button type="submit" name="save" class="btn btn-primary">save</button>
    <?php endif ?>
    </div>
    </form>
    </div>
    </div>
</body>
</html>