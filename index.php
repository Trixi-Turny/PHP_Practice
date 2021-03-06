
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

  $formSubmitted = false;
  $errors = array();
  $clean = array();
  $errorDivFullName = "";
  $errorDivEmail = "" ;
  $errorDivFormat = "" ;
  $errorDivCheckBox = "" ;
  $submittedUserName = "";
  $submittedEmail = "" ;
  $errorEmail = "";
  $errorFormat = "" ;
  $errorConfirmBox = "";
  $inputClassFullName = "";
  $inputClassEmail = "";
  $inputClassCheckBox  = "";

  
  function checkUserName($username){  
    global $clean, $errors, $errorFullName, $errorDivFullName, $inputClassFullName; 

    if(isset($_POST["fullName"])){
       $trimmed =rtrim(ltrim($_POST["fullName"]));
        if(ctype_alpha(str_replace(" ", "", $trimmed)) && strpos($trimmed, " ")!==false && strlen($trimmed)<=150){
        $validUsername = saveValidEntry($clean, $trimmed, "fullName");
        return $validUsername ;
      }
      else if(!(ctype_alpha($trimmed))){
        $errorMessage = "The name you entered contains invalid characters.";
        $errorFullName = saveError($errors, $errorMessage, "fullName");
        $errorDivFullName = generateDiv($errorFullName, "fullName");
        $inputClassFullName = setClass($errors, "fullName");
        return htmlentities($trimmed);
      }
      else if(!(strpos($trimmed, " ")!==false)){
        $errorMessage = "Your full name should contain at least one space";
         $errorFullName = saveError($errors, $errorMessage, "fullName");
         $errorDivFullName = generateDiv($errorFullName, "fullName");
         $inputClassFullName = setClass($errors, "fullName");
         return htmlentities($trimmed);
      }
      else {
        $errorMessage = "Your full name should not exceed 150 characters";
        $errorFullName = saveError($errors, $errorMessage, "fullName");
        $errorDivFullName = generateDiv($errorFullName, "fullName");
        $inputClassFullName = setClass($errors, "fullName");
        return htmlentities($trimmed);
      }
    }
  } 

  function checkEmail($email){
    global $errors, $clean, $errorEmail, $errorDivEmail, $inputClassEmail;
    if(isset($_POST["submit"])){
      if(isset($_POST["email"])){
        $trimmed = trim($_POST["email"]);
        if(filter_var($trimmed, FILTER_VALIDATE_EMAIL)&& $trimmed!==""){
          $validEmail  = saveValidEntry($clean, $trimmed, "email");
          return $validEmail ;
        }
        else{
            $errorMessage = "Please enter a valid email address.";
           $errorEmail =  saveError($errors, $errorMessage, "email");
           $errorDivEmail = generateDiv($errorEmail, "email");
           $inputClassEmail = setClass($errors,"email");
          return htmlentities($trimmed);
        }
      }
    }
  }

  function checkFormat($mailFormat){
      global $errors, $clean, $errorFormat, $errorDivFormat;
      $trimmed = trim($_POST["mailFormat"]);
      if($trimmed=="html" ){
        $format = $trimmed;
        saveValidEntry($clean, $trimmed, "mailFormat");
        return htmlentities($trimmed);

      }else if( $trimmed=="plain"){
          $trimmed = "plain";
          $format = $trimmed;
          saveValidEntry($clean, $trimmed, "mailFormat");
         return htmlentities($trimmed);
         }
      else{
          $errorMessage = "The format you selected is invalid.";
           $errorFormat = saveError($errors, $errorMessage, "mailFormat");
           $errorDivEmail =generateDiv($errorFormat, "mailFormat");
          return htmlentities($trimmed);
      }
    }
    
  function checkBox($confirmBox){
    global $errors, $clean , $errorConfirmBox, $errorDivCheckBox, $inputClassCheckBox;
    if(isset($_POST["confirmBox"])){ 
       $trimmed = "checked";
       saveValidEntry($clean, $trimmed, "confirmBox");
       return htmlentities($trimmed);
    }
    else {
        $errorMessage = "Please confirm you agree to our Terms and Conditions.";
        $errorConfirmBox =  saveError($errors, $errorMessage, "confirmBox");
        $errorDivCheckBox = generateDiv($errorConfirmBox, "confirmBox");
        $inputClassCheckBox = setClass($errors, "confirmBox") ;
        return false;
    }
  }
  
  function saveValidEntry($clean, $trimmed, $key){
     global $errors, $clean ;
     $html = htmlentities($trimmed);
     $clean[$key]=$html;
     return $html;
  }

  function saveError($errors, $error, $key){
    global $errors, $clean ;
    $html = htmlentities($error);
    $errors[$key] = $html ;
    return $html ;
  }

  function setClass($errors, $key){
    global $errors;
    $found =  array_key_exists($key, $errors) ? "error" : '';
    if(empty($errors)){
     $found = "invisible" ; 
     }//http://stackoverflow.com/questions/24760004/check-if-associative-array-contains-value-and-retrieve-key-position-in-array
    return $found ;
 }

