
<?php

// use LDAP\Result;

session_start();
//connection
include('config/db_connect.php');
if(isset($_POST['create'])){
    $dutyname = textboxValue(value:"duty-name");
    $id = textboxValue(value:"duty-id");
   
    if($dutyname){
        
        $sql = "INSERT INTO bartender(id,duty) VALUES('$id', '$dutyname')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Record Succefully Inserted...!");
        }else{
            echo "Error";
        }
        
    }else{
        // TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }

   
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();
}
if(isset($_POST['create_'])){
    
    createdata_();
   
}

if(isset($_POST['update_'])){
    UpdateData_();
}

if(isset($_POST['delete_'])){
    deleteRecord_();
}

if(isset($_POST['deleteall_'])){
    deleteAll_();
}

function inputElement($icon, $placeholder, $name, $value){
    $ele = "
        
        <div class=\"input-group mb-2\">
                        <div class=\"input-group-prepend\">
                            <div class=\"input-group-text bg-warning\">$icon</div>
                        </div>
                        <input type=\"text\" name='$name' value='$value' autocomplete=\"off\" placeholder='$placeholder' class=\"form-control\" id=\"inlineFormInputGroup\" placeholder=\"Username\">
                    </div>
    
    ";
    echo $ele;
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conn'],trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

function buttonElement($btnid, $styleclass, $text, $name, $attr){
    $btn = "
        <button name='$name' '$attr' class='$styleclass' id='$btnid'>$text</button>
    ";
    echo $btn;
}
    //    NIGHT SHIFT DUTIES OPERATIONS 
if(isset($_POST['createbar'])){
    $dutyname = textboxValue(value:"duty-name");
    $id = textboxValue(value:"duty-id");
   
    if($dutyname){
        
        $sql = "INSERT INTO bartender_night(id,duty) VALUES('$id', '$dutyname')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Record Succefully Inserted...!");
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }

   
}
if(isset($_POST['create_back'])){
    $dutyname = textboxValue(value:"duty2-name");
    $id = textboxValue(value:"duty2-id");
   
    if($dutyname){
        
        $sql = "INSERT INTO barback_night(id,duty) VALUES('$id', '$dutyname')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Record Succefully Inserted...!");
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }

   
}
if(isset($_POST['create_supply'])){
    $name = textboxValue(value:"name");
    $item = textboxValue(value:"item");
    $mobile = textboxValue(value:"mobile");
    $email = textboxValue(value:"email");
   
    if($name && $item && $mobile && $email){
        
        $sql = "INSERT INTO supplies(name,item,mobile,email) VALUES('$name', '$item','$mobile','$email')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Record Succefully Inserted...!");
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }

   
}

function createData_(){
    
    $dutyname = textboxValue(value:"duty2-name");
    $id = textboxValue(value:"duty2-id");
   
    if($dutyname){
        
        $sql = "INSERT INTO barback(id,duty) VALUES('$id', '$dutyname')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Record Succefully Inserted...!");
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }

}



