
<?php

// use LDAP\Result;

session_start();
//connection
include('config/db_connect.php');
if(isset($_POST['create'])){
    $dutyname = textboxValue(value:"duty4-name");
    $id = textboxValue(value:"duty4-id");
    
    if($dutyname){
        
        $sql = "INSERT INTO bartender(id,duty) VALUES('$id', '$dutyname')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Record Succefully Inserted...!");
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }
}

if(isset($_POST['update'])){
    $dutyname = textboxValue(value:"duty4-name");
    $id = textboxValue(value:"duty4-id");
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

if(isset($_POST['delete'])){
    $dutyname = textboxValue(value:"duty4-name");
    $id = (int)textboxValue(value:"duty4-id");

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
    $dutyname = textboxValue(value:"duty4-name");
    $id = textboxValue(value:"duty4-id");
   
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
    
    $dutyname = textboxValue(value:"duty22-name");
    $id = textboxValue(value:"duty22-id");
   
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



if(isset($_POST['updatebar'])){
    $dutyname = textboxValue(value:"duty4-name");
    $id = textboxValue(value:"duty4-id");
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
    $dutyname = textboxValue(value:"duty22-name");
    $id = textboxValue(value:"duty22-id");
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
    $dutyname = textboxValue(value:"duty4-name");
    $id = (int)textboxValue(value:"duty4-id");

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
    $dutyname = textboxValue(value:"duty4-name");
    $id = (int)textboxValue(value:"duty4-id");

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
    $dutyname = textboxValue(value:"duty22-name");
    $id = (int)textboxValue(value:"duty22-id");

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
           .btnedit_supplies, .btneditbarday, .btneditbacknight, .btneditbarnight{
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
           .red-danger{
               margin-top: 4em;
               margin-bottom: -3em;
              
               background-color: transparent;
               padding: 1em;
               color: red;
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
	
        </style>
        <script>
   
</script>
    <?php include('template/admin-header.php');?>
        <main class="pt-3 mt-5 section">
     <!-- DAY SHIFT CHECKLIST MODAL -->
     <div class="modal fade pt-5 mt-2" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header p-2 modal-header1 bg-secondary text-white border-dark">
        <h5 class="modal-title" id="exampleModalLabel">Manage Duties</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-white" >
      <ul class="nav nav-tabs border-dark mb-3" id="myTab" role="tablist">
        <li class="nav-item"  role="presentation"  >
            <button class="nav-link text-muted fw-bold border-secondary" active
            id="home-tab"
            data-bs-toggle="tab"
            data-bs-target="#home"
            aria-controls="home"
            aria-selected="true"
            >Bartender Duties</button>
        </li>
        <li class="nav-item border-rounded" role="presentation">
            <button class="nav-link text-muted fw-bold border-secondary" active
            id="profile-tab"
            data-bs-toggle="tab"
            data-bs-target="#profile"
            aria-controls="profile"
            aria-selected="false"
            >Bar Back Duties</button>
        </li>
      </ul>
     <div class="tab-content" id="myTabContent">
        <div class="tab tab-pane fade" id="home"
        role="tabpanel"
        aria-labelledby="home-tab"
        >
        

<!-- CRUD ITEM -->
<main>

<div class="container text-center text-muted">
    
    <div class="justify-content-center">
    <form action="upload-contents.php" method="post" >
        <div class="py-2">
        <div class="input-group mb-3" style="display: none;" >
         <span class="input-group-text bg-danger"><i class="fa-solid fa-id-badge text-white"></i></span>
         <input type="text"  autocomplete="on" class="form-control bg-light text-muted" name="duty4-id" placeholder="ID" aria-label="id" aria-describedby="basic-addon11">
        </div>
        <div class="input-group mb-3">
         <span class="input-group-text bg-danger" ><i class="fa-solid fa-receipt text-white"></i></span>
        <input type="text" class="form-control light text-muted " name="duty4-name" placeholder="Enter Duty description" aria-label="item" aria-describedby="basic-addon1">
        </div>
     
        </div>
        
        <div class="d-flex btn-group-prep justify-content-center">
            <button class="btn-success rounded btn-prep me-1" name="create"><i class="fa-solid fa-plus"></i></button>
            <button class="btn-primary rounded btn-prep me-1" class="read" name="read"><i class="fa-solid fa-rotate"></i></button>
            <button class="btn-warning rounded btn-prep me-1" name="update"><i class="fa-solid fa-marker text-white"></i></button>
            <button class="btn-danger rounded btn-prep me-1" name="delete"><i class="fa-solid fa-trash-can"></i></button>
            <?php deleteBtn();?>
        </div>
</div>

<!-- bootstrap table -->
<div class="d-flex table-data py-2 ">
    <table class="table table-striped table-dark">
        <thead class="thead-dark text-muted">
            <tr>
                <th>Id</th>
                <th>Duty Description</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
            <?php
                if(isset($_POST['read'])){
                    $result = getData();
                   
                    if($result){
                             $i=0;
                        while($row = mysqli_fetch_assoc($result)){    
                           
                            $i++;

                         
                            ?>
                          
                         <tr>
                    
                         <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                           
                                           echo $row['id'];
                                        ?></td>
                                        <td ><?php 
                                          
                                           echo $i;
                                        ?></td>
                             <td data-id="<?php echo $row['id']; ?>"><?php echo $row['duty']?></td>
                             <td ><i class="fas fa-edit btneditbarday" data-id="<?php echo $row['id']; ?>"></i></td>
                         </tr>
                         <?php  
                          }
                      
                        }
                    }

            ?>
        </tbody>
    </table>
</div>

</div>
                </form>
            </main>   
        </div>
        <div class="tab tab-pane fade" id="profile"
        role="tabpanel"
        aria-labelledby="profile-tab"
        >

        <main>

<div class="container text-center text-muted">
    
    <div class="justify-content-center">
    <form action="upload-contents.php" method="post" >
        <div class="py-2">
        <div class="input-group mb-3" style="display: none;" >
         <span class="input-group-text bg-danger"><i class="fa-solid fa-id-badge text-white"></i></span>
         <input type="text"  autocomplete="on" class="form-control bg-light text-muted" name="duty22-id" placeholder="ID" aria-label="id" aria-describedby="basic-addon11">
        </div>
        <div class="input-group mb-3">
         <span class="input-group-text bg-danger" ><i class="fa-solid fa-receipt text-white"></i></span>
        <input type="text" class="form-control light text-muted " name="duty22-name" placeholder="Enter Duty description" aria-label="item" aria-describedby="basic-addon1">
        </div>
        </div>
        
        <div class="d-flex btn-group-prep justify-content-center">
            <button class="btn-success rounded btn-prep me-1" name="create_"><i class="fa-solid fa-plus"></i></button>
            <button class="btn-primary rounded btn-prep me-1" class="read" name="read_"><i class="fa-solid fa-rotate"></i></button>
            <button class="btn-warning rounded btn-prep me-1" name="update_"><i class="fa-solid fa-marker text-white"></i></button>
            <button class="btn-danger rounded btn-prep me-1" name="delete_"><i class="fa-solid fa-trash-can"></i></button>
            <?php deleteBtn_();?>
        </div>
</div> 
  <!-- BOOTSTRAP TABLE -->
 <div class="d-flex table-data py-2 ">
    <table class="table table-striped table-dark">
        <thead class="thead-dark text-muted">
            <tr>
                <th>Id</th>
                <th>Duty Description</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
            <?php
                if(isset($_POST['read_'])){
                    $result0 = getData_();
                   
                    if($result0){
                             $i=0;
                        while($row = mysqli_fetch_assoc($result0)){    
                            $i++;
                            ?>
                         <tr>
                         <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                           
                                           echo $row['id'];
                                        ?></td>
                                        <td ><?php 
                                          
                                           echo $i;
                                        ?></td>
                             <td data-id="<?php echo $row['id']; ?>"><?php echo $row['duty']?></td>
                             <td ><i class="fas fa-edit btnedit_" data-id="<?php echo $row['id']; ?>"></i></td>
                         </tr>
                         <?php  
                          }
                      
                        }
                    }

            ?>
        </tbody>
    </table>
</div>

</div> 

            </main>
        </div>
     </div>    

      </div>
                </form>
      <div class="modal-footer bg-dark border-dark">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 

 <!-- NIGHT SHIT DUTIES  MODAL -->
 <div class="modal fade pt-5 mt-2" id="exampleModal77" tabindex="-1" aria-labelledby="exampleModalLabel77" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header p-2 modal-header1 bg-secondary text-white border-dark">
        <h5 class="modal-title" id="exampleModalLabel07">Night Shift Duties</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-white" >
      <ul class="nav nav-tabs border-dark mb-3">
            <li class="nav-item text-muted fw-bold border-secondary" >
                <a class="nav-link text-muted border-secondary" data-bs-toggle="tab" href="#homenight">Bartender Duties</a>
             </li>
            <li class="nav-item text-muted fw-bold border-secondary" >
                <a class="nav-link text-muted border-secondary" data-bs-toggle="tab" href="#profilenight">Bar Back Duties</a>
             </li>
       
      </ul>
     <div class="tab-content" id="myTabContentbar">
        <div class="tab tab-pane fade" id="homenight"
        role="tabpanel"
        aria-labelledby="home-tab-night"
        >
        
<!-- CRUD ITEM -->
<main>

<div class="container text-center text-muted">
    
    <div class="justify-content-center">
    <form action="upload-contents.php" method="post" >
        <div class="py-2">
        <div class="input-group mb-3" style="display: none;" >
         <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-id-badge text-white"></i></span>
         <input type="text"  autocomplete="on" class="form-control bg-light text-muted" name="duty4-id" placeholder="ID" aria-label="id" aria-describedby="basic-addon11">
        </div>
        <div class="input-group mb-3">
         <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-receipt text-white"></i></span>
        <input type="text" class="form-control light text-muted " name="duty4-name" placeholder="Enter Duty description" aria-label="item" aria-describedby="basic-addon1">
        </div>
        </div>
        
        <div class="d-flex btn-group-prep justify-content-center">
            <button class="btn-success rounded btn-prep me-1" name="createbar"><i class="fa-solid fa-plus"></i></button>
            <button class="btn-primary rounded btn-prep me-1" class="read" name="read_bar"><i class="fa-solid fa-rotate"></i></button>
            <button class="btn-warning rounded btn-prep me-1" name="updatebar"><i class="fa-solid fa-marker text-white"></i></button>
            <button class="btn-danger rounded btn-prep me-1" name="deletebar"><i class="fa-solid fa-trash-can"></i></button>
            <?php deleteBtnbar();?>
        </div>
</div>

<!-- bootstrap table -->
<div class="d-flex table-data py-2 ">
    <table class="table table-striped table-dark">
        <thead class="thead-dark text-muted">
            <tr>
                <th>Id</th>
                <th>Duty Description</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
            <?php
                if(isset($_POST['read_bar'])){
                    
                    $result = getDatabar();
                   
                    if($result){
                             $i=0;
                        while($row = mysqli_fetch_assoc($result)){    
                           
                            $i++;

                         
                            ?>
                          
                         <tr>
                    
                         <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                           
                                           echo $row['id'];
                                        ?></td>
                                        <td ><?php 
                                          
                                           echo $i;
                                        ?></td>
                             <td data-id="<?php echo $row['id']; ?>"><?php echo $row['duty']?></td>
                             <td ><i class="fas fa-edit btnedit btneditbarday" data-id="<?php echo $row['id']; ?>"></i></td>
                         </tr>
                         <?php  
                          }
                      
                        }
                    }

            ?>
        </tbody>
    </table>
</div>

</div>

            </main> 
        </div>
        <div class="tab tab-pane fade" id="profilenight"
        role="tabpanel"
        aria-labelledby="profile-tab-night"
        >

        <main>

<div class="container text-center text-muted">
    
    <div class="justify-content-center">
    <form action="upload-contents.php" method="post" >
        <div class="py-2">
        <div class="input-group mb-3" style="display: none;" >
         <span class="input-group-text bg-danger"><i class="fa-solid fa-id-badge text-white"></i></span>
         <input type="text"  autocomplete="on" class="form-control bg-light text-muted" name="duty2-id" placeholder="ID" aria-label="id" aria-describedby="basic-addon11">
        </div>
        <div class="input-group mb-3">
         <span class="input-group-text bg-danger" ><i class="fa-solid fa-receipt text-white"></i></span>
        <input type="text" class="form-control light text-muted " name="duty2-name" placeholder="Enter Duty description" aria-label="item" aria-describedby="basic-addon1">
        </div>
        </div>
        
        <div class="d-flex btn-group-prep justify-content-center">
            <button class="btn-success rounded btn-prep me-1" name="create_back"><i class="fa-solid fa-plus"></i></button>
            <button class="btn-primary rounded btn-prep me-1" class="read" name="read_back"><i class="fa-solid fa-rotate"></i></button>
            <button class="btn-warning rounded btn-prep me-1" name="update_back"><i class="fa-solid fa-marker text-white"></i></button>
            <button class="btn-danger rounded btn-prep me-1" name="delete_back"><i class="fa-solid fa-trash-can"></i></button>
            <?php deleteBtnback();?>
        </div>
</div> 
  <!-- BOOTSTRAP TABLE -->
 <div class="d-flex table-data py-2 ">
    <table class="table table-striped table-dark">
        <thead class="thead-dark text-muted">
            <tr>
                <th>Id</th>
                <th>Duty Description</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
            <?php
                if(isset($_POST['read_back'])){
                    $sql5 = "SELECT * FROM barback_night";
                    $result5 = mysqli_query($GLOBALS['conn'], $sql5);
                    if($result5){
                             $i=0;
                        while($row = mysqli_fetch_assoc($result5)){    
                            $i++;
                            ?>
                         <tr>
                         <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                           
                                           echo $row['id'];
                                        ?></td>
                                        <td ><?php 
                                          
                                           echo $i;
                                        ?></td>
                             <td data-id="<?php echo $row['id']; ?>"><?php echo $row['duty']?></td>
                             <td ><i class="fas fa-edit btneditbarnight" data-id="<?php echo $row['id']; ?>"></i></td>
                         </tr>
                         <?php  
                          }
                      
                        }
                    }

            ?>
        </tbody>
    </table>
</div>

</div> 

            </main>
        </div>
     </div>    
      </div>
      <div class="modal-footer bg-dark border-dark">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
        <!-- ADD RECIPES  MODAL-->
        <div class="modal fade pt-5 mt-2" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header modal-header1 bg-secondary text-white border-dark p-2 ">
        <h5 class="modal-title" id="exampleModalLabel">Add recipes</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-white" >
      <ul class="nav nav-tabs border-dark text-muted">
            <li class="nav-item text-muted fw-bold border-secondary">
                <a class="nav-link active text-muted border-light" data-bs-toggle="tab" href="#prep">
                   Prep Recipes</a>
            </li>
            <li class="nav-item text-muted fw-bold border-secondary ">
                <a class="nav-link text-muted border-light" data-bs-toggle="tab" href="#cocktails">
                    Cocktails</a>
            </li> 
        </ul>
        <div class="tab-content">
            <div class="tab-pane " id="prep">
                <div class="row g-0 rounded shadow-sm">
                    <div class="pt-4">
                    <form action="upload-contents.php" method="POST">
                   
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-marker"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="title" placeholder="Enter Recipe Name" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($title) ?>">
                </div>
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors['title']; ?></div>
                   
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-blender"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="yield" placeholder="Enter Quantity" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($yield) ?>">
                </div> 
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors['yield']; ?></div>
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-flask-vial"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="ingredients" placeholder="Enter Ingredients (comma separeted)" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($ingredients) ?>">
                </div>
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors['ingredients']; ?></div>
                    
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-mortar-pestle"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="method" placeholder="Enter Method" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($method) ?>">
                </div>
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors['method']; ?></div>
                <button type="submit" name="addpreprecipes" class="btn-light rounded text-muted p-2 py-1 fw-bold">Save Recipe</button>
            </form>
                    </div>
                 
                </div>
            </div>
            <div class="tab-pane" id="cocktails">
            <div class="row g-0 rounded shadow-sm">
                    <div class="pt-4">
                    <form action="upload-contents.php" method="POST">
                   
                   <div class="input-group">
                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-marker"></i></span>
                   <input type="text" class="form-control bg-light text-muted " name="title2" placeholder="Enter Cocktail Name" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($title) ?>">
               </div>
               <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors2['title2']; ?></div>
                  
                   <div class="input-group">
                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-flask-vial"></i></span>
                   <input type="text" class="form-control bg-light text-muted " name="ingredients2" placeholder="Enter Ingredients (comma separeted)" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($ingredients2) ?>">
               </div>
               <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors2['ingredients2']; ?></div>
                   
                   <div class="input-group">
                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-mortar-pestle"></i></span>
                   <input type="text" class="form-control bg-light text-muted " name="method2" placeholder="Enter Method" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($method2) ?>">
               </div>
               <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors2['method2']; ?></div>
               <button type="submit" name="addpreprecipes2" class="btn-light rounded text-muted p-2 py-1 fw-bold">Save Cocktail</button>
           </form>
                    </div>
                </div>
            </div>
        
        </div>
     
</div>


      <div class="modal-footer bg-dark border-dark">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 
      </div>
    </div>
  </div>
</div>
        <!-- ADD USERS  MODAL-->
        <div class="modal fade pt-5 mt-2" id="exampleModal222" tabindex="-1" aria-labelledby="exampleModal222" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header modal-header1 bg-secondary text-white border-dark p-2 ">
        <h5 class="modal-title" id="exampleModalLabel">Add Users</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-white" >
     
       
                    <div class="pt-4">
                    <form action="upload-contents.php" method="POST">
                   
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="email" placeholder="Enter Email" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($email) ?>">
                </div>
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors3['email']; ?></div>
                   
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-user-pen"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="name" placeholder="Enter Name" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($name) ?>">
                </div> 
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors3['name']; ?></div>
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-chalkboard-user"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="username" placeholder="Enter Username" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($username) ?>">
                </div> 
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors3['username']; ?></div>
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-mobile-screen-button"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="mobile" placeholder="Enter Mobile Number" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($mobile) ?>">
                </div>
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors3['mobile']; ?></div>
                    <div class="input-group">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="password" placeholder="Enter Password" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($password) ?>">
                </div>
                <div class="red-danger error my-1 mt-0 pt-0"><?php echo $errors3['password']; ?></div>
                <div class="input-group">
                <select class="form-control bg-dark text-white" style="width: 75%;" name="roleid" id="roleid">
              <div >
                  <option value="1">Admin</option>
                      <option value="2">User only</option>
              </div>
                    </select>
                </div>
            
        </div>
     
</div>


      <div class="modal-footer bg-dark border-dark">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add-user" class="btn btn-primary">Submit</button>
 
      </div>
    </form>
    </div>
  </div>
</div>
        <!-- ADD SUPPLIES  MODAL-->
        <div class="modal fade pt-5 mt-2" id="exampleModal2223" tabindex="-1" aria-labelledby="exampleModal222" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header modal-header1 bg-secondary text-white border-dark p-2 ">
        <h5 class="modal-title" id="exampleModal2223">Add Suppliers</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-white" >
     
       
                    <div >
                    <form action="upload-contents.php" method="POST">
                    <div class="input-group py-2" style="display: none;" >
         <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-id-badge text-white"></i></span>
         <input type="text" class="form-control bg-light text-muted" name="duty3-id" placeholder="ID" aria-label="id" aria-describedby="basic-addon1" >
        </div>
                    <div class="input-group py-2">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-shop"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="name" placeholder="Enter Compamy Name" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($name) ?>">
                </div> 
                    <div class="input-group py-2">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-cart-arrow-down"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="item" placeholder="Enter Item" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($username) ?>">
                </div> 
                <div class="input-group py-2">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-mobile-screen-button"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="mobile" placeholder="Enter Mobile Number" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($mobile) ?>">
                </div>
                    <div class="input-group py-2">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="email" placeholder="Enter Email" aria-label="item" aria-describedby="basic-addon1" value = "<?php echo htmlspecialchars($email) ?>">
                </div>                   
                <div class="d-flex btn-group-prep justify-content-center">
            <button class="btn-success rounded btn-prep me-1" name="create_supply"><i class="fa-solid fa-plus"></i></button>
            <button class="btn-primary rounded btn-prep me-1" class="read" name="read_supply"><i class="fa-solid fa-rotate"></i></button>
            <button class="btn-warning rounded btn-prep me-1" name="update_supply"><i class="fa-solid fa-marker text-white"></i></button>
            <button class="btn-danger rounded btn-prep me-1" name="delete_supply"><i class="fa-solid fa-trash-can"></i></button>
            <?php deleteBtn_supply();?>
        </div>
             <!-- BOOTSTRAP TABLE -->
 <div class="d-flex table-data py-2 ">
    <table class="table table-striped table-dark">
        <thead class="thead-dark text-muted">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Item</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
            <?php
                if(isset($_POST['read_supply'])){
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
                             <td ><i class="fas fa-edit btnedit_supplies" data-id="<?php echo $row['id']; ?>"></i></td>
                             
                         </tr>
                         <?php  
                          }
                      
                        }
                    }

            ?>
        </tbody>
    </table>
</div>
                    
                
                
        </div>
     
</div>


      <div class="modal-footer bg-dark border-dark">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add-supplies" class="btn btn-primary">Submit</button>
 
      </div>
    </form>
    </div>
  </div>
</div>

        <!-- UPLOAD CONTENT TRIGGER BUTTONS -->

            <div class="container text-center text-muted">
            <div class="jumbotron bg-dark ">
                <div class="card bg-dark">
                     <h2 class="py-2 text-light bg-dark text-muted rounded " ><i class="fa-solid fa-file-import"></i> Upload Contents</h2>
                </div>
                <div class="card bg-dark">
                    <div class="card-body ">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary fw-bold " data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: flex;
                    margin: auto;"><i class="material-icons me-1" 
                    >add_task </i>Day Shift Duties</button>
                    </div>
                    <div class="card-body ">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger fw-bold " data-bs-toggle="modal" data-bs-target="#exampleModal77" style="display: flex;
                    margin: auto;"><i class="material-icons me-1" 
                    >checklist </i>Night Shift Duties</button>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-warning ms-1 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="fa-solid fa-file-circle-plus"></i> Prep and Cocktails Recipes</button>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-info ms-1 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal222"> 
 
                        <i class="fa-solid fa-user-plus"></i> Add Users</button>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-success ms-1 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal2223"> 
 
                    <i class="fa-solid fa-truck-medical"></i> Add Supplies</button>
                    </div>
                    
                </div>
                </div>
           
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
    