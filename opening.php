<?php

use LDAP\Result;

session_start();
$par = $_SESSION['par']; 
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



function createData(){
    
    $itemname = textboxValue(value:"item-name");
    $tobuy = textboxValue(value:"to-buy");
    $id = textboxValue(value:"item-id");
    if($itemname && $tobuy){
        $sql = "INSERT INTO hotlist(id,item_name,to_buy) VALUES('$id', '$itemname',$tobuy)";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Record Succefully Inserted...!");
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }

}

if(isset($_POST['endover'])){
    $anchorname = textboxValue(value:"anchor-name");
    $text = textboxValue(value:"text");
    $date = date('Y/m/d H:i:s'); 
    if($anchorname && $text){
        // $sql = "UPDATE end_over_day SET anchor_name='$anchorname', text_area='$text';";
        $sql = "UPDATE end_over_day SET anchor_name='$anchorname', text_area='$text';";
            $sql2 = "INSERT INTO team(updated_at) VALUES('$date')";

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
    $sql = "SELECT * FROM hotlist";

    $result = mysqli_query($GLOBALS['conn'], $sql);


    if(mysqli_num_rows($result) > 0){
        return $result;
    }

}
function get_Data(){
    $sql = "SELECT * FROM bartender";

    $result = mysqli_query($GLOBALS['conn'], $sql);


    if(mysqli_num_rows($result) > 0){
        return $result;
    }

}
function getData_(){
    $sql = "SELECT * FROM barback";

    $result = mysqli_query($GLOBALS['conn'], $sql);


    if(mysqli_num_rows($result) > 0){
        return $result;
    }

}

// update data
function UpdateData(){
    $itemid = textboxValue(value:"item-id");
    $itemname = textboxValue(value:"item-name");
    $tobuy = textboxValue(value:"to-buy");

    if($itemname && $tobuy){
    $sql = "UPDATE hotlist SET item_name ='$itemname', to_buy='$tobuy'  WHERE id = '$itemid';";
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
    $itemid = (int)textboxValue("item-id");
    $itemname = textboxValue("item-name");
    $tobuy = textboxValue("to-buy");

    if($itemname && $tobuy){
    $sql = "DELETE FROM hotlist WHERE id='$itemid'";

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
    $sql = "DELETE FROM hotlist";

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
    // OPENING PROCEDURE OPERATIONS

    // SAVE TEAM ON SHFT

    if(isset($_POST['saveteam'])){
    $manageronduty = textboxValue(value:"manager-on-duty");
    $anchoronduty = textboxValue(value:"anchor-on-duty");
    $preponduty = textboxValue(value:"prep-on-duty");
    $barbackonduty = textboxValue(value:"bar-back-on-duty");
    $date = date('Y/m/d H:i:s'); 
    if($manageronduty && $anchoronduty && $preponduty && $barbackonduty){
        
        $sql = "UPDATE team SET manager_on_duty='$manageronduty', anchor_on='$anchoronduty', prep_on='$preponduty', bar_back='$barbackonduty';";
        $sql2 = "INSERT INTO team(updated_at) VALUES('$date')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Data Succefully Inserted...!");
            
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }
   
    }
     //make sql
     $sql = "SELECT * FROM team";
        
     //get the query result
     $result = mysqli_query($conn, $sql);
 
     //fetch result in array format
     $team = mysqli_fetch_assoc($result);

    // HOT LIST TO BUY OPERATION
    if(isset($_POST['tobuy'])){
      
         $date = date('Y/m/d H:i:s'); 
            
         $sql = "UPDATE hotlist_time SET updated_at='$date';";
            if(mysqli_query($GLOBALS['conn'],$sql)){
                TextNode(classname: "success", msg: "Data Succefully Submited...!");
        }else{
            echo "Error";
        }
      }
    
    if(isset($_POST['dutytime'])){
      $date = date('Y/m/d H:i:s'); 
            
      $sql = "UPDATE duty_time SET updated_at='$date';";
         if(mysqli_query($GLOBALS['conn'],$sql)){
             TextNode(classname: "success", msg: "Data Succefully Submited...!");
     }else{
         echo "Error";
     }
      }
    

      //  PREP UPDATE 
    if(isset($_POST['preptime'])){
      $date = date('Y/m/d H:i:s'); 
            
      $sql = "UPDATE prep_time SET updated_at='$date';";
         if(mysqli_query($GLOBALS['conn'],$sql)){
             TextNode(classname: "success", msg: "Data Succefully Submited...!");
     }else{
         echo "Error";
     }
      }
    
    
      $sql7 = "SELECT * FROM hotlist_time";
            
      //get the query result
      $result = mysqli_query($conn, $sql7);
    
     //fetch result in array format
      $tobuy = mysqli_fetch_assoc($result);

      // PREP UPDATE TIME

      $sql90 = "SELECT * FROM prep_time";
            
      //get the query result
      $result = mysqli_query($conn, $sql90);
    
     //fetch result in array format
      $preptime = mysqli_fetch_assoc($result);




      $sql77 = "SELECT * FROM end_over_day";
            
      //get the query result
      $result77 = mysqli_query($conn, $sql77);
    
     //fetch result in array format
      $endoverday = mysqli_fetch_assoc($result77);
      


      $sql17 = "SELECT * FROM duty_time";
            
      //get the query result
      $result17 = mysqli_query($conn, $sql17);
    
     //fetch result in array format
      $duty = mysqli_fetch_assoc($result17);
      

// SAVE FLOAT CLOSE 

if(isset($_POST['floatopen'])){
    $twohundred = textboxValue(value:"two-hundred");
    $onehundred = textboxValue(value:"one-hundred");
    $fifty = textboxValue(value:"fifty-");
    $twenty = textboxValue(value:"twenty-");
    $ten = textboxValue(value:"ten-");
    $five = textboxValue(value:"five-");
    $two = textboxValue(value:"two-");
    $one = textboxValue(value:"one-");
    $fiftycent = textboxValue(value:"fifty-cent");
    $date = date('Y/m/d H:i:s'); 
     
    if($twohundred && $onehundred && $fifty && $twenty && $ten && $five && $two && $one  && $fiftycent){
        
        $sql = "UPDATE float_open SET two_hundred='$twohundred', one_hundred='$onehundred', fifty_='$fifty', twenty_='$twenty', ten_='$ten', five_='$five', two_='$two', one_='$one', fifty_cent='$fiftycent';";
        
        $sql2 = "INSERT INTO float_open(updated_at) VALUES('$date')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Data Succefully Inserted...!");
            
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }
    
    }
    $sql3 = "SELECT * FROM float_open";
        
    //get the query result
    $result3 = mysqli_query($conn, $sql3);

    //fetch result in array format
    $floatopen = mysqli_fetch_assoc($result3);




// SAVE FLOAT CLOSE 

if(isset($_POST['floatclose'])){
    $twohundred = textboxValue(value:"two-hundred");
    $onehundred = textboxValue(value:"one-hundred");
    $fifty = textboxValue(value:"fifty-");
    $twenty = textboxValue(value:"twenty-");
    $ten = textboxValue(value:"ten-");
    $five = textboxValue(value:"five-");
    $two = textboxValue(value:"two-");
    $one = textboxValue(value:"one-");
    $fiftycent = textboxValue(value:"fifty-cent");
    $date = date('Y/m/d H:i:s'); 
     
    if($twohundred && $onehundred && $fifty && $twenty && $ten && $five && $two && $one  && $fiftycent){
        
        $sql = "UPDATE float_close SET two_hundred='$twohundred', one_hundred='$onehundred', fifty_='$fifty', twenty_='$twenty', ten_='$ten', five_='$five', two_='$two', one_='$one', fifty_cent='$fiftycent';";
        
        $sql2 = "INSERT INTO float_close(updated_at) VALUES('$date')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Data Succefully Inserted...!");
            
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }
    
    }
    $sql33 = "SELECT * FROM float_close";
        
    //get the query result
    $result33 = mysqli_query($conn, $sql33);

    //fetch result in array format
    $floatclose = mysqli_fetch_assoc($result33);



    // PREP OPERATIONS


  
    if(isset($_POST['create_prep'])){
        setcookie($_POST['par'], time()+ 86400);
        createdata_prep();
       
    }
    
    if(isset($_POST['update_prep'])){
        setcookie($_POST['par'], time()+ 86400);
        UpdateData_prep();
    }
    
    if(isset($_POST['delete_prep'])){
        deleteRecord_prep();
    }
    
    if(isset($_POST['deleteall_prep'])){
        deleteAll_prep();
    }
    
    
   
    
    
    
    function createData_prep(){
        
        $recipename = textboxValue(value:"recipe-name");
        $stockonhand = textboxValue(value:"stock-on-hand");
        $id = textboxValue(value:"recipe-id");
        $slow = textboxValue(value:"slow-par");
        $busy = textboxValue(value:"busy-par");
    
      
    
        if($recipename && $stockonhand && $slow && $busy){
            
            $sql = "INSERT INTO prep(slow,busy,id,recipe_name,stock_on_hand) VALUES('$slow',$busy,'$id','$recipename','$stockonhand')";
            if(mysqli_query($GLOBALS['conn'],$sql)){
                TextNode(classname: "success", msg: "Record Succefully Inserted...!");
            }else{
                echo "Error";
            }
            
        }else{
            TextNode(classname: "error", msg: "Provide Data in the Textbox");
        }
    
    }
    
   
    
    //Get data from mysql data base
    function getData_prep(){
        $sql = "SELECT * FROM prep";
    
        $result = mysqli_query($GLOBALS['conn'], $sql);
    
        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
    
    
    
    
    // update data
    function UpdateData_prep(){
        $recipeid = textboxValue("recipe-id");
        $recipename = textboxValue("recipe-name");
        $stockonhand = textboxValue("stock-on-hand");
        $slow = textboxValue(value:"slow-par");
        $busy = textboxValue(value:"busy-par");
     
    
        if($recipename && $stockonhand && $slow && $busy){
            $sql = "
                        UPDATE prep SET recipe_name='$recipename', stock_on_hand = '$stockonhand', busy='$busy', slow='$slow'  WHERE id='$recipeid';                    
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
    
function deleteRecord_prep(){
  $recipeid = (int)textboxValue("recipe-id");
  $recipename = textboxValue("recipe-name");
  $stockonhand = textboxValue("stock-on-hand");
  $slow = textboxValue(value:"slow-par");
  $busy = textboxValue(value:"busy-par");


  if($recipename && $stockonhand && $slow && $busy){
  $sql = "DELETE FROM prep WHERE id=$recipeid";
 

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

    function deleteBtn_prep(){
      $result = getData_prep();
      $i = 0;
      if($result){
          while ($row = mysqli_fetch_assoc($result)){
              $i++;
              if($i > 3){
                  buttonElement("btn-deleteall", "btn del_all btn-prep" ,"<i class='fa-solid fa-eraser'></i>", "deleteall_prep", "All");
  
  
                  return;
              }
          }
      }
  }
    
    
    
    
    function deleteAll_prep(){
        $sql = "DELETE FROM prep";
    
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success","All Record deleted Successfully...!");
        }else{
            TextNode("error","Something Went Wrong Record cannot deleted...!");
        }
    }
    
    
    // set id to textbox
    function setID_prep(){
        $getid = getData_prep();
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
        <title>Opening Procedure</title>
        <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/my_style.css" rel="stylesheet" />
       
        <link rel="stylesheet" href="font-awesome/all.min.css">
        <link rel="stylesheet" href="font-awesome/fontawesome.min.css">
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');
            @import '~pretty-checkbox/src/pretty-checkbox.scss';
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
          height: 1.5em;
          width: 15%;
          
       }
       .btn-prep{
                    width: 25%;
                    height: 50px;
                    margin: auto;
                }
                .effect{
                    font-size: 1.4rem;
                }
                .cocktail{
                    margin-top: 1px;
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
    background: white;
}
                <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');
            @import '~pretty-checkbox/scss/variables';
             @import '~pretty-checkbox/scss/core';
    
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
           .fa-square-check{
            color: #1A8450;
            cursor: pointer;
            
           }
           .report-group{
            width: 97%;
            align-items: center;
            justify-content: center;
            margin: auto;
            
           }
           .update-container{
            display: flex;
            justify-content: flex-end;
            
           }
           .report-header{
            border:  dashed 3px;
            border-left: none;
            border-top: none;
            border-right: none;
            display: flex;
            justify-content: center;
           }
           .endover{
            /* border:  dashed 3px;
            border-left: none;
            border-top: dashed 1px;
            border-right: none;
           border-bottom: none; */
           
           margin-bottom: 10px;
           }
           .report-section{
            border:  dashed 1px;
            border-left: none;
            border-top: none;
            border-right: none;
           }
           .team-section{
            display: flex;
            justify-content: space-between;
           }
           .cause-effect{
            letter-spacing: 3px;
            font-size: 2rem;
            font-weight: bolder;
           }
           .report-title{
            font-size: 1.1rem;
           }
           .ce_logo{
            margin: auto;
           }
           .copy-right{
                font-size: .9rem;
           }

            .modal-text-area{
              /* overflow-y: auto; */
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
#text {
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
  max-height: 480px;
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
}


#wrapper {
	width:118%;
	height:auto;
	margin-left: -1rem;
	margin-right: -1rem;
	
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
           .notes_by{
    display: flex;
    justify-content: flex-end;
    margin-right: 10px;
}
.wrote_by{
    font-size: .8rem;
    font-weight: bold;
}.wrote_by_{
    font-size: .8rem;
  
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

        </style>
    <?php include('template/admin-header.php');?>
        <main class="pt-3 mt-5 section">

           <!-- TEAM MODAL -->
           
<div class="modal fade pt-5 mt-2" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header p-2 modal-header1 bg-secondary text-white border-dark">
        <h5 class="modal-title" id="exampleModalLabel">Team On Shift</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="opening.php" method="POST">

      <div class="modal-body bg-dark text-white" >
      <div class="input-group mb-3">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-user-gear"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="manager-on-duty" placeholder="Manager On Duty" aria-label="item" aria-describedby="basic-addon1">
                    </div>
      <div class="input-group mb-3">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-user-tag"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="anchor-on-duty" placeholder="Anchor" aria-label="item" aria-describedby="basic-addon1">
                    </div>
      <div class="input-group mb-3">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-hot-tub-person"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="prep-on-duty" placeholder="Prep" aria-label="item" aria-describedby="basic-addon1">
                    </div>
      <div class="input-group mb-3">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="bar-back-on-duty" placeholder="Bar Back(s)" aria-label="item" aria-describedby="basic-addon1">
                    </div>              
</div>


      <div class="modal-footer bg-dark border-dark">
      <button type="button" class="btn btn-secondary text-white " data-bs-dismiss="modal">Close</button>
        <button type="submit" name="saveteam" class="btn btn-primary" >Submit</button>
      </div>
      </form> 
    </div>
  </div>
</div>
           <!-- DAILY PREP MODAL -->
           
<div class="modal fade pt-5 mt-2" id="exampleModal30" tabindex="-1" aria-labelledby="exampleModalLabel30" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header p-2 modal-header1 bg-secondary text-white border-dark">
        <h5 class="modal-title" id="exampleModalLabel30">Daily Prep</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="opening.php" method="POST">

      <div class="modal-body bg-dark text-white" >
      
      <main >
            <div class="container daily-prep-modal text-center text-muted">
            <p id="daily-prep" style="display: none;"></p>
                <h2 class="py-2 text-light bg-dark text-muted rounded " id="prep"><i class="fa-solid fa-file-invoice"></i> Daily Prep</h2>
                
                <div class="justify-content-center">
                <form action="opening.php" method="post" class="w-50">
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
                     <input type="number" step="0.01" min="0" class="form-control bg-white text-muted bold " name="slow-par" placeholder="Slow" aria-label="Request" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group par-input">
                     <span class="input-group-text text-white bg-danger" id="basic-addon1">
 <i class="fa-solid fa-cart-plus"></i></span>

                    <input type="number" step="0.01" min="0" class="form-control bg-white text-muted bold " name="busy-par" placeholder="Busy" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
        </div>
                    <div class="input-group mb-3" style="display: none;">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-id-badge text-white"></i></span>
                    <input type="text" autocomplete="on" class="form-control bg-light text-white" name="recipe-id" placeholder="ID" aria-label="id" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-receipt text-white"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="recipe-name" placeholder="Recipe Name" aria-label="Recipe" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-file text-white"></i></span>
                    <input type="number" step="0.01" min="0" class="form-control bg-light text-muted " name="stock-on-hand" placeholder="Stock On Hand" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
                    </div>
                    <div class="d-flex btn-group-prep justify-content-center">
                        <button class="btn-success rounded btn-prep me-1" name="create_prep"><i class="fa-solid fa-plus"></i></button>
                        <button class="btn-primary rounded btn-prep me-1 "name="read_prep"><i class="fa-solid fa-rotate"></i></button>
                        <button class="btn-warning rounded btn-prep me-1" name="update_prep"><i class="fa-solid fa-marker text-white"></i></button>
                        <button class="btn-danger rounded btn-prep me-1" name="delete_prep"><i class="fa-solid fa-trash-can"></i></button>
                        <?php deleteBtn_prep();?>
                    </div>
                </form>
            </div>

            <!-- bootstrap table -->
            <div class=" table-data py-2 ">
                <table class="table table-striped table-dark">
                    <thead class="thead-dark text-muted">
                        <tr>
                            <th>Id</th>
                            <th>Recipe Name</th>
                            <th>Stock On Hand</th>
                            <th>Manufacturer</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                        <?php
                            if(isset($_POST['read_prep'])){
                                $result = getData_prep();
                                if($result){
                                    $i=0;
                               while($row = mysqli_fetch_assoc($result)){    
                                  
                                   $i++;

                                
                                   ?>
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
                                         <td ><a href="#prep"><i class="fas fa-edit btnedit" data-id="<?php echo $row['id']; ?>"></i></a></td>
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


      <div class="modal-footer bg-dark border-dark">
      <button type="button" class="btn btn-secondary text-white " data-bs-dismiss="modal">Close</button>
      <form action="opening.php" method="POST">
        <button type="submit" name="preptime" class="btn btn-primary" >Submit</button>
      </form>
      </div>
      </form> 
    </div>
  </div>
</div>
         <!-- END OVER CONTENTS -->
           
<div class="modal fade pt-5 mt-2" id="exampleModal44" tabindex="-1" aria-labelledby="exampleModalLabel44" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header p-2 modal-header1 bg-secondary text-white border-dark">
        <h5 class="modal-title" id="exampleModalLabel">End Over Notes</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="opening.php" method="POST">
      <div class="modal-body modal-text-area bg-dark text-white" >
      <div class="input-group mb-3">
                     <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control bg-light text-muted " name="anchor-name" placeholder="Enter your name" aria-label="item" aria-describedby="basic-addon1">
                    </div>
      <div id="wrapper" class="container">

	<form id="paper" method="get" action="$_POST" >
    
		<textarea placeholder="Enter some notes here." id="text"  name="text" rows="10" style=" word-wrap: break-word; resize: none; height: 160px; "></textarea>  
		<br>
		

</div> 

      </div>


      <div class="modal-footer bg-dark border-dark">
      <button type="button" class="btn btn-secondary text-white " data-bs-dismiss="modal">Close</button>
        <button type="submit" name="endover" class="btn btn-primary" >Submit</button>
      </div>
      </form> 
    </div>
  </div>
</div>
 
<!-- MODAL FLOAT OPEN -->

<div class="modal fade pt-5 mt-2" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header modal-header1 bg-secondary text-white border-dark p-2">
        <h5 class="modal-title" id="exampleModalLabel">Float Open</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      

      <form action="opening.php" method="POST" >

      <div class="modal-body bg-dark text-white" >
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold " id="basic-addon1">200</span>
                    <input type="number" class="form-control bg-light text-muted" name="two-hundred" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">100</span>
                    <input type="number" class="form-control bg-light text-muted  " name="one-hundred" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group  mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1"> 50</span>
                    <input type="number" class="form-control bg-light text-muted  " name="fifty-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1"> 20</span>
                    <input type="number" class="form-control bg-light text-muted  " name="twenty-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1"> 10</span>
                    <input type="number" class="form-control bg-light text-muted  " name="ten-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </number
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">  5</span>
                    <input type="number" class="form-control bg-light text-muted  " name="five-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">   2</span>
                    <input type="number" class="form-control bg-light text-muted  " name="two-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">  1</span>
                    <input type="number" class="form-control bg-light text-muted  " name="one-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">50c</span>
                    <input type="number" class="form-control bg-light text-muted  " name="fifty-cent" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>

</div>


      <div class="modal-footer bg-dark border-dark">
      <button type="button" class="btn btn-secondary text-white " data-bs-dismiss="modal">Close</button>
        <button type="submit" name="floatopen" class="btn btn-primary">Submit</button>
      </div>
        </form>
    </div>
  </div>
</div>
 
<!-- MODAL FLOAT CLOSE -->
<div class="modal fade pt-5 mt-2" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header modal-header1 bg-secondary text-white border-dark p-2">
        <h5 class="modal-title" id="exampleModalLabel">Float Close</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      

      <form action="opening.php" method="POST" >

      <div class="modal-body bg-dark text-white" >
      <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold " id="basic-addon1">200</span>
                    <input type="number" class="form-control bg-light text-muted" name="two-hundred" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">100</span>
                    <input type="number" class="form-control bg-light text-muted  " name="one-hundred" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group  mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1"> 50</span>
                    <input type="number" class="form-control bg-light text-muted  " name="fifty-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1"> 20</span>
                    <input type="number" class="form-control bg-light text-muted  " name="twenty-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1"> 10</span>
                    <input type="number" class="form-control bg-light text-muted  " name="ten-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </number
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">  5</span>
                    <input type="number" class="form-control bg-light text-muted  " name="five-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">   2</span>
                    <input type="number" class="form-control bg-light text-muted  " name="two-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group mb-1">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">  1</span>
                    <input type="number" class="form-control bg-light text-muted  " name="one-" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
    <div class="form-group float-open-form">
    <div class="input-group">
                     <span class="input-group-text bg-danger text-white fw-bold" id="basic-addon1">50c</span>
                    <input type="number" class="form-control bg-light text-muted  " name="fifty-cent" placeholder="Quantity" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
    </div>
     </div>


      <div class="modal-footer bg-dark border-dark">
      <button type="button" class="btn btn-secondary text-white " data-bs-dismiss="modal">Close</button>
        <button type="submit" name="floatclose" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

      <!-- SHIFT REPORT -->
      
<div class="modal fade pt-5 pb-5 mt-2" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel5" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog pb-5 " ">
    <div class="modal-content  text-muted bg-dark">
      <div class="modal-header modal-header1 bg-secondary text-white border-dark p-2">
        <h5 class="modal-title" id="exampleModalLabel">Opening Procedure Report</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-white" >
      <div class="rounded text-muted bg-light ">
        <div class="report-header report-group py-3">
           <img src="./assets/C _ E _ Responsive Logo _ Black New Tagline _ Low.png" style="width: 70%;" alt="causem effect logo" class="ce_logo">
        </div>
     
                <!-- TEAM ON SHIFT REPORT -->
                <div class="report-group pt-1">
                     
                     <div class="update-container border-secondary">
                     <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($team['updated_at'])?></h6>  
                   </div>
                   
                     </div>
                     <h5 class="report-title fw-bold text-center" >Team on shift</h5>
                     <div class="team-section report-section">
                      <div class="team-position">
                        <h6 class="">MOD:</h6>
                        <h6 class="">Anchor:</h6>
                        <h6 class="">Prep:</h6>
                        <h6 class="">Bar Back:</h6>
                    </div>
                      <div class="team-name">
                        <h6><?php echo htmlspecialchars($team['manager_on_duty'])?> </h6>
                        <h6><?php echo htmlspecialchars($team['anchor_on'])?></h6> 
                        <h6><?php echo htmlspecialchars($team['prep_on'])?></h6> 
                        <h6><?php echo htmlspecialchars($team['bar_back'])?></h6>
                      </div> 
                     </div>
                </div>
             
                <!-- FLOAT OPEN REPORT -->
                <div class="report-group pt-1">
                <div class="update-container border-secondary">
                     <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($floatopen['updated_at'])?></h6>  
                   </div>
                   
                     </div>
                     <h5 class=" report-title fw-bold text-center" >Float open</h5>
                     <div class="report-section">
                        <!-- FLOAT OPEN TABLE -->
                        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Note</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">200</th>
      <td><?php echo $floatopen['two_hundred'];?></td>
      <td><?php echo $total1 = $floatopen['two_hundred'] * 200;?></td>
    </tr>
    <tr>
      <th scope="row">100</th>
      <td><?php echo $floatopen['one_hundred'];?></td>
      <td><?php echo $total2 = $floatopen['one_hundred'] * 100;?></td>
    </tr>
    <tr>
      <th scope="row">50</th>
      <td><?php echo $floatopen['fifty_'];?></td>
      <td><?php echo $total3 = $floatopen['fifty_']*50;?></td>
    </tr>
    <tr>
      <th scope="row">20</th>
      <td><?php echo $floatopen['twenty_'];?></td>
      <td><?php echo $total4 = $floatopen['twenty_']*20;?></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td><?php echo $floatopen['ten_']?></td>
      <td><?php echo $total5 = $floatopen['ten_']*10;?></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><?php echo $floatopen['five_']?></td>
      <td><?php echo $total6 = $floatopen['five_']*5;?></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><?php echo $floatopen['two_']?></td>
      <td><?php echo $total7 = $floatopen['two_']*2?></td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $floatopen['one_']?></td>
      <td><?php echo $total8 = $floatopen['one_']?></td>
    </tr>
    <tr>
      <th scope="row">50c</th>
      <td><?php echo $floatopen['fifty_cent']?></td>
      <td><?php echo $total9 = $floatopen['fifty_cent'] / 2?></td>
    </tr>
    <tr>
      <th scope="row">G/Total</th>
      <td></td>
      <th class="bold"><p><?php echo "R";?></h6><span><?php echo $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9;?></span>
    </th>
    </tr>
 
  </tbody>
</table>

                     </div>
                </div>
             
               
                <!-- CHECKLIST TO ORDER REPORT -->
                <!-- <div class="report-group pt-1">
                <div class="update-container border-secondary">
                     <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($tobuy['updated_at'])?></h6>  
                   </div>
                   
                     </div>
                     <h5 class="report-title fw-bold text-center">Checklist to order</h5>
                     <div class="report-section">

                     <div class="d-flex table-data py-2 ">
                <table class="table table-striped">
                    <thead class="thead-dark text-muted">
                        <tr>
                            <th>Item Name</th>
                            <th>Buy</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                        <?php
                        
                                $result = getData();
                                if($result){
                                    while($row = mysqli_fetch_assoc($result)){?>
                                    
                                     <tr>
                                         <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php echo $row['id']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['item_name']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['to_buy']?></td>
                                
                                     </tr>
                                     <?php 
                                    }
                                }
                  
                        ?>
                    </tbody>
                </table>
            </div>
                            

               
                     </div>
                </div> -->
                
                <!-- DUTIES CHECKLIST REPORT -->
                <div class="report-group pt-1">
                <div class="update-container border-secondary">
                     <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($duty['updated_at'])?></h6>  
                   </div>
                   
                     </div>
                     <h5 class=" report-title fw-bold text-center" >Duties Checklist</h5>
                     <div class="report-section">
                        <!-- BARTENDERS DUTIES REPORT -->
                     <h6 class="fw-bold">Bartenders Duties</h6>
                     <div class=" table-data py-2 ">
            
            <form id="form" action="opening.php" method="POST" >

<table class="table table-striped ">
              <thead class="thead-dark text-muted">
                  <tr>
                      <th>Priority</th>
                      <th>Duty</th>
                      <th>Completion</th>
                  </tr>
              </thead>
              <tbody id="tbody">  

                  <?php
                    $result = get_Data();
                     if($result){
                       $i=0;
                      while($row = mysqli_fetch_assoc($result)){    
                        $i++;
                        $duty = $row['duty'];
                       
                        $id = $row['id'];
                  
                      ?>
                      <tr>    
                      <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                     
                                     echo $row['id'];
                                  ?></td>
                                  <td ><?php 
                                    
                                      echo $i;
                                  ?></td>
                       <td data-id="<?php echo $row['id']; ?>"><?php echo $row['duty']?></td>
                       <td data-id="<?php echo $row['id']; ?>"><?php echo $row['complete']?></td>
                   </tr>
                   <?php  
                    }
                
                  }
                      ?>
                  
              </tbody>
          </table>
        
</form> 


          </div>
                        <!-- BAR BACKS DUTIES REPORT -->
                     <h6 class="fw-bold">Bar backs Duties</h6>
                     <div class=" table-data py-2 ">
            
            <form id="form" action="opening.php" method="POST" >

<table class="table table-striped ">
              <thead class="thead-dark text-muted">
                  <tr>
                      <th>Priority</th>
                      <th>Duty</th>
                      <th>Completion</th>
                  </tr>
              </thead>
              <tbody id="tbody">  

                  <?php
                    $result = getData_();
                     if($result){
                       $i=0;
                      while($row = mysqli_fetch_assoc($result)){    
                        $i++;
                        $duty = $row['duty'];
                       
                        $id = $row['id'];
                  
                      ?>
                      <tr>    
                      <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                     
                                     echo $row['id'];
                                  ?></td>
                                  <td ><?php 
                                    
                                      echo $i;
                                  ?></td>
                       <td data-id="<?php echo $row['id']; ?>"><?php echo $row['duty']?></td> 
                       <td data-id="<?php echo $row['id']; ?>"><?php echo $row['complete']?></td> 
                   </tr>
                
               
                   <?php  
                    }
                
                  }
                      ?>
                  
              </tbody>
          </table>
    


          </div>
                     </div>
                </div>
             
                <!-- FLOAT CLOSE REPORT -->
                <div class="report-group pt-1">
                <div class="update-container border-secondary">
                     <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($team['updated_at'])?></h6>  
                   </div>
                   
                     </div>
                     <h5 class="report-title fw-bold text-center" >Float close</h5>
                     <div class="report-section">
                        <!-- FLOAT CLOSE TABLE -->
                        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Note</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">200</th>
      <td><?php echo $floatclose['two_hundred'];?></td>
      <td><?php echo $total1 = $floatclose['two_hundred'] * 200;?></td>
    </tr>
    <tr>
      <th scope="row">100</th>
      <td><?php echo $floatclose['one_hundred'];?></td>
      <td><?php echo $total2 = $floatclose['one_hundred'] * 100;?></td>
    </tr>
    <tr>
      <th scope="row">50</th>
      <td><?php echo $floatclose['fifty_'];?></td>
      <td><?php echo $total3 = $floatclose['fifty_']*50;?></td>
    </tr>
    <tr>
      <th scope="row">20</th>
      <td><?php echo $floatclose['twenty_'];?></td>
      <td><?php echo $total4 = $floatclose['twenty_']*20;?></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td><?php echo $floatclose['ten_']?></td>
      <td><?php echo $total5 = $floatclose['ten_']*10;?></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><?php echo $floatclose['five_']?></td>
      <td><?php echo $total6 = $floatclose['five_']*5;?></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><?php echo $floatclose['two_']?></td>
    <td><?php echo $total7 = $floatclose['two_']*2?></td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $floatclose['one_']?></td>
      <td><?php echo $total8 = $floatclose['one_']?></td>
    </tr>
    <tr>
      <th scope="row">50c</th>
      <td><?php echo $floatclose['fifty_cent']?></td>
      <td><?php echo $total9 = $floatclose['fifty_cent'] / 2?></td>
    </tr>
    <tr>
      <th scope="row">G/Total</th>
      <td></td>
      <th class="bold"><p><?php echo "R";?></h6><span><?php echo $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9;?></span>
    </th>
    </tr>
 
  </tbody>
</table>

                     </div>
                </div>
              
             
                             <!-- END OVER REPORT -->
                             <div class="report-group endover pt-1">
                
                <div class="update-container border-secondary" >
                        <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($endoverday['updated_at'])?></h6>  
                </div>
                </div>
                 
                     <h5 class="report-title fw-bold text-center" >Notes</h5>
                     <div class="mb-1">
                     <p style=" word-wrap: break-word;"><?php echo htmlspecialchars($endoverday['text_area'])?></p>
                     </div>
                     <div class="notes_by">
                        <h6 ><span class="wrote_by"> Wrote by: </span><span class="wrote_by_"><?php echo htmlspecialchars($endoverday['anchor_name'])?></span></h6>
                     </div>
                </div>
                
                <div class="text-center text-muted py-2 copy-right">&copy;<?php // Store the year to
// the variable
$year = date("Y"); 
  
// Display the year
echo $year;?> CAUSE EFFECT SMART BAR</div>
             
        </div>         
       
    </div>

      <div class="modal-footer bg-dark border-dark mb-3">
      <button type="button" class="btn btn-secondary text-white " data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        
        <!-- CHECKLIST TO ORDER  -->
        <div class="modal fade pt-5 mt-2" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header modal-header1 bg-secondary text-white border-dark p-2 ">
        <h5 class="modal-title" id="exampleModalLabel">Checklist to order</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-white" >
<!-- CRUD ITEM -->
  <main>

            <div class="container text-center text-muted">
                
                <div class="justify-content-center">
                    <div class="py-2">
                    <div class="input-group mb-3" style="display: none;">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-id-badge text-white"></i></span>
                     <input type="text" autocomplete="on" class="form-control bg-light text-muted" name="item-id" placeholder="ID" aria-label="id" aria-describedby="basic-addon11">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-receipt text-white"></i></span>
                    <input type="text" class="form-control light text-muted " name="item-name" placeholder="Item Name" aria-label="item" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                     <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa-solid fa-file text-white"></i></span>
                    <input type="number" class="form-control light text-muted " name="to-buy" placeholder="Quantity to buy" aria-label="Request" aria-describedby="basic-addon1">
                    </div>
                    </div>
                    
                    <div class="d-flex btn-group-prep justify-content-center">
                        <button class="btn-success rounded btn-prep me-1" name="create"><i class="fa-solid fa-plus"></i></button>
                        <button class="btn-primary rounded btn-prep me-1" name="read"><i class="fa-solid fa-rotate"></i></button>
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
                            <th>Item Name</th>
                            <th>Buy</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                        <?php
                            if(isset($_POST['read'])){
                                $result = getData();
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
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['item_name']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['to_buy']?></td>
                                         <td ><i class="fas fa-edit btnedit" data-id="<?php echo $row['id']; ?>"></i></td>
                                     </tr>
                                     <?php 
                                    }
                                }
        
                        ?>
                    </tbody>
                </table>
            </div>
            
            </div>
            
                        </main>

    
</div>
      <div class="modal-footer bg-dark border-dark">
      <button type="button" class="btn btn-secondary text-white " data-bs-dismiss="modal">Close</button>
      <form action="opening.php" method="post" class="w-50">

        <button name="tobuy" type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
 
    </div>

  </div>
</div>

    <!-- DUTIES CHECKLIST MODAL -->
    <div class="modal fade pt-5 mt-2" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content  text-muted">
      <div class="modal-header p-2 modal-header1 bg-secondary text-white border-dark">
        <h5 class="modal-title" id="exampleModalLabel">Duties Checklist</h5>
        <button type="button" class="btn-close btn-sm bg-danger text-danger me-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-white" >
      <ul class="nav nav-tabs border-dark mb-3" id="myTab" role="tablist">
        <li class="nav-item"  role="presentation">
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
           
            <!-- bootstrap table -->     
            <div class=" table-data py-2 ">
            
              <form id="form" action="opening.php" method="POST" >

  <table class="table table-striped table-dark ">
                <thead class="thead-dark text-muted">
                    <tr>
                        <th>Priority</th>
                        <th>Duty</th>
                        <th>Completion</th>
                    </tr>
                </thead>
                <tbody id="tbody">  
  
                    <?php
                      $result = get_Data();
                       if($result){
                         $i=0;
                        while($row = mysqli_fetch_assoc($result)){    
                          $i++;
                          $duty = $row['duty'];
                         
                          $id = $row['id'];
                    
                        ?>
                        <tr>    
                        <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                       
                                       echo $row['id'];
                                    ?></td>
                                    <td ><?php 
                                      
                                        echo $i;
                                    ?></td>
                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['duty']?></td>
                         <td>
                            <div class="pretty p-icon p-toggle p-plain">
                            <input type="checkbox" name="ch_<?php echo $i; ?>" value="">
                         <input type="hidden" name="chfield_<?php echo $i; ?>" value="0">
                         <div class="state p-on "> 
                                        <i class="fa-solid fa-square-check"></i>
                                        <label class="text-success fw-bolder ps-1">Done</label>
                                     </div> 
                                     <div class="state p-off">
                                        <i class="icon mdi mdi-wifi bg-danger"></i>
                                        <label class="text-danger fw-bolder text-danger">Not Done</label>
                                    </div>  
                            </div>
                        
                         </td>
           
                     </tr>
                     <?php
                         if(isset($_POST['bart_duties']) > 0){
                      if(!isset($_POST['ch_'.$i])){
                        $sql="UPDATE bartender SET complete = 'Not Done' WHERE id = '$id'";
                    } else {
                        $sql="UPDATE bartender SET complete = 'Done' WHERE id = '$id'";
                    } 
              
                     $result7=$conn->query($sql);
                } 
                     ?>
                 
                     <?php  
                      }
                  
                    }
                        ?>
                    
                </tbody>
            </table>
            <input type="hidden" name="boxcount" value="<?php echo $i; ?>">
            <button type="submit" name="bart_duties" class="btn btn-light"><span class="text-muted fw-bold">Save</span> </button> 
</form> 


            </div>
      
        </div>
        <div class="tab tab-pane fade" id="profile"
        role="tabpanel"
        aria-labelledby="profile-tab"
        >
        <!-- BAR BACK DUTIES -->
          <!-- bootstrap table -->     
          <div class=" table-data py-2 ">
            
            <form id="form" action="opening.php" method="POST" >

<table class="table table-striped table-dark ">
              <thead class="thead-dark text-muted">
                  <tr>
                      <th>Priority</th>
                      <th>Duty</th>
                      <th>Completion</th>
                  </tr>
              </thead>
              <tbody id="tbody">  

                  <?php
                    $result = getData_();
                     if($result){
                       $i=0;
                      while($row = mysqli_fetch_assoc($result)){    
                        $i++;
                        $duty = $row['duty'];
                       
                        $id = $row['id'];
                  
                      ?>
                      <tr>    
                      <td style="display: none;" data-id="<?php echo $row['id']; ?>"><?php 
                                     
                                     echo $row['id'];
                                  ?></td>
                                  <td ><?php 
                                    
                                      echo $i;
                                  ?></td>
                       <td data-id="<?php echo $row['id']; ?>"><?php echo $row['duty']?></td>
                       <td>
                          <div class="pretty p-icon p-toggle p-plain">
                          <input type="checkbox" name="ch_<?php echo $i; ?>" value="">
                       <input type="hidden" name="chfield_<?php echo $i; ?>" value="0">
                       <div class="state p-on "> 
                                      <i class="fa-solid fa-square-check"></i>
                                      <label class="text-success fw-bolder ps-1">Done</label>
                                   </div> 
                                   <div class="state p-off">
                                      <i class="icon mdi mdi-wifi bg-danger"></i>
                                      <label class="text-danger fw-bolder text-danger">Not Done</label>
                                  </div>  
                          </div>
                      
                       </td>
         
                   </tr>
                   <?php
                       if(isset($_POST['barbackduties']) > 0){
                    if(!isset($_POST['ch_'.$i])){
                      $sql="UPDATE barback SET complete = 'Not Done' WHERE id = '$id'";
                  } else {
                      $sql="UPDATE barback SET complete = 'Done' WHERE id = '$id'";
                  } 
            
                   $result7=$conn->query($sql);
              } 
                   ?>
               
                   <?php  
                    }
                
                  }
                      ?>
                  
              </tbody>
          </table>
          <input type="hidden" name="boxcount" value="<?php echo $i; ?>">
          <button name="barbackduties" type="submit" class="btn btn-light"><span class="text-muted fw-bold">Save</span> </button> 
</form> 


          </div>

        </div>
     </div>    

      </div>
   
 
        <!-- <form action="opening.php" method="$_POST"> -->
      <div class="modal-footer bg-dark border-dark">
      <button type="button" class="btn btn-secondary text-white " data-bs-dismiss="modal">Close</button>
      
        <!-- <button name="dutytime" type="submit" class="btn btn-primary">Submit</button>
      </form>  -->
      <form action="opening.php" method="post">

<button name="dutytime" type="submit" class="btn btn-primary">Submit</button>
</form>     
      </div>
    </div> 
 
  </div>
</div>



        <!-- OPENING PROCEDURE PAGE -->

            <div class="container modal-container text-center text-muted">
            <div class="jumbotron bg-dark ">
                <div class="card bg-dark">
                     <h2 class="py-2 text-light bg-dark text-muted rounded " ><i class="fa-solid fa-calendar-check display-5"></i> Opening Procedure</h2>
                </div>
                <div class="card bg-dark">
                    <div class="card-body ">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary fw-bold " data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-people-group"></i>
                    Team On Shift
                    </button>
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
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <!-- <script src="main22.js"></script> -->
            <script src="main2.js"></script>
            <script>
            //   $(document).ready(function(){
            //    $('#text').autosize();
            //   });
            // </script>
            <script type="text/javascript">
        $('#text').on('input', function () {
            // this.style.height = 'auto';
              
            this.style.height = 
                    (this.scrollHeight) + 'px';
                    $('#text').autosize();
        });
    </script>

    </body>
</html>


