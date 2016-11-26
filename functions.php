


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

  function checkUserName($username){
  if(isset($_POST["fullName"])){
     $trimmed =rtrim(ltrim($_POST["fullName"]));
    if(ctype_alpha(str_replace(" ", "", $trimmed)) && strpos($trimmed, " ")!==false && strlen($trimmed)<=150){
      displayValue($trimmed, "fullName");
        return true ;
    }
    else if(!(ctype_alpha($html))){
      $errorMessage = "<p>The name you entered contains invalid characters.</p>";
      $error["fullName"] = $errorMessage;
      return false;
    }
    else if(!(strpos($trimmed, " ")!==false)){
      $errorMessage = "<p>Your full name should contain at least one space</p>";
      $error["fullName"] = $errorMessage;
      return false;
    }
    else {
      $errorMessage = "<p>Your full name should not exceed 150 characters./p>";
      $error["fullName"] = $errorMessage;
      return false;
    }
  }
}

function displayValue($trimmed, $string){
   $html = htmlentities($trimmed);
   $clean[$string]= $html;
   echo $clean[$string];
  }
  // if(checkEmail($email)){

  //   echo $clean["email"] ;


  // }
        function checkEmail($email){

          if(isset($_POST["email"])){
            $trimmed = $_POST["email"];
            if(filter_var($email, FILTER_VALIDATE_EMAIL)&& $email!==""){
                displayValue($trimmed, "email");
                return true;
            }
            else{
                return false;
            }
          }
        }

        function checkFormat($mailFormat){
           if(isset($_POST["mailFormat"])){
            $trimmed = $_POST["mailFormat"];
            if($mailFormat=="HTML" || $mailFormat=="Plain text"){
                $html = htmlentities($mailFormat);
                return "<p>".$html." is a valid selection</p>";
            }
            else{
                return "<p>That's an invalid selection</p>";
            }
          }
        }


//    $form_submitted = false ;
//    $errors_in_form = false ;
//    $username = $_POST['fullName'];
//    $email = $_POST['email'];
//    if(isset($_POST['submit'])){
//      $form_submitted = true ;
//      checkUserName($username);
//       echo "Is is set?".isset($clean["fullName"]);
//      if(isset($clean["fullName"])){
//       $fullName = $clean['fullName'];
//       print_r($clean);
//      }
//      else {
//        $fullName= $error['fullName'];
//      }
//     checkEmail($email);
//     if(isset($clean["email"])){
//       $email = $clean['email'];
//     }
//     else {
//        $email = $error['email'];
//     }
//     echo $fullName ;
// }

        // echo(checkUserName($username)["fullName"]);
        // echo checkEmail($email);
        // echo checkFormat($mailFormat);

   ?>