function generateDiv($error, $key){
  global $errors ;
  $errorDiv = "<div><p class = 'error'>".$error."</p></div>";
  return $errorDiv ;
}


  if(isset($_POST['submit'])){
    $username = $_POST['fullName'];
    $email = $_POST['email'];
    $mailFormat = $_POST['mailFormat'];
    $confirmBox = $_POST['confirmBox'];
    $formSubmitted = true;
    $submittedUserName = checkUserName($username) ;
    $submittedEmail = checkEmail($email);
    $submittedCheckBox = checkBox($confirmBox);
    $plainSeelected = (checkFormat($mailFormat)==="plain")? 'selected': "";
    $htmlSelected = (checkFormat($mailFormat)==="html")? 'selected': "";
    print_r($clean);
    print_r($errors);
      if (formSubmitted ==true && empty($errors)){
       echo "<h3>Thank You for submitting the form. Your details have been sent.</h3>";
       $invisible = setClass($errors, $key);
     }
}
  ?>

  <div class="<?php echo $invisible;?>">
        <form action='<?php echo $self; ?>' method='POST'>
            <fieldset>
                <legend>Sign Up</legend>

                <div class="column1">
                    <div>
                        <label for='fullName'>*Full Name</label>
                        <input class='<?php echo $inputClassFullName ;  ?>' value="<?php  echo  $submittedUserName ;?> " type='text' name='fullName' id='fullName' required/>
                    </div>
                </div>
                <div class="column2">
                    <?php echo $errorDivFullName ;?>
                </div>
                <div class="column1">
                    <div>
                        <label for='email'>*Email</label>
                        <input class='<?php echo $inputClassEmail;  ?>' value='<?php echo $submittedEmail; ?>' type='text' name='email' id='email' required />
                    </div>
                </div>
                <div class="column2">
                    <?php echo $errorDivEmail ;?>
                </div>
                <div class="column1">
                    <div>
                        <label for='mailFormat'>Mail format</label>
                        <select name='mailFormat' id='mailFormat'>
                            <option value='plain' <?php echo $plainSelected ?> >Plain text</option>
                            <option value='html' <?php echo $htmlSelected ?>>HTML</option>
                        </select>
                    </div>
                </div>
                <div class="column2">
                    <?php echo $errorDivFormat ;?>
                </div>
                <div class="column1">

                    <div class='<?php echo $inputClassCheckBox ;  ?>'>
                        <input class='<?php echo $inputClassCheckBox ;  ?>' type='checkbox' id='confirmBox' name='confirmBox' <?php echo $submittedCheckBox; ?> />
                    </div>

                    <label for='confirmBox'>*Tick this box to confirm you have read our <a href='#'>terms and conditions</a>
                    </label>
                </div>

                <div class="column2">
                    <?php echo $errorDivCheckBox ;?>
                </div>

                <div>
                    <input type='submit' name='submit' value='Send' />
                </div>
            </fieldset>
        </form>
    </div>

</body>

</html>