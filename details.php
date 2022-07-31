<?php
session_start();
include('config/db_connect.php');
if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM recipes WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        //success
        header('location: prep-recipes.php');
    } {
        //failure
        echo 'query error: '. mysqli_error($conn);
    }
}
//check GET request id parameter
if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //make sql
    $sql = "SELECT * FROM recipes WHERE id = $id";

    //get the query result
    $result = mysqli_query($conn, $sql);

    //fetch result in array format
    $recipe = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Add Recipes</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        <style>
           .my-bg{
            background: #0D0A13;

                }
                .delete{
                    color: white;
                    /* background: brown; */
                    border: none;
                    background: brown;
                }
        </style>
    <?php include('template/admin-header.php');?>
            <div id="layoutSidenav_content" class="my-bg">
            <div class="container text-center text-muted mt-3">
    <?php if($recipe): ?>
        <h4><?php echo htmlspecialchars($recipe['title']); ?></h4>
        <p>created at: <?php echo date($recipe['created_at']);?></p>
        <h5>Yield</h5>

<p><?php echo htmlspecialchars($recipe['yield'])?></p>

        <h5>Ingredients</h5>
        
        <p><?php echo htmlspecialchars($recipe['ingredients'])?></p>
        <h5>Method</h5>
        <p><?php echo htmlspecialchars($recipe['method'])?></p>
    
        <!-- DELETE FORM -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $recipe['id'] ?>">
            <input type="submit" name="delete" value="delete" class="btn delete">
            <div class="center text-muted mt-5">Copyright &copy;<?php // Store the year to
// the variable
$year = date("Y"); 
  
// Display the year
echo $year;?> CAUSE <span style="color: brown;">|</span> ƎFFECT</div>
        </form>
    <?php else: ?>
        <h5>NO such recipe exist</h5>
     <?php endif; ?>   
</div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <footer class="">
 
</footer>


    </body>
</html>