//messages
function TextNode($classname,$msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

//Get data from mysql data base
function getData(){
    $sql = "SELECT * FROM bartender";

    $result = mysqli_query($GLOBALS['conn'], $sql);


    if(mysqli_num_rows($result) > 0){
        return $result;
    }

}
function getData_(){
    $sql = "SELECT * FROM barback";

    $result19 = mysqli_query($GLOBALS['conn'], $sql);


    if(mysqli_num_rows($result19) > 0){
        return $result19;
       
    }

}
function getData_supplies(){
    $sql = "SELECT * FROM supplies";

    $result199 = mysqli_query($GLOBALS['conn'], $sql);


    if(mysqli_num_rows($result199) > 0){
        return $result199;
       
    }

}


// update data
function UpdateData(){
    $dutyname = textboxValue(value:"duty-name");
    $id = textboxValue(value:"duty-id");
    if($dutyname){
    $sql = "UPDATE bartender SET duty ='$dutyname'  WHERE id = '$id';";
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }


}
if(isset($_POST['updatebar'])){
    $dutyname = textboxValue(value:"duty-name");
    $id = textboxValue(value:"duty-id");
    if($dutyname){
    $sql = "UPDATE bartender_night SET duty ='$dutyname'  WHERE id = '$id';";
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }
}
if(isset($_POST['update_back'])){
    $dutyname = textboxValue(value:"duty2-name");
    $id = textboxValue(value:"duty2-id");
    if($dutyname){
    $sql = "UPDATE barback_night SET duty ='$dutyname'  WHERE id = '$id';";
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }
}

function UpdateData_(){
    $dutyname = textboxValue(value:"duty2-name");
    $id = textboxValue(value:"duty2-id");
    if($dutyname){
    $sql = "UPDATE barback SET duty ='$dutyname'  WHERE id = '$id';";
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }
}

if(isset($_POST['update_supply'])){
    $id = textboxValue(value:"duty3-id");
    $name = textboxValue(value:"name"); 
    $item = textboxValue(value:"item");
    $mobile = textboxValue(value:"mobile");
    $email = textboxValue(value:"email");
   
    if($name && $item && $mobile && $email){
    $sql = "UPDATE supplies SET name ='$name', item ='$item', mobile='$mobile', email='$email'  WHERE id='$id';";
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");

    }


}

if(isset($_POST['deletebar'])){
    $dutyname = textboxValue(value:"duty-name");
    $id = (int)textboxValue(value:"duty-id");

    if($dutyname){
        
        $sql = "DELETE FROM bartender_night WHERE id=$id";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }
    else{
        TextNode("error", "Select Data Using Edit Icon");
    }
 
    }
}
if(isset($_POST['delete_back'])){
    $dutyname = textboxValue(value:"duty2-name");
    $id = (int)textboxValue(value:"duty2-id");

    if($dutyname){
        
        $sql = "DELETE FROM barback_night WHERE id=$id";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }
    else{
        TextNode("error", "Select Data Using Edit Icon");
    }
 
    } 
}
if(isset($_POST['delete_supply'])){
    $name = textboxValue(value:"name");
    $item = textboxValue(value:"item");
    $mobile = textboxValue(value:"mobile");
    $email = textboxValue(value:"email");
    $id = textboxValue(value:"duty3-id");
    
   
    if($name && $item && $mobile && $email){
        
        $sql = "DELETE FROM supplies WHERE id=$id";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }
    else{
        TextNode("error", "Select Data Using Edit Icon");
    }
 
    } 
}
function deleteRecord(){
    $dutyname = textboxValue(value:"duty-name");
    $id = (int)textboxValue(value:"duty-id");

    if($dutyname){
        
        $sql = "DELETE FROM bartender WHERE id=$id";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }
    else{
        TextNode("error", "Select Data Using Edit Icon");
    }
 
    }
}
function deleteRecord_(){
    $dutyname = textboxValue(value:"duty2-name");
    $id = (int)textboxValue(value:"duty2-id");

    if($dutyname){
        
        $sql = "DELETE FROM barback WHERE id=$id";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }
    else{
        TextNode("error", "Select Data Using Edit Icon");
    }
 
    }
}
$sql10 = "SELECT * FROM bartender";
        
    //get the query result
    $result10 = mysqli_query($conn, $sql10);

    //fetch result in array format
    $bartender = mysqli_fetch_assoc($result10);


$sql100 = "SELECT * FROM bartender_night";
        
    //get the query result
    $result100 = mysqli_query($conn, $sql100);

    //fetch result in array format
    $bartendernight = mysqli_fetch_assoc($result100);


$sql1000 = "SELECT * FROM barback_night";
        
    //get the query result
    $result1000 = mysqli_query($conn, $sql1000);

    //fetch result in array format
    $bartendernight = mysqli_fetch_assoc($result1000);



function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn del_all btn-prep" ,"<i class='fa-solid fa-eraser'></i>", "deleteall", "All");


                return;
            }
        }
    }
}

function deleteBtn_(){
    $result = getData_();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn del_all btn-prep" ,"<i class='fa-solid fa-eraser'></i>", "deleteall_", "All");


                return;
            }
        }
    }
}
function deleteBtn_supply(){
    $result = getData_supplies();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn del_all btn-prep" ,"<i class='fa-solid fa-eraser'></i>", "deleteAll_supply", "All");


                return;
            }
        }
    }
}



function deleteBtnbar(){
    $sql = "SELECT * FROM bartender_night";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn del_all btn-prep" ,"<i class='fa-solid fa-eraser'></i>", "deleteall_bar", "All");


                return;
            }
        }
    }
}
function deleteBtnback(){
    $sql = "SELECT * FROM barback_night";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn del_all btn-prep" ,"<i class='fa-solid fa-eraser'></i>", "deleteall_back", "All");


                return;
            }
        }
    }
}


function deleteAll(){
    $sql = "DELETE FROM bartender";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}
if(isset($_POST['deleteAll_bar'])){
    $sql = "DELETE FROM bartender_night";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}
function deleteAll_back(){
    $sql = "DELETE FROM barback_night";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}
function deleteAll_(){
    $sql = "DELETE FROM barback";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}
if(isset($_POST['deleteAll_supply'])){
    $sql = "DELETE FROM supplies";
    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}



