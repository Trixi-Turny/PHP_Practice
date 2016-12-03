
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
  $formSubmitted = false;
  $errors= true;
      $errors = array();
    $clean = array();

  if(isset($_POST['submit'])){
    $formSubmitted = true ;
    // checkUserName($username);
    // checkEmail($email);
    // checkFormat($format);
    // checkBox($confirmBox);
  }

    function checkUserName($username){   
      if(isset($_POST["fullName"])){
        // echo $_POST["fullName"];
         $trimmed =rtrim(ltrim($_POST["fullName"]));
          if(ctype_alpha(str_replace(" ", "", $trimmed)) && strpos($trimmed, " ")!==false && strlen($trimmed)<=150){
          $validUsername = displayValue($trimmed, "fullName");
          return $validUsername ;
          
          // return displayValue($trimmed, "fullName");
        }
        else if(!(ctype_alpha($trimmed))){
          $errorMessage = "<p>The name you entered contains invalid characters.</p>";
          saveError($errorMessage, "fullName");


          $classUserName = "error";
          // $errors["fullName"] = $errorMessage;
    
          return false;
        }
        else if(!(strpos($trimmed, " ")!==false)){
          $errorMessage = "<p>Your full name should contain at least one space</p>";
           saveError($errorMessage, "fullName");
           $classUserName = "error";
      
          return false;
        }
        else {
          $errorMessage = "<p>Your full name should not exceed 150 characters./p>";
          saveError($errorMessage, "fullName");
          $classUserName = "error";

          return false;
        }
      }
    } 

  function displayValue($trimmed, $key){
     $html = htmlentities($trimmed);
     $clean[$key]=$trimmed;
     return $clean[$key];

  }
  function saveError($error, $key){
    echo "saving error for".$key;
    $html = htmlentities($error);
    $errors[$key] = $html ;
    echo $errors[$key];
    print_r($errors);

  }

  function checkEmail($email){
  if(isset($_POST["submit"])){
    if(isset($_POST["email"])){
      $trimmed = trim($_POST["email"]);
      if(filter_var($trimmed, FILTER_VALIDATE_EMAIL)&& $trimmed!==""){
        $validEmail  = displayValue($trimmed, "email");
        return $validEmail ;
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
      $trimmed = trim($_POST["mailFormat"]);
      if($trimmed="html" ){
        $format = $trimmed;
        displayValue($trimmed, "mailFormat");
        return true ;

      }else if( $trimmed=="plain"){
          $trimmed = "plain";
          $format = $trimmed;
          displayValue($trimmed, "mailFormat");
          return true;
         }
      else{
          $errorMessage = "<p>The format you selected is invalid.</p>";
          saveError($errorMessage, "mailFormat");
          return false;
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


  function setClass($errors, $key){
   $found =  isset($errors[$key]) ? "error" : ''; //http://stackoverflow.com/questions/24760004/check-if-associative-array-contains-value-and-retrieve-key-position-in-array
     echo $found ;

  
}

  // function isItSet($array, $key){
  //   if (isset($array['$key'])){
  //     return true;
  //   }
  //   else {
  //     echo $errors['fullName'];
  //     return   false ;
  //   }
  // }



    if(isset($_POST['submit'])){
      $submittedUserName = checkUserName($username) ;
      $submittedEmail = checkEmail($email);
      // echo"errorClass".$errorClass ;
     

    }
    
  foreach($_POST as $key => $dataitem){
      if(isset($_POST[$key])){
        echo "<p>".$key." : ".htmlentities($dataitem)."</p>";
        echo "errors".$errors[$key];
        echo "clean".$clean[$key];

      }else{
        echo "<p>Field".$key."not submitted</p>";

      }
    }
      // if(isset($_POST['submit'])){
      //   foreach($errors as $key => $dataitem){
      //     echo "<p>errors".$key." : ".htmlentities($dataitem)."</p>";
      //   }
      //   foreach($clean as $key => $dataitem){
      //     echo "<p>clean data:".$key." : ".htmlentities($dataitem)."</p>";
      //   }
      // }

?>

  
        <form action='<?php echo $self; ?>' method='POST'>
            <fieldset>
			<legend>Sign Up</legend>
                <div>

      

                    <label for='fullName'>*Full Name</label>
                    <input  class='<?php echo  $classUserName;?>' value ="<?php echo  $submittedUserName ;?> " type='text' name='fullName' id='fullName' required/>
                </div>
          

                <div class="<?php echo $classUserName; ?>">Errors Here: <?php $userNameError; ?></div>
              
                <div>
                    <label for='email'>*Email</label>
                    <input  class  = "<?php ?>" value = '<?php echo $submittedEmail; ?>' type='text' name='email' id='email' required />
                </div>  
                <div>
                    <label for='mailFormat'>Mail format</label>
                    <select name='mailFormat' id='mailFormat' >
                        <option value='plain' selected = <?php checkFormat($mailFormat); ?> >Plain text</option>
                        <option value='html' selected = <?php checkFormat($mailFormat); ?>  >HTML</option>
                    </select>
                </div>
                <div>
                    <input  type='checkbox' name='confirmBox' id='confirmBox'  <?php ?> />
                    <label for='confirmBox'>*Tick this box to confirm you have read our <a href='#'>terms and conditions</a></label>
                </div>
                <div>
                    <input type='submit' name='submit' value='Send' />
                </div>
            </fieldset>
        </form>
    </body>
</html>




