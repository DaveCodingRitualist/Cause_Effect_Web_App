<?php
session_start();
include('config/db_connect.php');
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  //To prevent mysql injection
  $username = stripslashes($username);
  $password = stripslashes($password);
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);

  $query = "SELECT * FROM tbl_users WHERE Username='$username' AND password='$password'";
  $result = mysqli_query($conn,$query);

  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      if($row["roleid"] == "1"){
        $_SESSION['User'] = $row["name"];
        header('Location: admin.php');
      }else{
        $_SESSION['User'] = $row["name"];
        header('Location: index.php');
      }
    }
  }
 else {
 
   header('Location: login.php');
   $error = "Username or Password not correct!";
 }
} 

?>

<!DOCTYPE html>
<html lang="en">
  
  <?php include('template/header.php'); ?>
  <style>
    .form-box2{
  width: 380px;
  height: 280px;
  position: relative;
  margin: 2% auto;
  background: rgba(0, 92, 117, .5);
   padding: 10px;
   margin: auto;
   border-radius: 10px;
    }
    .submit-btn {
  padding: 10px 30px;
  cursor: pointer;
  display: block;
  margin: auto;
  background: rgba(165, 42, 42, .5);
  border: 0;
  outline: none;
  border-radius: 5px;
  width: 100%;
  color: white;
  /* color: brown; */
}
.input-field2{
  display: flex;
}
.input2{
  display: flex;
}
.bubbles2 {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-around;
  position: absolute;
  bottom: -70px;

}
.full-page{
  overflow: hidden;
  height: 100%;
}
.home-title{
  display: block;
}
.terms{
  background: rgba(0, 92, 117, .8);
  color: white;
  border-radius: 5px;
  font-size: 1rem;
 
 
}
</style>
<section class="full-page">
  <div class="container-md">
      <div class="logo text-center mt-3 mb-3">
          <img src="./images/NEW - C _ E Round Logo _ Colour New tagline _ High.png" alt="cause_effect_logo"  width="100px" class="img-fluid CE_logo">
      </div>  
      <div class="row container">
<form class="form-box2" method="POST" action="login.php">
     <div class="input2">
         <i class="bi bi-person-fill mt-3 me-2 fw-bold text-white"></i>       
       <input type='text' class='class="input-field2 input-field text-white' placeholder='User Name' name="username" required> 
      </div>
     <div class="input2">
         <i class="bi bi-lock-fill mt-3 me-2 fw-bold text-white"></i>       
         <input type='password' class='input-field text-white' name="password" placeholder='Enter Password'required>
      </div>
      <p class="text-center" style="color:red;">
     <?php 
     if(isset($_POST['submit'])){
     if(mysqli_num_rows($result) < 0){
      // $error = "Username or Password not correct!";
     }
     if(mysqli_num_rows($result) > 0) {
       echo $error = "";
     }
    }
    ?>
      </p>
      
          <button type='submit'  name="submit" class='submit-btn mt-3'>Login</button>
          <div class="terms mt-2">
        <p class="p-1 text-center">
          By clicking Login you accept <span class="text-info">terms</span>  and <span class="text-info">conditions</span>  of using this App
        </p>
      </div>
        </form>
    </div>
      
   <div class="bubbles2">
      <img src="./images/bubble.png" width="50px" alt="">
      <img src="./images/bubble.png" width="50px" alt="">
      <img src="./images/bubble.png" width="50px" alt="">
      <img src="./images/bubble.png" width="50px" alt="">
      <img src="./images/bubble.png" width="50px" alt="">
      <img src="./images/bubble.png" width="50px" alt="">
      <img src="./images/bubble.png" width="50px" alt="">
    </div>

    </div>
</section>
    <?php include('template/footer.php'); ?>
</html>