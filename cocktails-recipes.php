<?php
session_start();
include('config/db_connect.php');

//write query for all pizzas
$sql = 'SELECT cocktail, ingredients, id FROM recipes2 ORDER BY cocktail'; 
// if (isset($_POST['submit-search'])){
//     $search = mysqli_real_escape_string($conn, $_POST['$_search']);
//     $sql = "SELECT * FROM recipes WHERE title LIKE '%search%'";
//     $result = mysqli_query($conn, $sql);
//     $queryResult = mysqli_num_rows($result);

    // if ($queryResult > 0){
    //    
         
    //     }
//     else {
//         echo "there is no result matching your search!";
//     }
// }

//make query & get result
$result = mysqli_query($conn, $sql);

//fetch the resulting row as an array
$recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Recipes</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
        <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        
       
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');

            * {
  margin: 0;
  padding: 0;
  list-style: none;
  text-decoration: none;
  box-sizing: border-box;
  /* background: rgb(25, 39, 53); */
}
/* .input-group2{
    width: 50%;
    margin: auto;
}
.search-container{
        width: 100%;
        display: flex;
        background: rgba(0, 92, 117, 0.5);
       position: fixed;
       margin-bottom: 200px;
       height: auto;
      
       z-index: 1;
    }
    .recipes-container{
        margin-top: 190px;
    }

    .search-input{
        width: 88%;
        border-radius: 15px;
        padding-bottom: 0px;
        padding-top: 0px;  
      

    }
    .search-submit{
        width: 8%;
        
    }
    .search-submit1{
       margin-left: 2px;
       height: 45px;
        
    } */

            .recipes{
            font-family: 'Open Sans Condensed', sans-serif;
            width: 100%;
            font-size: 1rem;
                    }
           
           .my-bg{
            background: #0D0A13;
            width: 100%;
            margin: 0;
            height: 100%;
           }
           .recipe{
      width: 80px;
      margin: 40px auto -30px;
      display: block;
      position: relative;
      top: -35px;
      z-index: 1;
    }
    .card-action{
        float: right;
    }
    .details{
        font-size: .8rem;
    }
    .more-info-container{
        padding-top: 1px;
        padding-bottom: 1px;
        height: 27px;
    }
    .more-info{
       float: right;
       padding-top: .001rem;
       padding-bottom: .001rem;
       margin-right: .2rem;
       /* background: brown; */
       border: none;

    }
    ::-webkit-scrollbar{
    width: 15px;
    height: 5px;
}
::-webkit-scrollbar-thumb{
    background: grey;
    border-radius: 50px;
}
::-webkit-scrollbar-track{
    background: #0D0A13;
}  
  .hi-admin{
    font-size: 1rem;
  }
  .recipes-section{
            font-family: 'Open Sans Condensed', sans-serif;
            width: 100vw;
            font-size: 1rem;
                    }
 .ingredients-card{
     width: 100%;
     padding-left: 0;
 }
 ul {
    padding: 0;
    list-style-type: none;
}

  section{
    height: 100vmax;
  }
        </style>
     <?php include('template/admin-header.php'); ?>

            <section class="recipes-section mb-5 pb-5">

       <!-- Navbar Search-->
       <!-- <div class="search-container mb-5 pt-5">
           <div class="text-white mt-3"><h3 class="ms-3">Recipes</h3></div>
           <form action="search.php" method="POST" class=" d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 align-item-center input-group2 me-3">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search a recipe..." aria-label="Search for..." aria-describedby="btnNavbarSearch" name="search"/>
                    <button class="btn btn-primary" name="submit-search" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form> 
       </div> -->
      
            
<div class="container-fluid recipes-container mt-3 pt-5">
<h2 class="py-2 text-light bg-dark text-muted rounded text-center mb-4"><i class="fa-solid fa-book-open-reader"></i> Cocktails Recipes</h2>
<div class="row">
<?php foreach($recipes as $recipe): ?>
<div class="col-6 col-lg-3 col-md-4">
 <div class="card z-deph-0 mb-4">
     <div img-container>
           <img src="images/NEW - C _ E Round Logo _ Colour New tagline _ High.png" alt="" width="100px" class="recipe">
     </div>
   <div class="card-content text-center text-muted">
     <h6 class="fw-bold "><?php echo htmlspecialchars($recipe['cocktail']); ?></h6>
 <div class="ingredients-card">
      <ul>
      <?php foreach(explode(',', $recipe['ingredients']) as $ing): ?>
       <li><?php echo htmlspecialchars($ing);?></li>
       <?php endforeach ?>
    </ul>
    
 </div>
  
   </div>
   <div class="card-action mb-1 more-info-div">
     <!-- go to a specific details according to recipe id -->
     
     <a class="btn btn-warning text-decoration-none text-white btn-sm more-info " href="details-cocktail.php?id=<?php echo $recipe['id']?>">More Info</a>
   </div>
 </div>
</div>
<?php endforeach ?>

</div>
</div>

</section>
<div class="section-remix mt-5">

</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
