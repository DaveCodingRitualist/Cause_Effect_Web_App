<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="./style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
  
 
  <?php include('template/user-header.php'); ?>
  <style>
     @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');
     *{
      font-family: 'Open Sans Condensed', sans-serif;
     }      
     .my-bg{
            background: #0D0A13;

                }
    .welcome{
  
  font-family: 'Open Sans Condensed', sans-serif;
  font-size: 1.1rem;
}
.user-container{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
  </style>
    
     <div class="hero pt-5">
     <div class="user-container">
       <div class="text-center mt-3 ps-3">
        <img src="./images/NEW - C _ E Round Logo _ Colour New tagline _ High.png" alt="" width="100px" class="CE-logo">
      </div>
      <div class="py-5 text-white text-center">
            <span class="welcome ">Hi! <?php echo $_SESSION['User']; ?>,  Welcome Back to</span>
            <h1 >Cause<span id="caracter2">|</span>Effect
               Smart Bar </h1>
          </div>
      </div>
     
     
          
         <div class="side-bar2 pt-5
         ">
           <img src="./images/menu.png" alt="" class="menu">
           <div class="social-links">
             <img src="./images/fb.png" alt="">
             <img src="./images/ig.png" alt="">
             <img src="./images/tw.png" alt="">
           </div>
           <div class="useful-links">
             <img src="./images/share.png" alt="">
             <img src="./images/info.png" alt="">
           </div>
           
         </div>
        <div class="bubbles">
          <img src="./images/bubble.png" width="50px" alt="">
          <img src="./images/bubble.png" width="50px" alt="">
          <img src="./images/bubble.png" width="50px" alt="">
          <img src="./images/bubble.png" width="50px" alt="">
          <img src="./images/bubble.png" width="50px" alt="">
          <img src="./images/bubble.png" width="50px" alt="">
          <img src="./images/bubble.png" width="50px" alt="">
        </div>
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