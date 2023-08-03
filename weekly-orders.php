<?php

use LDAP\Result;

session_start();
$par = $_SESSION['par']; 
echo $par;
//connection
include('config/db_connect.php');
if(isset($_POST['create'])){
    setcookie($_POST['par'], time()+ 86400);
    createdata();
   
}

if(isset($_POST['update'])){
    setcookie($_POST['par'], time()+ 86400);
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();
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

function buttonElement($btnid, $styleclass, $text, $name, $attr){
    $btn = "
        <button name='$name' '$attr' class='$styleclass' id='$btnid'>$text</button>
    ";
    echo $btn;
}



function createData(){
    
    $recipename = textboxValue(value:"recipe-name");
    $stockonhand = textboxValue(value:"stock-on-hand");
    $id = textboxValue(value:"recipe-id");
    $slow = textboxValue(value:"slow-par");
    $busy = textboxValue(value:"busy-par");

  

    if($recipename && $stockonhand && $slow && $busy){
        
        $sql = "INSERT INTO prep2(slow,busy,id,recipe_name,stock_on_hand) VALUES('$slow',$busy,'$id','$recipename','$stockonhand')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Record Succefully Inserted...!");
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }

}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conn'],trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

//messages
function TextNode($classname,$msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

//Get data from mysql data base
function getData(){
    $sql = "SELECT * FROM prep2";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}




// update data
function UpdateData(){
    $recipeid = textboxValue("recipe-id");
    $recipename = textboxValue("recipe-name");
    $stockonhand = textboxValue("stock-on-hand");
    $slow = textboxValue(value:"slow-par");
    $busy = textboxValue(value:"busy-par");
 

    if($recipename && $stockonhand && $slow && $busy){
        $sql = "
                    UPDATE prep2 SET recipe_name='$recipename', stock_on_hand = '$stockonhand', busy='$busy', slow='$slow'  WHERE id='$recipeid';                    
        ";

        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }


}


function deleteRecord(){
    $recipeid = (int)textboxValue("recipe-id");
    $recipename = textboxValue("recipe-name");
    $stockonhand = textboxValue("stock-on-hand");
    $slow = textboxValue(value:"slow-par");
    $busy = textboxValue(value:"busy-par");


    if($recipename && $stockonhand && $slow && $busy){
    $sql = "DELETE FROM prep2 WHERE id=$recipeid";
   

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }
    else{
        TextNode("error", "Select Data Using Edit Icon");
    }
 
    }
    else{
        TextNode("error", "Select Data Using Edit Icon");
    }
}

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


function deleteAll(){
    $sql = "DELETE FROM prep2";

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
//  PREP UPDATE 
if(isset($_POST['daily-orders'])){
    $date = date('Y/m/d H:i:s'); 
          
    $sql = "UPDATE weekly_time SET updated_at='$date';";
       if(mysqli_query($GLOBALS['conn'],$sql)){
           TextNode(classname: "success", msg: "Data Succefully Submited...!");
   }else{
       echo "Error";
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
        <title>Prep</title>
       
        <link href="css/styles.css" rel="stylesheet" />
       
        <link rel="stylesheet" href="font-awesome/all.min.css">
        <link rel="stylesheet" href="font-awesome/fontawesome.min.css">
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');
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
           table .btnedit{
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
    <?php include('template/admin-header.php');?>
        <main class="pt-3 mt-5 section">
            <div class="container text-center text-muted">
            <p id="daily-prep" style="display: none;"></p>
                <h2 class="py-2 text-light bg-dark text-muted rounded " id="daily-orders"><i class="fa-solid fa-file-invoice"></i> Weekly Orders</h2>
                
                <div class="d-flex justify-content-center">
                <form action="weekly-orders.php" method="post" class="w-50">
                    <div class="py-2">
                    
                    <div class="input-group mb-3">
  <label class="input-group-text bg-danger" for="inputGroupSelect01"><i class="fa-solid fa-square-parking text-white"></i></label>
  <select class="form-select bg-dark text-white" id="inputGroupSelect01" name="par">
    <option value="slow">Slow</option>
    <option value="busy">Busy</option>
  </select>
</div>
<div class="d-flex par mb-3">
                    <div class="input-group par-input">
                     <span class="input-group-text text-white bg-danger" id="basic-addon1"><i class="fa-solid fa-cart-arrow-down"></i></span>
                     <input type="text" class="form-control bg-white text-muted bold" step="0.01" min="0" name="slow-par" placeholder="Slow" aria-label="Request" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group par-input">
                     <span class="input-group-text text-white bg-danger" id="basic-addon1">
 <i class="fa-solid fa-cart-plus"></i></span>

                    <input type="text" class="form-control bg-white text-muted bold " step="0.01" min="0"  name="busy-par" placeholder="Busy" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
        </div>
                    <div class="input-group mb-3" style="display: none;">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-id-badge text-white"></i></span>
                    <input type="text" autocomplete="on" class="form-control bg-light text-white" name="recipe-id" placeholder="ID" aria-label="id" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-receipt text-white"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="recipe-name" placeholder="Item" aria-label="Recipe" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-file text-white"></i></span>
                    <input type="number" class="form-control bg-light text-muted " step="0.01" min="0"  name="stock-on-hand" placeholder="Count" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
                    </div>
                    <div class="d-flex btn-group-prep justify-content-center">
                        <button class="btn-success rounded btn-prep me-1" name="create"><i class="fa-solid fa-plus"></i></button>
                        <button class="btn-primary rounded btn-prep me-1" name="read"><i class="fa-solid fa-rotate"></i></button>
                        <button class="btn-warning rounded btn-prep me-1" name="update"><i class="fa-solid fa-marker text-white"></i></button>
                        <button class="btn-danger rounded btn-prep me-1" name="delete"><i class="fa-solid fa-trash-can"></i></button>
                        <?php deleteBtn();?>
                    </div>
                </form>
            </div>

            <!-- bootstrap table -->
            <div class="d-flex table-data py-2 ">
                <table class="table table-striped table-dark">
                    <thead class="thead-dark text-muted">
                        <tr>
                            <th>Id</th>
                            <th>Item</th>
                            <th>Count</th>
                            <th>Order</th>
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
                                 
                                <t>
                      
                                         <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                           
                                            echo $row['id'];
                                         ?></td>
                                         <td ><?php 
                                           
                                            echo $i;
                                         ?></td>
                                         <td data-id="<?php echo $row['id']; ?>" style="display: none;"><?php echo $row['slow']?></td>
                                         <td data-id="<?php echo $row['id']; ?>" style="display: none;"><?php echo $row['busy']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['recipe_name']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['stock_on_hand']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php 
                                            
                                            if ($_POST['par'] == 'slow'){
                                                $manuf =  $row['slow'] - $row['stock_on_hand'] ;
                                            } 
                                            
                                            if ($_POST['par'] == 'busy'){
                                                $manuf =  $row['busy'] - $row['stock_on_hand'] ;
                                                  
                                            }
                                            echo $manuf;
                                        //  ?></td>
                                         <td ><a href="#daily-orders"><i class="fas fa-edit btnedit" data-id="<?php echo $row['id']; ?>"></i></a></td>
                                     </tr>
                                     <?php 
                                    }
                                }
                               
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <form action="weekly-orders.php" method="POST">
                            <button type="submit" class="btn-info rounded fw-bold ps-2 pe-2" name="daily-orders"> Submit</button>
            </form>
            </div>
                        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="main2.js"></script>

    </body>
</html> 
