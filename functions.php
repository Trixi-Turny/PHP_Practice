


<?php
    $errors = array();
    $clean = array();
    foreach($_POST as $key => $dataitem){
      if(isset($_POST[$key])){
        echo "<p>".$key." : ".htmlentities($dataitem)."</p>";

      }else{
        echo "<p>Field".$key."not submitted</p>";

      }
    }
  $username = $_POST['fullName'];
  $email = $_POST['email'];
  $mailFormat = $_POST['mailFormat'];
  $confirmBox = $_POST['confirmBox'];
  $checkedBox = false ;

if( isset($_POST["submit"])){
  checkEmail($email);
  checkUserName($username);
  checkEmail($email);
  checkFormat($mailFormat);
  checkBox($confirmBox);
}



  function checkUserName($username){
  if( isset($_POST["submit"])){   
    if(isset($_POST["fullName"])){
      // echo $_POST["fullName"];
       $trimmed =rtrim(ltrim($_POST["fullName"]));
      if(ctype_alpha(str_replace(" ", "", $trimmed)) && strpos($trimmed, " ")!==false && strlen($trimmed)<=150){
        displayValue($trimmed, "fullName");
        return true ;
      }
      else if(!(ctype_alpha($html))){
        $errorMessage = "<p>The name you entered contains invalid characters.</p>";
        saveError($errorMessage, "fullName");
        // $errors["fullName"] = $errorMessage;
        return false;
      }
      else if(!(strpos($trimmed, " ")!==false)){
        $errorMessage = "<p>Your full name should contain at least one space</p>";
         saveError($errorMessage, "fullName");
        return false;
      }
      else {
        $errorMessage = "<p>Your full name should not exceed 150 characters./p>";
        saveError($errorMessage, "fullName");
        return false;
      }
    }
  }
}

function displayValue($trimmed, $key){
  echo "displayValue is being called";
   $html = htmlentities($trimmed);
   $clean[$key]= $html;
   echo $clean[$key];
   // echo $clean[$key];
  }
function saveError($error, $key){
  echo "saveError is being called";
  $html = htmlentities($error);
  $errors[$key] = $html ;
  echo $errors[$key];
  // echo $errors[$key];
}

function checkEmail($email){

  if(isset($_POST["email"])){
    $trimmed = trim($_POST["email"]);
    if(filter_var($email, FILTER_VALIDATE_EMAIL)&& $email!==""){
        displayValue($trimmed, "email");
        return true;
    }
    else{
        $errorMessage = "<p>Please enter a valid email address.</p>";
        saveError($errorMessage, "email");
        return false;
    }
  }
}

function checkFormat($mailFormat){
   if(isset($_POST["mailFormat"])){
    $trimmed = trim($_POST["mailFormat"]);
    if($mailFormat=="HTML" || $mailFormat=="Plain text"){
        // $html = htmlentities($mailFormat);
        displayValue($trimmed, "mailFormat");
       }
    else{
        $errorMessage = "<p>The format you selected is invalid.</p>";
        saveError($errorMessage, "mailFormat");
        return false;
    }
  }
}
  
function checkBox($confirmBox){
 if(isset($_POST['submit'])){ 
    $form_submitted = true;
    if(isset($_POST["confirmBox"])){ 
       $trimmed = "checked";
        // $checkedBox = true ;
       displayValue($trimmed, $confirmBox);
        // displayValue($trimmed, "confirmBox");
        return true;
    }
    else {
        $errorMessage = "<p>Please confirm you agree to our Terms and Conditions</p>";
        saveError($errorMessage, "confirmBox");
      return false ;
    }
  }
}

function setClass($key){
  if(isset($clean[$key])){
   return "error" ;
  }
  else {
    return "Hi";
  }
}

   // $form_submitted = false ;
   // $errors_in_form = false ;
   // if(isset($_POST['submit'])){
   //  echo "form has been submitted";
   //  print_r( "trueOrFalse:  ".checkUserName($username)); 
   //  print_r( $errors);  
   //   // return checked;
   //   }
   //   else {
   //     $fullName= $error['fullName'];
   //   }
   //  // checkEmail($email);
   //  // if(isset($clean["email"])){
   //  //   $email = $clean['email'];
   //  // }
   //  // else {
   //  //    $email = $error['email'];
   //  // }
   //  // echo $fullName ;

   ?>

