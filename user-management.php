<?php
session_start();
include('config/db_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User Management</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
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
    /* .search{
        width: 10px;
    } */
            
            
  .hi-admin{
    font-size: 1rem;
  }
  .recipes-section{
            font-family: 'Open Sans Condensed', sans-serif;
            width: 100vw;
            font-size: 1rem;
            margin-top: 90px;
                    }
 
  
        </style>
     <?php include('template/admin-header.php'); ?>

            <section class=" recipes-section">


            </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
