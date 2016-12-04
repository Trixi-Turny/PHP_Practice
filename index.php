
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
  $username = $_POST['fullName'];
  $email = $_POST['email'];
  $mailFormat = $_POST['mailFormat'];
  $confirmBox = $_POST['confirmBox'];
  $formSubmitted = false;
  $errors = array();
  $clean = array();
  $submittedUserName = "";
  $submittedEmail = "" ;
  $submittedCheckBox = "";
  $plainSeelected  =  "" ;
  $htmlSelected  = "";
  $errorFullName  = "";

  

  function checkUserName($username){  
    global $clean, $errors, $errorFullName;

    if(isset($_POST["fullName"])){
       $trimmed =rtrim(ltrim($_POST["fullName"]));
        if(ctype_alpha(str_replace(" ", "", $trimmed)) && strpos($trimmed, " ")!==false && strlen($trimmed)<=150){
        $validUsername = displayValue($clean, $trimmed, "fullName");
        return $validUsername ;
      }
      else if(!(ctype_alpha($trimmed))){
        $errorMessage = "<p>The name you entered contains invalid characters.</p>";
        $errorFullName = saveError($errors, $errorMessage, "fullName");
        echo "errorFullName".$errorFullName ;
        return false;
      }
      else if(!(strpos($trimmed, " ")!==false)){
        $errorMessage = "<p>Your full name should contain at least one space</p>";
         $errorFullName = saveError($errors, $errorMessage, "fullName");
         $classUserName = "error";
        return false;
      }
      else {
        $errorMessage = "<p>Your full name should not exceed 150 characters./p>";
        $errorFullName = saveError($errors, $errorMessage, "fullName");
        $classUserName = "error";
        return false;
      }
    }
  } 

  function displayValue($array, $trimmed, $key){
     $html = htmlentities($trimmed);
     $array[$key]=$trimmed;
     return $array[$key];
  }

  function saveError($array, $error, $key){
    $html = htmlentities($error);
    $array[$key] = $html ;
    return $html ;

  }

  function checkEmail($email, $clean, $errors){
    if(isset($_POST["submit"])){
      if(isset($_POST["email"])){
        $trimmed = trim($_POST["email"]);
        if(filter_var($trimmed, FILTER_VALIDATE_EMAIL)&& $trimmed!==""){
          $validEmail  = displayValue($clean, $trimmed, "email");
          return $validEmail ;
        }
        else{
            $errorMessage = "<p>Please enter a valid email address.</p>";
            saveError($errors, $errorMessage, "email");
            return false;
        }
      }
    }
  }

  function checkFormat($mailFormat, $clean, $errors){
      $trimmed = trim($_POST["mailFormat"]);
      if($trimmed=="html" ){
        $format = $trimmed;
        return displayValue($clean, $trimmed, "mailFormat");

      }else if( $trimmed=="plain"){
          $trimmed = "plain";
          $format = $trimmed;
         return  displayValue($clean, $trimmed, "mailFormat");
         }
      else{
          $errorMessage = "<p>The format you selected is invalid.</p>";
          saveError($errors, $errorMessage, "mailFormat");
          return false;
      }
    }
    
  function checkBox($confirmBox, $clean, $errors){
    if(isset($_POST["confirmBox"])){ 
       $trimmed = "checked";
       return  displayValue($clean, $trimmed, $confirmBox);
       return true;
    }
    else {
        $errorMessage = "<p>Please confirm you agree to our Terms and Conditions</p>";
        saveError($errors, $errorMessage, "confirmBox");
        return false ;
    }
  }

  function setClass($array, $key){
   $found =  isset($array[$key]) ? "error" : ''; //http://stackoverflow.com/questions/24760004/check-if-associative-array-contains-value-and-retrieve-key-position-in-array
    return $found ;
}

// function showErrorDiv($errors, $username, $clean){
//    $error = $errors[];

//    echo "showError".$error ;
//    $errorDiv = "<div class = 'error'>".$errors[0]."</div>";
//    return $errorDiv ;
// }


  if(isset($_POST['submit'])){
    $formSubmitted = true;
    $submittedUserName = checkUserName($username, $clean, $errors) ;
    $submittedEmail = checkEmail($email, $clean, $errors);
    $submittedCheckBox = checkBox($confirmBox, $clean, $errors);
    $plainSeelected = (checkFormat($mailFormat, $clean, $errors)==="plain")? 'selected': "";
    $htmlSelected = (checkFormat($mailFormat, $clean, $errors)==="html")? 'selected': "";
    $errorDiv  = "<div class = 'error'>".$errorFullName."</div>";
  }
    
  // foreach($_POST as $key => $dataitem){
  //     if(isset($_POST[$key])){
  //       echo "<p>".$key." : ".htmlentities($dataitem)."</p>";
  //       echo "errors".$errors[$key];
  //       echo "clean".$clean[$key];

  //     }else{
  //       echo "<p>Field".$key."not submitted</p>";

  //     }
  //   }


?>

        <form action='<?php echo $self; ?>' method='POST'>
            <fieldset>
			<legend>Sign Up</legend>
                <div>
                    <label for='fullName'>*Full Name</label>

                    <input  class='<?php ?>' value ="<?php  echo  $submittedUserName ;?> " type='text' name='fullName' id='fullName' required/>

                </div>
              
                <div>
                    <label for='email'>*Email</label>
                    <input  class  = "<?php ?>" value = '<?php echo $submittedEmail; ?>' type='text' name='email' id='email' required />
                </div>  
                <div>
                    <label for='mailFormat'>Mail format</label>
                    <select name='mailFormat' id='mailFormat' >
                        <option value='plain' <?php echo $plainSelected ?> >Plain text</option>
                        <option value='html' <?php echo $htmlSelected ?>>HTML</option>
                    </select>
                </div>
                <div>
                    <input  type='checkbox' name='confirmBox' id='confirmBox'  <?php echo $submittedCheckBox; ?> />
                    <label for='confirmBox'>*Tick this box to confirm you have read our <a href='#'>terms and conditions</a></label>
                </div>
                <div>
                    <input type='submit' name='submit' value='Send' />
                </div>
            </fieldset>
        </form>
          <?php echo $errorDiv;?>   
    </body>
</html>




