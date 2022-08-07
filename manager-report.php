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
    $mod = textboxValue("manager-on-duty"); 
    $date = date('Y/m/d H:i:s'); 

    if($bar && $kitchen && $floor && $service && $items && $breakages && $mod){
      
        $sql = "UPDATE test SET floors='$floor', bar='$bar', kitchen='$kitchen', services='$service', items='$items', breakages='$breakages', manager='$mod';"; 
        $sql2 = "UPDATE test SET updated_at='$date';";
                // $sql2 = "INSERT INTO team(updated_at) VALUES('$date')";
       
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Submited");
            header('Location: shift-report.php');
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
           .body {
	background:#333 url(https://static.tumblr.com/maopbtg/a5emgtoju/inflicted.png) repeat;        
}
#paper {
	color:#FFF;
	font-size:20px;
  font-family:Courier, monospace;
}
#margin {
	margin-left:12px;
	margin-bottom:20px;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	-o-user-select: none;
	user-select: none; 
}
.text {
	width:90%;
	overflow: hidden;
	background-color:#FFF;
	color:#222;
	font-family:Courier, monospace;
	font-weight:normal;
	font-size: 1rem;
	resize:none;
	line-height:40px;
	padding-left:100px;
	padding-right:10px;
	padding-top: 3rem;
	padding-bottom: 48px;
  max-height: 280px;
  max-width: 100%;

	background-image:url(https://static.tumblr.com/maopbtg/E9Bmgtoht/lines.png), url(https://static.tumblr.com/maopbtg/nBUmgtogx/paper.png);
	background-repeat:repeat-y, repeat;
	-webkit-border-radius:12px;
	border-radius:12px;
	-webkit-box-shadow: 0px 2px 14px #000;
	box-shadow: 0px 2px 14px #000;
	border-top:1px solid #FFF;
	border-bottom:1px solid #FFF;
  outline: none;
  border:none; 
   /* width: 90vw; */
}
.form-control{
    max-width: 100%;
}
.form{
    display: flex;
    flex-direction: column;
    align-items: center;
  
}
.input-group{
  
   width: 600px;
}
@media(max-width: 480px) {
    .text {
        max-width: 100%;
        width:100%;
    }
    .form-control{
    max-width: 100%;
}
.input-group{
  
  width: 100%;
}

}

@media(max-width: 820px) and (min-width: 480px) {
    .text{
        max-width: 100%;
        width: 100%;
    }
    .form-control{
    max-width: 100%;
}
    

@media(min-width: 820px){
    input{
       
        width: 100px;
    }
   
}
    

}


.wrapper {
	width: 100%;
	height:auto;
	/* margin-left: -1rem;
	margin-right: -1rem; */
    margin: auto;
	
}
.submit{
    width: 100%;
}


	
    </style>
    <?php include('template/admin-header.php');?>
        <main class="pt-3 mt-5 section mb-5 pb-5">
            <div class="container text-center text-muted manager-report" >
            <p id="daily-prep" style="display: none;"></p>
                <h2 class="py-2 text-light bg-dark text-muted rounded " id="daily-orders"><i class="fa-solid fa-marker"></i> Manager Shift Report</h2>
                <div class="">
                <form action="manager-report.php" method="post" >
                    <div class="py-2 form">
                    
                    <div >
                    <div class="input-group mb-3" >
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-id-badge text-white"></i></span>
                     <input type="text" class="form-control bg-light text-muted " name="manager-on-duty" placeholder="Manager On Duty" aria-label="Recipe" aria-describedby="basic-addon1" >
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-users text-light"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="floor-staff" placeholder="Floor Staff" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
                        
                             <div class="input-group mb-3" >
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-users text-light"></i></span>
                     <input type="text" class="form-control bg-light text-muted " name="bar-staff" placeholder="Bar Staff" aria-label="Recipe" aria-describedby="basic-addon1" >
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-users text-light"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="kitchen-staff" placeholder="Kitchen Staff" aria-label="Recipe" aria-describedby="basic-addon1">
                    </div>
                                       
                    <div class=" mb-3 justify-content-center form-floating wrapper "  >
                      <div >
                         <textarea placeholder="Enter your notes here." class="text form-control input-group"  name="service" id="floatingTextarea" rows="10" style=" word-wrap: break-word; resize: none; height: 160px; "></textarea>
                      </div>
                     <div>
            
                    </div>            

                    <label for="floatingTextarea"><span> Service</label>
                    </div>
                    <div class=" mb-3 justify-content-center form-floating wrapper"  >
                      <div >
                         <textarea placeholder="Enter your notes here." class="text form-control input-group"  name="items" id="floatingTextarea" rows="10" style=" word-wrap: break-word; resize: none; height: 160px; "></textarea>
                      </div>
                     <div>
            
                    </div>            

                    <label for="floatingTextarea"><span> 86 Items</label>
                    </div>
                    <div class=" mb-3 justify-content-center form-floating wrapper"  >
                      <div >
                         <textarea placeholder="Enter your notes here." class="text form-control input-group"  name="breakages" id="floatingTextarea" rows="10" style=" word-wrap: break-word; resize: none; height: 160px; "></textarea>
                      </div>
                     <div>
            
                    </div>            

                    <label for="floatingTextarea"><span> Breakages</span><br> <span>& </span><br> Spillage</label>
                    </div>
  <button type="submit" name="manager-report" class="btn btn-primary mb-5 submit" >Submit</button>
                    </div>
                    </div>
                </form>
            </div>
            </div>
                        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="main2.js"></script>
            <script type="text/javascript">
        $('.text').on('input', function () {
            // this.style.height = 'auto';
              
            this.style.height = 
                    (this.scrollHeight) + 'px';
                    $('.text').autosize();
        });
    </script>
    </body>
</html> 
