<?php 
// define variables and set to empty values
$name_error = $email_error = $phone_error =$url_error = "";
$name = $email = $phone = $message = $url = "";
                    
function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["name"])) {
   // var_dump('Hello');
        $name_error = "Name is Required";
    } else {
        $name = test_input($_POST["name"]);
        //check  if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $name_error = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $email_error = "Email is Required";
    } else {
        $email = test_input($_POST["email"]);
        //check  if email address is well formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        }
    }

    if (empty($_POST["phone"])) {
        $phone_error = "Phone is Required";
    } else {
        $phone = test_input($_POST["phone"]);
        //check  if phone number only contains number
        if (!preg_match("(^\D?(\d{3})\D?\D?(\d{3})\D?(\d{5})$)", $phone)) {
            $phone_error = "Invalid phone number";
        }
    }

    if (empty($_POST["url"])) {
        $url_error = "";
    } else {
        $url = test_input($_POST["url"]);
        //check  if URL address syntax is valid(this regular expression also allows dashes in the URL)
        if (!preg_match("([(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*))", $url)) {
            $url_error = "Invalid URL";
        }
    }

    if (empty($_POST["message"])) {
        $message = "";
    } else {
        $message = test_input($_POST["message"]);
    }

     // Send message

        $to = "ridwanoseni101@gmail.com";
        $body = "";

        $body .= "From: ". $name."\r\n";
        $body .= "Phone: ". $phone."\r\n";
        $body .= "URL: ". $url."\r\n";
        $body .= "Message: ". $message."\r\n";

        mail($to, $email, $body);
}

?>