<?php

use LDAP\Result;

session_start();
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
    $sql = "SELECT * FROM prep";

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


function deleteRecord(){
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
    $sql = "DELETE FROM prep";

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


?>
