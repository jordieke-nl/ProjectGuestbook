<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guestbook";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
  $sql_store = "SELECT * FROM guestbook";


if(isset($_POST["firstname"]) && isset($_POST["lastname"])) {
  if($_POST["firstname"] != "" && $_POST["lastname"] != "") {


  $firstname = $_POST['firstname'];
  $lastname = $_POST["lastname"];
  $email = $_POST["E-mail"];
  $website = $_POST["websiteaddress"];
  $message = $_POST["message"];
  $subject = $_POST["subject"];
  $sql_store = "INSERT INTO guestbook (guestbookId, firstname, lastname, email, website, message, subject, dateRate) VALUES (NULL, '$firstname', '$lastname', '$email', '$website', '$message', '$subject', NOW())";
  $sql = mysqli_query($conn, $sql_store) or die(mysql_error());
  $sql_store = "SELECT * FROM guestbook";
  header("Location: Guestbook.php");
}else {
  echo "You need to enter data in all the boxes.";
}

}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="guestbook">
    <meta name="author" content="Jordi Kuipers"/>
    <meta name="keywords" content="Guestbook, ROC Ter AA, PHP, HTML, WD"/>
    <meta name="description" content="Example of a guestbook as used in lessons for ROC Ter AA.
    Fetch from databse user posts."/>
    <meta name="copyright" content="text">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" href="images/PenWebIcon.ico	" type="image/ico" sizes="16x16">
    <script src='https://www.google.com/recaptcha/api.js'></script>
  <title>Guestbook</title>

</head>
<h1>Guestbook</h1>
  <body>

    <div id="main-container1">
  		<div class="container">
    <form method="POST" action="Guestbook.php">

        <label for="fname">First Name*</label>
        <input type="text" id="fname" name="firstname"  oninvalid="this.setCustomValidity('Fill in your firstname.')"
        oninput="this.setCustomValidity('')" placeholder="Your name.." required="required">

        <label for="lname">Last Name*</label>
        <input type="text" id="lname" name="lastname" oninvalid="this.setCustomValidity('Fill in your lastname (insertion possible).')"
        oninput="this.setCustomValidity('')" placeholder="Your last name (insertion also possible).." required="required">

        <label for="Email">Subject*</label>
        <input type="text" id="lname" name="subject"  oninvalid="this.setCustomValidity('Fill in the subject.')"
        oninput="this.setCustomValidity('')" placeholder="Subject.." required="required">

       <label for="Email">Email address*</label>
       <input type="text" id="lname" name="E-mail"  oninvalid="this.setCustomValidity('Fill in your e-mail-address.')"
       oninput="this.setCustomValidity('')" placeholder="Your Email address.." required="required">

       <label for="lname">Website address*</label>
       <input type="text" id="lname" name="websiteaddress"  oninvalid="this.setCustomValidity('Fill in your website address.')"
       oninput="this.setCustomValidity('')" placeholder="Website address.." required="required">

        <label for="subject">Message*</label>
        <textarea id="message" name="message"  oninvalid="this.setCustomValidity('Fill in the message.')"
        oninput="this.setCustomValidity('')" placeholder="Place here your message.." style="height:200px" required="required"></textarea>
      <div id="recaptcha">
        <div class="g-recaptcha" data-sitekey="6LfA8EoUAAAAAEZIVVK4upVkEr9Ke5pqbnqnO1em" oninvalid="this.setCustomValidity('Fill in your website address.')"
          oninput="this.setCustomValidity('')" required="required"></div></br>
      </div>

           <input type="submit" value="Submit">
            <input type="reset" value="Reset">
            <div id="reviews">Reviews<br/>

            </div>
            <div id="review">

              <?php
              $sqlshow = "SELECT * FROM guestbook";

              $result = $conn->query($sqlshow);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    	echo "--------------------------------------------------------------------------------------------------<br/> ";
                      echo $row['dateRate']."<br/> ";
                      echo $row['firstname']." ";
                      echo $row['lastname']."---";
                      echo $row['email']."---";
                      echo $row['website']." <br/> Subject: ";
                      echo $row['subject']." <br/> Message: ";
                      echo $row['message']." <br/>";
                      }
                    }
              ?>
              <footer>
                  <h2>Jordi Kuipers || Roc Ter Aa ©</h2>
              </footer>
            </div>
          </div>

          </div>
         </form>

         	<script type="text/javascript" src="js/captcha.js" ></script>
         <div id="clearfix">
         </div>
       </body>
       </html>