// set id to textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}
function setID_(){
    $getid = getData_();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}

    function getDatabar(){
       
        $sql = "SELECT * FROM bartender_night";
        $result = mysqli_query($GLOBALS['conn'], $sql);
    
    
        if(mysqli_num_rows($result) > 0){
            return $result;
           
        }
    
    }
    function getDataback_(){
       
        $sql = "SELECT * FROM barback_night";
        $result = mysqli_query($GLOBALS['conn'], $sql);
    
    
        if(mysqli_num_rows($result) > 0){
            return $result;
           
        }
    
    }
  
    // UPLOAD RECIPES


    // PREP RECIPES

    $title = $yield = $ingredients = $method = '';  
    $errors = array('title' => '', 'yield' => '', 'ingredients' => '', 'method' => '');
  
      if(isset($_POST['addpreprecipes'])){
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
          $errors['yield'] = 'Type yield the correct syntax!';
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
              
              $title = mysqli_real_escape_string($conn, $_POST['title']);
              $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
              $yield = mysqli_real_escape_string($conn, $_POST['yield']);
              $method = mysqli_real_escape_string($conn, $_POST['method']);
  
              // create sql
              $sql = "INSERT INTO recipes(title,yield,ingredients,method) VALUES('$title','$yield','$ingredients','$method')";
  
              // save to db and check
              if(mysqli_query($conn, $sql)){
                  // success
                  header('Location: prep-recipes.php');
              } else {
                  echo 'query error: '. mysqli_error($conn);
              }
              
          }
  
      } 

    // COCKTAILS RECIPES

    $title2 = $ingredients2 = $method2 = '';  
    $errors2 = array('title2' => '', 'ingredients2' => '', 'method2' => '');
  
      if(isset($_POST['addpreprecipes2'])){
          // check title
          if(empty($_POST['title2'])){
              $errors2['title2'] = 'A title is required';
          } else{
              $title = $_POST['title2'];
              if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                  $errors2['title2'] = 'Title must be letters and spaces only';
              }
          }
          // check ingredients
      if(empty($_POST['ingredients2'])){
        $errors2['ingredients2'] = 'At least one ingredient is required';
      } else{
        $ingredients = $_POST['ingredients2'];
              if(!preg_match('/^([\d]+[\.]?[\d]?[a-zA-Z\s]+)(,\s*[\d]+[\.]?[\d]?[a-zA-Z\s]*)*$/', $ingredients)){
                  $errors2['ingredients2'] = 'Type the correct syntax for ingredients!';
        }
      }
      //check method
      if(empty($_POST['method2'])){
        $errors2['method2'] = 'method is required';
       } else{
         $method = $_POST['method2'];
         if(!preg_match('/^[a-zA-Z0-9,\s]*$/', $method)){
           $errors2['method2'] = 'method must be letters and space only';
         }
        }
          if(array_filter($errors2)){
              //echo 'errors in form';
          } else {
              // escape sql chars
              
              $title = mysqli_real_escape_string($conn, $_POST['title2']);
              $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients2']);
              $method = mysqli_real_escape_string($conn, $_POST['method2']);
  
              // create sql
        $sql = "INSERT INTO recipes2(cocktail,ingredients,metho) VALUES('$title','$ingredients','$method')";
            //   $sql = "INSERT INTO recipes(title,yield,ingredients,method) VALUES('$title','$yield','$ingredients','$method')";
              // save to db and check
              if(mysqli_query($conn, $sql)){
                  // success
                  header('Location: cocktails-recipes.php');
              } else {
                  echo 'query error: '. mysqli_error($conn);
              }
              
          }
  
      } 


        // ADD USERS OPERATIONS

        $email = $name = $username = $mobile = $password = $roleid = '';  
        $errors3 = array('email' => '', 'name' => '', 'username' => '', 'mobile' => '', 'password' => '', 'roleid' => '');
      
          if(isset($_POST['add-user'])){
              
              // check email
              if(empty($_POST['email'])){
                  $errors3['email'] = 'An email is required';
              } else{
                  $email = $_POST['email'];
                  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                      $errors3['email'] = 'Your Email must be a valid email address';
                  }
              }
      
              // check user name
              if(empty($_POST['name'])){
                  $errors3['name'] = 'An User Name is required';
              } else{
                  $name = $_POST['name'];
                  if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
                      $errors3['name'] = 'User name must be letters and spaces only';
                  }
              }
              // check user name
              if(empty($_POST['username'])){
                  $errors3['username'] = 'An User Name is required';
              } else{
                  $username = $_POST['username'];
                  if(!preg_match('/^[a-zA-Z\d]{4,12}+$/', $username)){
                      $errors3['username'] = 'Type a correct username syntax please';
                  }
              }
          //check Mobile
          if(empty($_POST['mobile'])){
            $errors3['mobile'] = 'At least one mobile is required';
          } else{
            $mobile = $_POST['mobile'];
            if(!preg_match('/^([0][\d]{9})*$/', $mobile)){
              $errors3['mobile'] = 'Type a correct mobile number!';
            }
          }
              // check password
          if(empty($_POST['password'])){
            $errors3['password'] = 'Password is required';
          } else{
            $password = $_POST['password'];
                  if(!preg_match('/^[\w@-]{8,20}$/', $password)){
                      $errors3['password'] = 'Type the correct syntax for password!';
            }
          }
              if(array_filter($errors3)){
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

            }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Opening Procedure</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
       
        <link rel="stylesheet" href="font-awesome/all.min.css">
        <link rel="stylesheet" href="font-awesome/fontawesome.min.css">
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
           
               
            }
           .my-bg{
            background: #0D0A13;

                }
          
           .section{
            width: 100vw;
            height: 100vmax;
            font-family: 'Open Sans Condensed', sans-serif;
           }
       .opening-title{
           display: flex;
           flex-direction: row;
           margin-top: auto;
           font-size: 5rem;
           
       }
       .modal-header1{
        background: rgba(255, 255, 255, .3);
       }
       .card-body{
           background-color: #2C3034;
       }
       .float-open-form{
           margin: auto;
           justify-content: center;
           align-items: center;
           width: 40%;
       }
       .input-group-text{
         justify-content: flex-end;
         width: 3rem;
       }
       .hotslist{
         display: flex;
         flex-direction: row;
       }
       .item{
         font-size: 1.2em;
       }
       .item-input{
          height: 1.7em;
         
          
       }

       .my-bg{
            background: #0D0A13;

                }
              
                .btn-prep{
                    width: 25%;
                    height: 50px;
                }
                .btn-prep2{
                    width: 12%;
                    height: 50px;
                }

                .btn-group-prep{
                    width: 100%;
                    margin: auto;
                }
           .section{
            width: 100vw;
            height: 100vmax;
            font-family: 'Open Sans Condensed', sans-serif;
           }
           .table2{
              
              font-family: 'Open Sans Condensed', sans-serif;
           } 
           table .btnedit, .btnedit_{
               color: lightsalmon;
               cursor: pointer;
           }
           .btnedit_supplies{
               color: lightsalmon;
               cursor: pointer;
           }
           .success{
            margin-top: 4em;
               margin-bottom: -3em;
              
               background-color: lightgreen;
               padding: 1em;
               color: black;
               font-family: 'Open Sans Condensed', sans-serif;   
           }
           .error{
               margin-top: 4em;
               margin-bottom: -3em;
              
               background-color: tomato;
               padding: 1em;
               color: white;
               font-family: 'Open Sans Condensed', sans-serif;   
           }
           .par-input{
               width: 49%;
               
           }
           .par{
               justify-content: space-between;

           }
           .del_all{
            background-color: blanchedalmond;
            color: #DC3545;
           }
    
  /* display: block;
            align-items: flex-end; */
        </style>
    <?php include('template/admin-header.php');?>
        <main class="pt-3 mt-5 section container">
        <h2 class="py-2 text-light text-center bg-dark text-muted rounded " id="daily-orders"><i class="fa-solid fa-truck-field"></i> Supplies Contacts</h2>
     
        
             <!-- BOOTSTRAP TABLE -->
 <div class="d-flex table-data py-2 ">
    
    <table class="table table-striped table-dark ">
        <thead class="thead-dark text-muted">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Item</th>
                <th>Mobile</th>
                <th>Email</th>
                
            </tr>
        </thead>
        <tbody id="tbody">
            
            <?php
                
                    $sql5 = "SELECT * FROM supplies";
                    $result5 = mysqli_query($GLOBALS['conn'], $sql5);
                    if($result5){
                             $i=0;
                        while($row = mysqli_fetch_assoc($result5)){    
                            $i++;
                            ?>
                         <tr></td>
                                        <td ><?php 
                                          
                                           echo $i;
                                        ?></td>
                         <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                           
                                           echo $row['id'];
                                        ?>
                             <td data-id="<?php echo $row['id']; ?>"><?php echo $row['name']?></td>
                             <td data-id="<?php echo $row['id']; ?>"><?php echo $row['item']?></td>
                             <td data-id="<?php echo $row['id']; ?>"><?php echo $row['mobile']?></td>
                             <td data-id="<?php echo $row['id']; ?>"><?php echo $row['email']?></td>
                             
                         </tr>
                         <?php  
                          }
                      
                        }
                    

            ?>
        </tbody>
    </table>
</div>
        </main>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="supplies.js"></script>
            <!-- <script src="bartduties.js"></script> -->
          
            

    </body>
</html>
    