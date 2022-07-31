<?php
include('config/db_connect.php');

   if(isset($_POST['duty_time'])){
      
    echo "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, repellendus sint obcaecati atque inventore est quis! Culpa delectus molestias, fugiat possimus doloremque corporis deserunt minus vitae, pariatur numquam nisi ipsum";
 }


 $sql17 = "SELECT * FROM duty_time";
       
 //get the query result
 $result17 = mysqli_query($conn, $sql17);

//fetch result in array format
 $duty = mysqli_fetch_assoc($result17);
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="operations.php" method="$_POST">
        <input type="hidden">
        <input type="text">
        <button name="duty_time" type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>