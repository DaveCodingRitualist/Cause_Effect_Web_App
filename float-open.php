<?php

use LDAP\Result;

session_start();
//connection
include('config/db_connect.php');

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

// SAVE TEAM ON SHFT

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
        
    //     $sql = "UPDATE float_open SET 
    //      two_hundred='$twohundred',
    //      one_hundred='$onehundred',
    //      fifty_='$fifty',
    //      twenty_='$twenty',
    //      ten_='$ten',
    //      five_='$five',
    //      two_='$two',
    //      one_='$one',
    //     fifty_cent='$fiftycent',
    // //  ;";
        $sql = "INSERT INTO float_open(two_hundred,one_hundred,fifty_,twenty_,ten_,five_,two_,one_,fifty_cent) VALUES('$twohundred','$onehundred','$fifty'$twenty''$ten','$five','$two','$one','$fiftycent')";
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
     //make sql
     $sql = "SELECT * FROM float_open";
        
     //get the query result
     $result = mysqli_query($conn, $sql);
 
     //fetch result in array format
     $notes = mysqli_fetch_assoc($result);
 
    

?>