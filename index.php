
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
    <head>
        <title>Sign Up to our Mailing List!</title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <link href='css/style.css' rel='stylesheet'>
    </head>
    <body>
        <h1>Sign Up to Our Mailing List!</h1>
        <?php
          $self = htmlentities($_SERVER['PHP_SELF']);

         ?>
        <form action='<?php echo $self; ?>' method='POST'>
            <fieldset>
			<legend>Sign Up</legend>
                <div>

                <?php
                  if(formSubmitted){
                     $cleanData = htmlentities($clean['fullName']);
                    

                  }
                  ?>

                    <label for='fullName'>*Full Name</label>
                    <input  class='<?php echo setClass('fullName');?>' value ="<?php echo  $cleanData ;?> " type='text' name='fullName' id='fullName' required/>
                </div>
                <?php

                  if(formSubmitted){
                     $error = isItSet($errors, 'fullName');

                   } else{
 
                        $error = "bla";
                   }


                 echo "<div class='errorMessage'>Errors Here:".$error."</div>";?>
              
                <div>
                    <label for='email'>*Email</label>
                    <input value = '<?php checkEmail($email); ?>' type='text' name='email' id='email' required />
                </div>  
                <div>
                    <label for='mailFormat'>Mail format</label>
                    <select name='mailFormat' id='mailFormat' >
                        <option value='plain' selected = <?php checkFormat($mailFormat); ?> >Plain text</option>
                        <option value='html' selected = <?php checkFormat($mailFormat); ?>  >HTML</option>
                    </select>
                </div>
                <div>
                    <input  type='checkbox' name='confirmBox' id='confirmBox'  <?php  checkBox($confirmBox)?> />
                    <label for='confirmBox'>*Tick this box to confirm you have read our <a href='#'>terms and conditions</a></label>
                </div>
                <div>
                    <input type='submit' name='submit' value='Send' />
                </div>
            </fieldset>
        </form>
    </body>
</html>

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
$formSubmitted = false;

if(isset($_POST['submit'])){
  $formSubmitted = true ;
  checkUserName($username);
  checkEmail($email);
  checkFormat($format);
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
      else if(!(ctype_alpha($trimmed))){
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
   $html = htmlentities($trimmed);
   $clean[$key]=$trimmed;
   // echo $clean[$key];
}
function saveError($error, $key){
  $html = htmlentities($error);
  $errors[$key] = $html ;
}

function checkEmail($email){
if(isset($_POST["submit"])){
  if(isset($_POST["email"])){
    $trimmed = trim($_POST["email"]);
    if(filter_var($trimmed, FILTER_VALIDATE_EMAIL)&& $trimmed!==""){
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

}

function checkFormat($mailFormat){
   if(isset($_POST["mailFormat"])){
    $trimmed = trim($_POST["mailFormat"]);
    if($trimmed="html" ){
      $format = $trimmed;
      displayValue($trimmed, "mailFormat");

    }else if( $trimmed=="plain"){
        $trimmed = "plain";
        $format = $trimmed;
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


function setClass($key){
  if(isset($errors[$key])){
   return "error" ;
  }
  else {
    return "Hi";
  }
}

function isItSet($array, $key){
  if (isset($array['$key'])){
    return $array['key'];
  }
  else {
    return   "";
}
}




   ?>


