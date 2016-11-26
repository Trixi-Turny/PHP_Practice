

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Form processing page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <h1>Data from the form:</h1>

   <?php
   $errors = array();
   $fields = array();
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
              $trimmed = trim($_POST["fullName"]);
              if(ctype_alpha($trimmed) && strpos($trimmed, " ")!==false && strlen($trimmed<=150)){
                $html = htmlentities($trimmed);
                $fields["fullName"]=$html;
                echo "<p>You entered: ".$html."</p>";
                return $fields;
              }
              else if(!ctype_alpha($trimmed)){
                $errorMessage = "<p>The name you entered contains invalid characters.</p>";
                $error["fullName"] = $errorMessage;
                return $error;
              }
              else if(!strpos($trimmed, " ")!==false){
                $errorMessage = "<p>Your full name should contain at least one space</p>";
                $error["fullName"] = $errorMessage;
                return $error;
              }
              else{
                $errorMessage = "<p>Your full name should not exceed 150 characters./p>";
                $error["fullName"] = $errorMessage;
                return $error;
              }
            }
        }


        function checkEmail($email){
          if(isset($_POST["email"])){
            $trimmed = $_POST["email"];
            if(filter_var($email, FILTER_VALIDATE_EMAIL)&& $email!==""){
                $html = $htmlentities($email);
                return "<p>".$html." is a valid email.</p>";
            }
            else{
                return "<p>You entered an invalid email.</p>";
            }
          }
        }

        function checkFormat($mailFormat){
           if(isset($_POST["mailFormat"])){
            $trimmed = $_POST["mailFormat"];
            if($mailFormat=="HTML" || $mailFormat=="Plain text"){
                $html = $htmlentities($mailFormat);
                return "<p>".$html." is a valid selection</p>";
            }
            else{
                return "<p>That's an invalid selection</p>";
            }
          }
        }
        echo(checkUserName($username)["fullName"]);
        echo checkEmail($email);
        echo checkFormat($mailFormat);
   ?>
    </body>
</html>
