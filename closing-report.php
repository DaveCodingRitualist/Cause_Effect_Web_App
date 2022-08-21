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
       
        $sql = "UPDATE end_over_day_night SET anchor_name='$anchorname', text_area='$text', updated_at='$date';";
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
    $sql = "SELECT * FROM bartender_night";

    $result = mysqli_query($GLOBALS['conn'], $sql);


    if(mysqli_num_rows($result) > 0){
        return $result;
    }

}
function getData_(){
    $sql = "SELECT * FROM barback_night";

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
    // CLOSING PROCEDURE OPERATIONS

    // SAVE TEAM ON SHFT

    if(isset($_POST['saveteamnight'])){
    $manageronduty = textboxValue(value:"manager-on-duty");
    $anchoronduty = textboxValue(value:"anchor-on-duty");
    $stationone = textboxValue(value:"station-one");
    $stationtwo = textboxValue(value:"station-two");
    $stationthree = textboxValue(value:"station-three");
    $sculler = textboxValue(value:"sculler");
    $barbackonduty = textboxValue(value:"bar-back-on-duty");
    $date = date('Y/m/d H:i:s'); 
    if($manageronduty && $anchoronduty && $stationone && $stationtwo && $stationthree && $sculler && $barbackonduty){
        
        $sql = "UPDATE team_night SET manager_on_duty='$manageronduty', anchor_on='$anchoronduty', station_one='$stationone',  station_two='$stationtwo',  station_three='$stationthree',  sculler='$sculler', bar_back='$barbackonduty';";
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

    //  TEAM NIGHT ARRAY
     //make sql
     $sql56 = "SELECT * FROM team_night";
        
     //get the query result
     $result56 = mysqli_query($conn, $sql56);
 
     //fetch result in array format
     $teamnight = mysqli_fetch_assoc($result56);

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
            
      $sql = "UPDATE duty_time_night SET updated_at='$date';";
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




      $sql77 = "SELECT * FROM end_over_day_night";
            
      //get the query result
      $result77 = mysqli_query($conn, $sql77);
    
     //fetch result in array format
      $endoverday = mysqli_fetch_assoc($result77);
      


      $sql17 = "SELECT * FROM duty_time_night";
            
      //get the query result
      $result17 = mysqli_query($conn, $sql17);
    
     //fetch result in array format
      $duty = mysqli_fetch_assoc($result17);
      

// SAVE FLOAT CLOSE 

if(isset($_POST['floatopennight'])){
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
        
        $sql2 = "INSERT INTO float_open_night(updated_at) VALUES('$date')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Data Succefully Inserted...!");
            
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }
    
    }
    $sql3 = "SELECT * FROM float_open_night";
        
    //get the query result
    $result3 = mysqli_query($conn, $sql3);

    //fetch result in array format
    $floatopennight = mysqli_fetch_assoc($result3);




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
        
        $sql = "UPDATE float_close_night SET two_hundred='$twohundred', one_hundred='$onehundred', fifty_='$fifty', twenty_='$twenty', ten_='$ten', five_='$five', two_='$two', one_='$one', fifty_cent='$fiftycent';";
        
        $sql2 = "INSERT INTO float_close_night(updated_at) VALUES('$date')";
        if(mysqli_query($GLOBALS['conn'],$sql)){
            TextNode(classname: "success", msg: "Data Succefully Inserted...!");
            
        }else{
            echo "Error";
        }
        
    }else{
        TextNode(classname: "error", msg: "Provide Data in the Textbox");
    }
    
    }
    $sql33 = "SELECT * FROM float_close_night";
        
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
        <title>Manager Report</title>
       
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="print.css" type="text/css" media="print">
        
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
            margin: auto;
            font-family: 'Open Sans Condensed', sans-serif;
          
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
            border:  dashed 3px;
            border-left: none;
            border-top: dashed 1px;
            border-bottom: dashed 1px;
            border-right: none;
           
           
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
           @media(min-width: 820px){
            .section{
            width: 40vw;
            height: 100vh;
            margin: auto;
            font-family: 'Open Sans Condensed', sans-serif;
          
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
	
    </style>
    <?php include('template/admin-header.php');?>
        <main class="pt-3 mt-5 section mb-5 pb-5">
            <div class="container text-center text-muted manager-report" >
            <div class="rounded text-muted bg-light" style="margin-bottom: 500px;">
        <div class="report-header report-group py-3">
           <img src="./assets/C _ E _ Responsive Logo _ Black New Tagline _ Low.png" style="width: 70%;" alt="causem effect logo" class="ce_logo">
        </div>
        <h4 class=" fw-bold text-center" > Closing Procedure Report </h4>
                       <!-- TEAM ON SHIFT REPORT -->
                       <div class="report-group pt-1">
                     
                     <div class="update-container border-secondary">
                     <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($teamnight['updated_at'])?></h6>  
                   </div>
                   
                     </div>
                     <h5 class="report-title fw-bold text-center" >Team on shift</h5>
                     <div class="team-section report-section">
                      <div class="team-position">
                        <h6 class="">MOD:</h6>
                        <h6 class="">Anchor:</h6>
                        <h6 class="">station One:</h6>
                        <h6 class="">station Two:</h6>
                        <h6 class="">station Threee:</h6>
                        <h6 class="">Bar Back(s):</h6>
                        <h6 class="">Sculler:</h6>
                    </div>
                      <div class="team-name">
                        <h6><?php echo htmlspecialchars($teamnight['manager_on_duty'])?> </h6>
                        <h6><?php echo htmlspecialchars($teamnight['anchor_on'])?></h6> 
                        <h6><?php echo htmlspecialchars($teamnight['station_one'])?></h6> 
                        <h6><?php echo htmlspecialchars($teamnight['station_two'])?></h6> 
                        <h6><?php echo htmlspecialchars($teamnight['station_three'])?></h6> 
                        <h6><?php echo htmlspecialchars($teamnight['bar_back'])?></h6>
                        <h6><?php echo htmlspecialchars($teamnight['sculler'])?></h6>
                      </div> 
                     </div>
                     'lkn
                </div>
             
                <!-- FLOAT OPEN REPORT -->
                <div class="report-group pt-1">
                <div class="update-container border-secondary">
                     <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($floatopennight['updated_at'])?></h6>  
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
      <td><?php echo $floatopennight['two_hundred'];?></td>
      <td><?php echo $total1 = $floatopennight['two_hundred'] * 200;?></td>
    </tr>
    <tr>
      <th scope="row">100</th>
      <td><?php echo $floatopennight['one_hundred'];?></td>
      <td><?php echo $total2 = $floatopennight['one_hundred'] * 100;?></td>
    </tr>
    <tr>
      <th scope="row">50</th>
      <td><?php echo $floatopennight['fifty_'];?></td>
      <td><?php echo $total3 = $floatopennight['fifty_']*50;?></td>
    </tr>
    <tr>
      <th scope="row">20</th>
      <td><?php echo $floatopennight['twenty_'];?></td>
      <td><?php echo $total4 = $floatopennight['twenty_']*20;?></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td><?php echo $floatopennight['ten_']?></td>
      <td><?php echo $total5 = $floatopennight['ten_']*10;?></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><?php echo $floatopennight['five_']?></td>
      <td><?php echo $total6 = $floatopennight['five_']*5;?></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><?php echo $floatopennight['two_']?></td>
      <td><?php echo $total7 = $floatopennight['two_']*2?></td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $floatopennight['one_']?></td>
      <td><?php echo $total8 = $floatopennight['one_']?></td>
    </tr>
    <tr>
      <th scope="row">50c</th>
      <td><?php echo $floatopennight['fifty_cent']?></td>
      <td><?php echo $total9 = $floatopennight['fifty_cent'] / 2?></td>
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
                    <h6 class="">Updated at: <?php echo htmlspecialchars($floatclose['updated_at'])?></h6>  
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
                    
                <div class="text-center">
                     <button onclick="window.print();" id="print-btn" class="btn-danger ps-3 pe-3 btn-md fw-bold rounded">Print</button>
                </div>
               
                
                <div class="text-center text-muted py-2 copy-right mb-3">&copy;<?php // Store the year to
// the variable
$year = date("Y"); 
  
// Display the year
echo $year;?> CAUSE EFFECT SMART BAR</div>
             
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
