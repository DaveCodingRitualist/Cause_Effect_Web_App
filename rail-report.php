<?php

use LDAP\Result;

session_start();
//connection
include('config/db_connect.php');

//Get data from mysql data base
function getData(){
    $sql = "SELECT * FROM rail";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

$sql3 = "SELECT * FROM rail_time";
        
//get the query result
$result3 = mysqli_query($conn, $sql3);

//fetch result in array format
$railreport = mysqli_fetch_assoc($result3);






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
        <title>Rail | Count</title>
       
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
                    <h6 class="">Updated at: <?php echo htmlspecialchars($railreport['updated_at'])?></h6>  
                   </div>
                   
                     </div>
                     <h5 class="report-title fw-bold text-center" > Rail count Report</h5>
                     <div class="team-section report-section">
                     <table class="table table-striped justify-content-center">
                    <thead class="thead-dark text-muted">
                        <tr>
                            <th>Id</th>
                            <th>Item</th>
                            <th>M</th>
                            <th>T</th>
                            <th>W</th>
                            <th>T</th>
                            <th>F</th>
                            <th>S</th>
                            <th>S</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                        <?php
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
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['item']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['monday']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['tuesday']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['wednesday']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['thursday']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['friday']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['saturday']?></td>
                                         <td data-id="<?php echo $row['id']; ?>"><?php echo $row['sunday']?></td>
                                        
                                     </tr>
                                     <?php 
                                    }
                                }
                               
                        ?>
                    </tbody>
                </table>
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