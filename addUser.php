<?php
session_start();
include('config/db_connect.php');

$email = $name = $username = $mobile = $password = $roleid = '';  
  $errors = array('email' => '', 'name' => '', 'username' => '', 'mobile' => '', 'password' => '', 'roleid' => '');

	if(isset($_POST['add-user'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Your Email must be a valid email address';
			}
		}

		// check user name
		if(empty($_POST['name'])){
			$errors['name'] = 'An User Name is required';
		} else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errors['name'] = 'User name must be letters and spaces only';
			}
		}
		// check user name
		if(empty($_POST['username'])){
			$errors['username'] = 'An User Name is required';
		} else{
			$username = $_POST['username'];
			if(!preg_match('/^[a-zA-Z\d]{4,12}+$/', $username)){
				$errors['username'] = 'Type a correct username syntax please';
			}
		}
    //check Mobile
    if(empty($_POST['mobile'])){
      $errors['mobile'] = 'At least one mobile is required';
    } else{
      $mobile = $_POST['mobile'];
      if(!preg_match('/^([0][\d]{9})*$/', $mobile)){
        $errors['mobile'] = 'Type a correct mobile number!';
      }
    }
		// check password
    if(empty($_POST['password'])){
      $errors['password'] = 'Password is required';
    } else{
      $password = $_POST['password'];
			if(!preg_match('/^[\w@-]{8,20}$/', $password)){
				$errors['password'] = 'Type the correct syntax for password!';
      }
    }
		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$roleid = mysqli_real_escape_string($conn, $_POST['roleid']);

			// create sql
			$sql = "INSERT INTO tbl_users(email,name,username,mobile,password,roleid) VALUES('$email','$name','$username','$mobile','$password','$roleid')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: manage-users.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			
		}

	} // end POST check


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
       
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');

            * {
  margin: 0;
  padding: 0;
  list-style: none;
  text-decoration: none;
  box-sizing: border-box;
  color: #FFFFFF;

  /* background: rgb(25, 39, 53); */
}

            .recipes{
            font-family: 'Open Sans Condensed', sans-serif;
            width: 100%;
            font-size: 1rem;
                    }
            .add-recipes-container{
                width: 80vw;
            }
           .my-bg{
            background: #0D0A13;
            width: 100%;
            margin: 0;
            height: 100%;
                }
                .add-recipe-btn{
                    margin-left: 1rem;
                }
                /* .par-form {
  color: #FFFFFF;
  font-size: .9rem;
  width: 150px;
  margin: auto;
  padding-top: .5rem;
  padding-bottom: .5rem;
  border-radius: 5px;
  margin-top: 1rem;
  text-align: center;
  background: rgba(255, 255, 255, .3);
  box-shadow: rgb(226, 168, 10);
} */

.form-title {
  width: 80vw;
  background: rgba(255, 255, 255, .3);
  margin: auto;
  color: white;
  padding: 10px 0px 10px 0px;
  text-align: center;
  border-radius: 10px 10px 0px 0px;
}

.form-body {
  width: 80vw;
  max-width: 100rem;
  height: auto;
  /* background: rgba(255, 255, 255, .1); */
  margin: auto;
  align-items: center;
  color: #FFFFFF;
  padding-bottom: 1rem;
  margin-top: 0;
  display: flex;
  flex-direction: column;
  z-index: -1;
  overflow: hidden;
}

.form-entry1 {
  width: 80vw;
  background: rgba(255, 255, 255, .2);
  height: 110px;
  margin-bottom: 5px;
  border-radius: 0px 0px 5px 5px;
  z-index: 0;
  padding-top: 10px;
  /* padding-bottom: 10px; */
  letter-spacing: 2px;
  align-items: center;
  justify-items: center;
}

.form-entry {
  width: 80vw;
  background: rgba(255, 255, 255, .2);
  height: 120px;
  margin-bottom: 5px;
  border-radius: 5px;
  z-index: 0;
  padding-top: 20px;
  letter-spacing: 2px;
  margin-top: 10px;
}

