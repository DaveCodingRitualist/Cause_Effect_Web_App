<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
  
  <?php include('template/header.php'); ?>
  <style>
    .welcome{
  
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 1.1rem;
   }
   .smartbar-title {
  background: transparent;
  margin-top: -0.8rem;
  font-size: 1.1rem;
  font-family: 'Open Sans Condensed', sans-serif;
  display: inline-block;
  font-size: 1rem;
  position: fixed;
  right: 1rem;
  color: white;
  z-index: 1;
  top: .5rem;
}
.admin-panel{
    left: 1rem;
    padding-left: 1rem;
    display: inline-block; 
     margin-left: .5rem;
}
.logout-btn{
  height: fit-content;
  padding-top: .3px;
  padding-bottom: .3px;
}
  </style>
  <div class="bg-dark">
  <input type="checkbox" id="check">
  <label for="check">
    <div class="home-title">
              <div>
                  <i class="fas fa-bars" style="background-color: #191C24;" id="btn">
                  </i>
              </div>
      <div class="smartbar-title pt-2">
      <span class="welcome"><i class="bi bi-person-circle me-2 ms-5"></i>   Hi! <?php echo $_SESSION['User']; ?></span>
      <a class="btn btn-danger btn-sm ms-2 logout-btn" href="#" role="button">Log Out</a>
      </div> 
    </div>
    <i class="fas fa-times" id="cancel"></i>
  </label>
  <div class="sidebar" style="background-color: #191C24;">
  <header class="header-title">
  Admin Panel
      </header>
  <ul>
    <li><a href="index.php"><i class="fas fa-house-user"></i>Home</a></li>
    <li><a href="user.php"><i class="bi bi-people-fill"></i>Users</a></li>
    <li><a href="categorie"><i class="fas fa-book"></i>Recipes</a></li>
    <li><a href="#"><i class="fas fa-cart-arrow-down"></i>Ingrediens</a></li>
    <li><a href="#"><i class="fas fa-book-open"></i>Cheatsheet</a></li>
  </ul>
</div>
  <section class="bg-black">
    <?php   include('admin-header.php');?>
  
  </section>
  <?php include('template/footer.php'); ?>
</html>



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
   
    .recipes-section{
        width: 100%;
    }
            .recipes{
            font-family: 'Open Sans Condensed', sans-serif;
            width: 100vw;
            font-size: 1rem;
                    }
            .add-recipes-container{
                width: 80vw;
            }
           .my-bg{
          
            background: rgb(25, 39, 53);
            width: 100%;
            height: 100%;
           
                }
                .add-recipe-btn{
                    margin-left: 1rem;
                }
     
     </style>