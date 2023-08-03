<?php
session_start();
include('config/db_connect.php');

$email = $title = $yield = $ingredients = $method = '';  
  $errors = array('email' => '', 'title' => '', 'yield' => '', 'ingredients' => '', 'method' => '');

	if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

		// check title
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}
    //check Yield
    if(empty($_POST['yield'])){
      $errors['yield'] = 'At least one yield is required';
    } else{
      $yield = $_POST['yield'];
      if(!preg_match('/^([\d]+[\.]?[\s]?[\d]?[a-zA-Z]+)*$/', $yield)){
        $errors['yield'] = 'Type the correct syntax!';
      }
    }
		// check ingredients
    if(empty($_POST['ingredients'])){
      $errors['ingredients'] = 'At least one ingredient is required';
    } else{
      $ingredients = $_POST['ingredients'];
			if(!preg_match('/^([\d]+[\.]?[\d]?[a-zA-Z\s]+)(,\s*[\d]+[\.]?[\d]?[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Type the correct syntax for ingredients!';
      }
    }
    //check method
    if(empty($_POST['method'])){
      $errors['method'] = 'method is required';
     } else{
       $method = $_POST['method'];
       if(!preg_match('/^[a-zA-Z0-9,\s]*$/', $method)){
         $errors['method'] = 'method must be letters and space only';
       }
      }
		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
			$yield = mysqli_real_escape_string($conn, $_POST['yield']);
			$method = mysqli_real_escape_string($conn, $_POST['method']);

			// create sql
			$sql = "INSERT INTO recipes(title,email,ingredients,yield,method) VALUES('$title','$email','$ingredients','$yield','$method')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: recipes.php');
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
                    
                    <div class="form-title  text-small">Add Recipes</div>
    <div class="form-body">
      <form action="add-recipes.php" method="POST">
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
            <label for="" class="juices-label">Title</label><br><br>
            <input type="text" placeholder="Enter Your Recipe Name" class="input" name="title" value = "<?php echo htmlspecialchars($title) ?>">
            <div class="red-danger error"><?php echo $errors['title']; ?></div>
          </div>
        </div>
        <div class="form-entry">
          <div class="form-container">
            <label for="" class="juices-label"> Yield</label><br><br>
            <input type="text" placeholder="Enter Yield" class="input" name="yield" value = "<?php echo htmlspecialchars($yield) ?>">
            <div class="red-text error"><?php echo $errors['yield']; ?></div>
          </div>
        </div>
        <div class="form-entry">
          <div class="form-container">
            <label for="" class="juices-label">Ingredients (comma separated):</label><br><br>
            <input type="text" placeholder="Enter Your Ingredients" class="input" name="ingredients" value = "<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text error"><?php echo $errors['ingredients']; ?></div>
          </div>
        </div>
        <div class="form-entry">
          <div class="form-container">
            <label for="" class="juices-label">Method</label><br><br>
            <input type="text" placeholder="Enter your method " class="input" name="method" value = "<?php echo htmlspecialchars($method) ?>">
            <div class="red-text error"><?php echo $errors['method']; ?></div>
          </div>
        </div>
        <div class="text-center">
            <button class="submit recipes-submit ps-3 pe-3 " value="submit" name="submit" pt-1 pb-1">Submit</button>
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



<!-- 
$email = $title = $yield = $ingredients = $method = '';  
$errors = array('email' => '', 'title' => '', 'yield' => '', 'ingredients' => '', 'method' => '');
if(isset($_POST['submit'])){

   //check email
   if(empty($_POST['email'])){
    $errors['email'] = 'An email is required';
   } else{
     $email = $_POST['email'];
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       $errors['email'] = 'email must be a valid email address';
     }
     
   }
//check title
if(empty($_POST['title'])){
    $errors['title'] = 'A title is required';
  } else{
  $title = $_POST['title'];
  if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
    $errors['title'] = 'Title must be letters and space only';
  }

}
if(empty($_POST['ingredients'])){
  $errors['ingredients'] = 'At least one ingredient is required';
} else{
  $ingredients = $_POST['ingredients'];
  if(!preg_match('/^([a-zA-Z0-9-.\s]+)(,\s*[a-zA-Z0-9-.\s]*)*$/', $ingredients)){
    $errors['ingredients'] = 'ingredients must be a comma separated list';
  }
}

if(empty($_POST['yield'])){
  $errors['yield'] = 'At least one yield is required';
} else{
  $yield = $_POST['yield'];
  if(!preg_match('/^([a-zA-Z0-9-.\s]+)*$/', $yield)){
    $errors['yield'] = 'Type the correct syntax please!';
  }
}
if(empty($_POST['method'])){
  $errors['method'] = 'method is required';
 } else{
   $method = $_POST['method'];
   if(!preg_match('/^[a-zA-Z0-9-,\s]+$/', $method)){
     $errors['method'] = 'method must be letters and space only';
   }
  }
    if(array_filter($errors)){
      //echo 'errors in the form';
    } else {
      //protect your database from sql injection

      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      // $yield = mysqli_real_escape_string($conn, $_POST['yield']);
      $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
      $method = mysqli_real_escape_string($conn, $_POST['method']);
      //create sql
      $sql = "INSERT INTO recipes(email,title,yield,ingredients,method) VALUES ('$email', '$title', '$yield', '$ingredients', '$method')";
    }
   //save to db and check
   if(mysqli_query($conn, $sql)){
    //success
      header('location: recipes.php');
  } else {
    echo 'echo error: ' . mysqli_error($conn);
  }

} //end of POST check -->