.input {
  /* background: rgba(255, 255, 255, .1); */
  border-top: none;
  border-left: none;
  border-right: none;
  height: 20px;
  border-bottom: 1px solid white;
  color: white;
  width: 280px;
  background: transparent;
  outline: none;
  padding-top: .2px;
  margin-top: .2px;
}

.juices-label, .input {
  background: none;
}

.form-container {
  padding-left: 20px;
  background: none;
}

.submit {
  color: white;
  background: rgb(0, 92, 117);
  font-size: 1rem;
  padding-top: 5px;
  padding-bottom: 5px;
  border-radius: 15px;
  border: none;
  margin-top: 10px;
  outline: none;
  cursor: pointer;
}

.submit:hover {
  border: 1px solid white;
} 
.recipes-form{
    margin: auto;
    align-items: center;
}
   .recipes-submit{
     width: 99%;
    border-radius: 5px;
    background-color: brown;
  }
  .hi-admin{
    font-size: 1rem;
  }
  .error{
    width: 100%;
    height: 20px;
    background-color: transparent;
    margin-top: 2px;
    color: red;
    
  }
        </style>

<?php include('template/admin-header.php'); ?>
   
             <section class="recipes">
       <div class="mt-5 pt-2">

                <div class="add-recipes-container">
                 
                </div>
                
                <div class="row mt-4">
                    
                    <div class="recipes-form">
                    
                    <div class="form-title  text-small">User Registration</div>
    <div class="form-body">
      <form action="addUser.php" method="POST">
        <div class="form-entry1">
          <div class="form-container">
            <label for="" class="juices-label">Email
            </label><br><br>
            <input type="text" class="input" placeholder="Enter your Email" name="email" value = "<?php echo htmlspecialchars($email) ?>">
      <div class="red-text error"><?php echo $errors['email']; ?></div>
          </div>
        </div>
        <div class="form-entry">
          <div class="form-container">
            <label for="" class="juices-label">Name</label><br><br>
            <input type="text" placeholder="Enter User Name" class="input" name="name" value = "<?php echo htmlspecialchars($name) ?>">
            <div class="red-danger error"><?php echo $errors['name']; ?></div>
          </div>
        </div>
        <div class="form-entry">
          <div class="form-container">
            <label for="" class="juices-label">User Name</label><br><br>
            <input type="text" placeholder="Enter User Name" class="input" name="username" value = "<?php echo htmlspecialchars($username) ?>">
            <div class="red-danger error"><?php echo $errors['username']; ?></div>
          </div>
        </div>
        <div class="form-entry">
          <div class="form-container">
            <label for="mobile" class="juices-label"> Mobile Number</label><br><br>
            <input type="text" placeholder="Enter Mobile number" class="input" name="mobile" value = "<?php echo htmlspecialchars($mobile) ?>">
            <div class="red-text error"><?php echo $errors['mobile']; ?></div>
          </div>
        </div>
        <div class="form-entry">
          <div class="form-container">
            <label for="password" class="juices-label">Password</label><br><br>
            <input type="password" placeholder="Enter Password" class="input" name="password" value = "<?php echo htmlspecialchars($password) ?>">
            <div class="red-text error"><?php echo $errors['password']; ?></div>
          </div>
        </div>
        <div class="form-entry">
          <div class="form-container">
          <label for="sel1">Select user Role</label><br><br>
          <select class="form-control bg-dark text-white" style="width: 75%;" name="roleid" id="roleid">
              <div >
                  <option value="1">Admin</option>
                      <option value="2">User only</option>
              </div>
                    </select>
          </div>
        </div>
        <div class="text-center">
            <button class="submit recipes-submit ps-3 pe-3 " value="submit" name="add-user" pt-1 pb-1">Submit</button>
        </div>
        
      </form>

            </div>
        </div>
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

