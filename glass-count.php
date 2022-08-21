<?php

use LDAP\Result;

session_start();
//connection
include('config/db_connect.php');
if(isset($_POST['create'])){
  
    createdata();
   
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
    
    $item = textboxValue(value:"item");
    $bar = textboxValue(value:"bar");
    $id = textboxValue(value:"item-id");
    $storeroom = textboxValue(value:"store-room");
    if($item && $bar && $storeroom ){
        
        $sql = "INSERT INTO glass(item,bar,store) VALUES('$item','$bar','$storeroom')";
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
    $sql = "SELECT * FROM glass";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}




// update data
function UpdateData(){
    $item = textboxValue(value:"item");
    $bar = textboxValue(value:"bar");
    $id = textboxValue(value:"item-id");
    $storeroom = textboxValue(value:"store-room");
    if($item && $bar && $storeroom ){
        $sql = " UPDATE glass SET item='$item', bar='$bar', store='$storeroom'  WHERE id='$id';                    
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
    $item = textboxValue(value:"item");
    $bar = textboxValue(value:"bar");
    $id = textboxValue(value:"item-id");
    $storeroom = textboxValue(value:"store-room");
    if($item && $bar && $storeroom ){
    $sql = "DELETE FROM glass WHERE id=$id";
   

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
    $sql = "DELETE FROM glass";

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
if(isset($_POST['glass'])){
    $date = date('Y/m/d H:i:s'); 
          
    $sql = "UPDATE glass_time SET updated_at='$date';";
       if(mysqli_query($GLOBALS['conn'],$sql)){
           TextNode(classname: "success", msg: "Data Succefully Submited...!");
   }else{
       echo "Error";
   }
    }
  
  
    $sql7 = "SELECT * FROM glass_time";
          
    //get the query result
    $result = mysqli_query($conn, $sql7);
  
   //fetch result in array format
    $glass = mysqli_fetch_assoc($result);

?>

 <!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Glass | Count</title>
       
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
                <h2 class="py-2 text-light bg-dark text-muted rounded " id="daily-orders"><i class="fa-solid fa-calculator"></i> Glasses and Set Up Count</h2>
                
                <div class="d-flex justify-content-center">
                <form action="glass-count.php" method="post" class="w-50">
                    <div class="py-2">
                    
                    <div class="input-group mb-3" style="display: none;">
                     <span class="input-group-text bg-danger" id="basic-addon144"><i class="fa-solid fa-receipt text-white"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="item-id" placeholder="Item" aria-label="Recipeee" aria-describedby="basic-addon144">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-receipt text-white"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="item" placeholder="Item" aria-label="Recipe" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-file text-white"></i></span>
                    <input type="number" class="form-control bg-light text-muted "  name="bar" placeholder="Bar" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-file text-white"></i></span>
                    <input type="number" class="form-control bg-light text-muted "  name="store-room" placeholder="Store room" aria-label="Request" aria-describedby="basic-addon1">
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
                            <th>Bar</th>
                            <th>Store Room</th>
                            <th>Total</th>
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
                                 
                                        
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['item']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['bar']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['store']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php 
                                            
                                            
                                                $manuf =  $row['bar'] + $row['store'] ;
                                          
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
            <form action="glass-count.php" method="POST">
                            <button type="submit" class="btn-info rounded fw-bold ps-2 pe-2" name="glass"> Submit</button>
            </form>
            </div>
                        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="glass.js"></script>

    </body>
</html> 
