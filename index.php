
<?php
  require_once "functions.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Sign Up to our Mailing List!</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1>Sign Up to Our Mailing List!</h1>
        <?php
          $self = htmlentities($_SERVER['PHP_SELF']);
         ?>
        <form action="<?php echo $self; ?>" method="POST">
            <fieldset>
			<legend>Sign Up</legend>
                <div>
                    <label for="fullName">*Full Name</label>
                    <input  class="<?php echo setClass('fullName');?>" value = "<?php  $clean['fullName'] ?>" type="text" name="fullName" id="fullName" required/>
                </div>
                <div class='errorMessage'>Errors Here:<?php  $errors['fullName'];
                ?></div>
                <div>
                    <label for="email">*Email</label>
                    <input value = "<?php checkEmail($email); ?>" type="text" name="email" id="email" required />
                </div>  
                <div>
                    <label for="mailFormat">Mail format</label>
                    <select name="mailFormat" id="mailFormat">
                        <option value="plain" selected = "selected">Plain text</option>
                        <option value="html" >HTML</option>
                    </select>
                </div>
                <div>
                    <input  type="checkbox" name="confirmBox" id="confirmBox"  <?php  checkBox($confirmBox)?> />
                    <label for="confirmBox">*Tick this box to confirm you have read our <a href="#">terms and conditions</a></label>
                </div>
                <div>
                    <input type="submit" name="submit" value="Send" />
                </div>
            </fieldset>
        </form>
    </body>
</html>
