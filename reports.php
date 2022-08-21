<?php

use LDAP\Result;

session_start();
//connection
include('config/db_connect.php');


if(isset($_POST['manager-report'])){
    $bar = textboxValue("bar-staff");
    $kitchen = textboxValue("kitchen-staff");
    $floor = textboxValue("floor-staff");
    $service = textboxValue("service");
    $items = textboxValue("items");
    $breakages = textboxValue("breakages"); 
    $date = date('Y/m/d H:i:s'); 

    if($bar && $kitchen && $floor && $service && $items && $breakages){
      
        $sql = "UPDATE test SET floors='$floor', bar='$bar', kitchen='$kitchen', services='$service', items='$items', breakages='$breakages';"; 
        $sql2 = "UPDATE test SET updated_at='$date';"; 
       
       
                // $sql2 = "INSERT INTO team(updated_at) VALUES('$date')";
       
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Submited");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Empty inputs not allowed");
    }

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


?>

 <!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Manager Report</title>
       
        <link href="css/styles.css" rel="stylesheet" />
       
        <link rel="stylesheet" href="font-awesome/all.min.css">
        <link rel="stylesheet" href="font-awesome/fontawesome.min.css">
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            height: 100vh;
            font-family: 'Open Sans Condensed', sans-serif;
          
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
        <main class="pt-3 mt-5 section mb-5 pb-5">
            <div class="container text-center text-muted manager-report" >

                <div class="container modal-container text-center text-muted">
            <div class="jumbotron bg-dark ">
                <div class="card bg-dark">
                <h2 class="py-2 text-light bg-dark text-muted rounded " id="daily-orders"><i class="fa-solid fa-sheet-plastic"></i> Read reports</h2>
                </div>
                <div class="card bg-dark">
                    <div class="card-body ">
                    <!-- Button trigger modal -->
                    <a type="button" class="btn btn-primary fw-bold " href="shift-report.php"><i class="fa-solid fa-people-group"></i>
                    Manager Shift Report
                    </a>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-danger ms-1 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="fa-solid fa-money-bill-1-wave"></i> Float Open</button>
                    </div>
                            <!-- STOCK TAKE -->

                    <!-- <div class="card-body">
                    <button type="button" class="btn btn-danger ms-1 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="fa-solid fa-money-bill-1-wave"></i> Checklist to order</button>
                    </div> -->
                    <div class="card-body ">
                    <button type="button" class="btn btn-warning ms-1 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal30"><span class="d-flex"><i class="material-icons d-flex">blender</i> Daily Prep </span></button>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-info ms-1 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fa-solid fa-list-check"></i> Duties Checklist</button>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-secondary ms-1 fw-bold"  data-bs-toggle="modal" data-bs-target="#exampleModal4" ><i class="fa-solid fa-money-bills"></i>  Float close</button>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-success ms-1 text-white fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal44"><span class="d-flex"><i class="material-icons me-1">edit_document</i>     End Over</span> </button>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-light ms-1 fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal5"><i class="fa-solid fa-file-lines"></i> Shift Report</button>
                    </div>
                </div>
                </div>
           
            </div>  





            </div>
                        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="main2.js"></script>
            <script type="text/javascript">
       
    </body>
</html> 
