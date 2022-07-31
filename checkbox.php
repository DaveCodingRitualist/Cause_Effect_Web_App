<!-- <?php
include('config/db_connect.php');
function get_Data(){
    $sql = "SELECT * FROM switch";

    $result = mysqli_query($GLOBALS['conn'], $sql);


    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}
if(isset($_POST['submit']) > 0){
  
    if (isset($_POST['checkbox1'])) {
        $sql1="UPDATE switch SET status = 'Done' WHERE id = 1";
      
    } else {
        $sql1="UPDATE switch SET status = 'Not Done' WHERE id = 1";
       
    }
    $result=$conn->query($sql1);

    if (isset($_POST['checkbox2'])) {
        $sql2="UPDATE switch SET status = 'Done' WHERE id = 2";
    } else {
        $sql2="UPDATE switch SET status = 'Not Done' WHERE id = 2";
    }
    $result=$conn->query($sql2);

    if (isset($_POST['checkbox3'])) {
        $sql3="UPDATE switch SET status = 'Done' WHERE id = 3";
    } else {
        $sql3="UPDATE switch SET status = 'Not Done' WHERE id = 3";
    }
    $result=$conn->query($sql3);

    if (isset($_POST['checkbox4'])) {
        $sql4="UPDATE switch SET status = 'Done' WHERE id = 4";
    } else {
        $sql4="UPDATE switch SET status = 'Not Done' WHERE id = 4";
    }
    $result=$conn->query($sql4);
  }  
    // if(isset($_POST['submitduties']) > 0){
    //     for($j=1; $j<= $_POST['boxcount']; $j++){
    //         if(!isset($_POST['ch_'.$j])){
    //             $sql="UPDATE switch SET status = 'Not Done' WHERE id = '$j'";
    //         } else {
    //             $sql="UPDATE switch SET status = 'Done' WHERE id = '$j'";
    //         } 
      
    // $result=$conn->query($sql);    
    //     }
    // } 
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form id="form" action="checkbox.php" method="POST" >

        <label>
            Checkbox 1
            <input type="checkbox" name="checkbox1" value="DONE" <?php if(isset($_POST['checkbox1'])) { echo 'checked="checked"'; } ?>>
        </label>
<br>
        <label>
            Checkbox 2
            <input type="checkbox" name="checkbox2" value="DONE" <?php if(isset($_POST['checkbox2'])) { echo 'checked="checked"'; } ?>>
        </label>
<br>
        <label>
            Checkbox 3
            <input type="checkbox" name="checkbox3" value="DONE" <?php if(isset($_POST['checkbox3'])) { echo 'checked="checked"'; } ?>>
        </label>
<br>
        <label>
            Checkbox 4
            <input type="checkbox" name="checkbox4" value="DONE" <?php if(isset($_POST['checkbox4'])) { echo 'checked="checked"'; } ?>>
        </label> 
        <br>
        <button name="submit" type="submit">SUBMIT</button>
    </form>
    <form id="form" action="checkbox.php" method="POST" >

    <table class="table table-striped table-dark">
                    <thead class="thead-dark text-muted">
                        <tr>
                            <th>Priority</th>
                            <th>Duty</th>
                            <th>Completion</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">  
                 
                        <>
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
                                <input type="checkbox" name="ch_<?php echo $i; ?>" value="">
                             <input type="hidden" name="chfield_<?php echo $i; ?>" value="0">
                            
                             </td>
               
                         </tr>
                         <?php
                             if(isset($_POST['submitduties']) > 0){
                          if(!isset($_POST['ch_'.$i])){
                            $sql="UPDATE switch SET status = 'Not Done' WHERE id = '$id'";
                        } else {
                            $sql="UPDATE switch SET status = 'Done' WHERE id = '$id'";
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
                <button name="submitduties" type="submit">SUBMIT DUTIES</button>
    </form>       
</body>
</html> -->