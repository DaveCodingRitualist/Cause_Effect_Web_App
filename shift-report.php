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
$sql3 = "SELECT * FROM test";
        
//get the query result
$result3 = mysqli_query($conn, $sql3);

//fetch result in array format
$shiftreport = mysqli_fetch_assoc($result3);




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
           @media(min-width: 820px){
            .section{
            width: 40vw;
            height: 100vh;
            margin: auto;
            font-family: 'Open Sans Condensed', sans-serif;
          
           }
   
}

	
    </style>
    <?php include('template/admin-header.php');?>
        <main class="pt-3 mt-5 section mb-5 pb-5">
            <div class="container text-center text-muted manager-report" >
            <div class="rounded text-muted bg-light ">
        <div class="report-header report-group py-3">
           <img src="./assets/C _ E _ Responsive Logo _ Black New Tagline _ Low.png" style="width: 70%;" alt="causem effect logo" class="ce_logo">
        </div>
     
                <!-- TEAM ON SHIFT REPORT -->
                <div class="report-group pt-1">
                     
                     <div class="update-container border-secondary">
                     <div class="update-at ">
                    <h6 class="">Updated at: <?php echo htmlspecialchars($shiftreport['updated_at'])?></h6>  
                   </div>
                   
                     </div>
                     <h5 class="report-title fw-bold text-center" >Team on shift</h5>
                     <div class="team-section report-section">
                      <div class="team-position text-start">
                        <h6 class="">MOD:</h6>
                        <h6 class="">Floor:</h6>
                        <h6 class="">Bar:</h6>
                        <h6 class="">Kitchen:</h6>
                    </div>
                      <div class="team-name text-end">
                        <h6><?php echo htmlspecialchars($shiftreport['manager'])?> </h6>
                        <h6><?php echo htmlspecialchars($shiftreport['floors'])?></h6> 
                        <h6><?php echo htmlspecialchars($shiftreport['bar'])?></h6> 
                        <h6><?php echo htmlspecialchars($shiftreport['kitchen'])?></h6>
                      </div> 
                     </div>
                </div>
             
          
             
                             <!-- SERVICE REPORT -->
                             <div class="report-group endover pt-1 report-section">
                 
                     <h5 class="report-title fw-bold text-center" >Service</h5>
                     <div class="mb-1">
                     <p style=" word-wrap: break-word;"><?php echo htmlspecialchars($shiftreport['services'])?></p>
                     </div>
                </div>
                             <!-- 86 Item REPORT -->
                             <div class="report-group endover pt-1 report-section">
                 
                     <h5 class="report-title fw-bold text-center" >86 Items</h5>
                     <div class="mb-1">
                     <p style=" word-wrap: break-word;"><?php echo htmlspecialchars($shiftreport['services'])?></p>
                     </div>
                </div>
                             <!-- Breakages and  Spillage -->
                             <div class="report-group endover pt-1 report-section">
                 
                     <h5 class="report-title fw-bold text-center">Breakages and Spillage</h5>
                     <div class="mb-1">
                     <p style=" word-wrap: break-word;"><?php echo htmlspecialchars($shiftreport['services'])?></p>
                     </div>
                </div>
                
                <div class="text-center text-muted py-2 copy-right">&copy;<?php // Store the year to
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
