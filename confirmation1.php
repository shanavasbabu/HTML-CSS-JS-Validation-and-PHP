<?php
$insert = false;
if(isset($_POST['name'])){


    define('DB_NAME','shanavas');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_HOST','localhost');
    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if(!$con)
    {
        die('Could not connect:'.mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];

    $query="INSERT INTO `details` (`name`, `email`, `mobile`, `country`, `gender`) VALUES ('$name','$email','$mobile','$country','$gender')";
    // echo $query;
    
    if($con->query($query) == true)
        {
            // echo'<br/><center><h2 style="color:red">Created!</h2></center>';
            // echo "<center><h2 style='color:red'>Your account is created!</h2></center>";
            $insert = true;
        }
    else{
        echo "ERROR";
    }
    $con->close();
}
// $result=mysqli_query($con,"SELECT * FROM details");
// echo "<br><br>";
// echo "<br><center><table border='1'>
// <tr>
// <th>NAME</th>
// <th>EMAIL</th>
// <th>MOBILE</th>
// <th>COUNTRY</th>
// <th>GENDER</th>
// </tr>";
// while($row=mysqli_fetch_array($result))
// {
//     echo"<tr>";
// echo"<td>".$row['name']."</td>";
// echo"<td>".$row['email']."</td>";
// echo"<td>".$row['mobile']."</td>";
// echo"<td>".$row['country']."</td>";
// echo"<td>".$row['gender']."</td>";
// echo"</tr>";
// }
// echo"</table></center>";


// echo'<br /><center><a href="test.html"><input type="button" value="Back to Form" style="background-color: red;color: white;padding: 14px 25px;text-align: center;text-decoration: none;display: inline-block;
// "/></a></center>'

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Form validation</title>
<link rel="stylesheet" href="style.css">
<script>
// Defining a function to display error message
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

// Defining a function to validate form 
function validateForm() {
    // Retrieving the values of form elements 
    var name = document.contactForm.name.value;
    var email = document.contactForm.email.value;
    var mobile = document.contactForm.mobile.value;
    var country = document.contactForm.country.value;
    var gender = document.contactForm.gender.value;
	// Defining error variables with a default value
    var nameErr = emailErr = mobileErr = countryErr = genderErr = true;
    
    // Validate name
    if(name == "") {
        printError("nameErr", "Please enter your name");
    } else {
        var regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(name) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            nameErr = false;
        }
    }
    
    // Validate email address
    if(email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }
    
    // Validate mobile number
    if(mobile == "") {
        printError("mobileErr", "Please enter your mobile number");
    } else {
        var regex = /^[1-9]\d{9}$/;
        if(regex.test(mobile) === false) {
            printError("mobileErr", "Please enter a valid 10 digit mobile number");
        } else{
            printError("mobileErr", "");
            mobileErr = false;
        }
    }
    
    // Validate country
    if(country == "Select") {
        printError("countryErr", "Please select your country");
    } else {
        printError("countryErr", "");
        countryErr = false;
    }
    
    // Validate gender
    if(gender == "") {
        printError("genderErr", "Please select your gender");
    } else {
        printError("genderErr", "");
        genderErr = false;
    }
    
    // Prevent the form from being submitted if there are any errors
    if((nameErr || emailErr || mobileErr || countryErr || genderErr) == true) {
       return false;
    } else {
        // Creating a string from input data for preview
        var dataPreview = "You've entered the following details: \n" +
                          "Full Name: " + name + "\n" +
                          "Email Address: " + email + "\n" +
                          "Mobile Number: " + mobile + "\n" +
                          "Country: " + country + "\n" +
                          "Gender: " + gender + "\n";
        // Display input data in a dialog box before submitting the form
        alert(dataPreview);
    }
};
</script>
</head>
<body>
<form name="contactForm" onsubmit="return validateForm()" action="confirmation1.php" method="post">
    <h2>Application Form</h2>
    <div class="row">
        <label>Full Name</label>
        <input type="text" name="name">
        <div class="error" id="nameErr"></div>
    </div>
    <div class="row">
        <label>Email Address</label>
        <input type="text" name="email">
        <div class="error" id="emailErr"></div>
    </div>
    <div class="row">
        <label>Mobile Number</label>
        <input type="text" name="mobile" maxlength="10">
        <div class="error" id="mobileErr"></div>
    </div>
    <div class="row">
        <label>Country</label>
        <select name="country">
            <option>Select</option>
            <option>Australia</option>
            <option>India</option>
            <option>United States</option>
            <option>United Kingdom</option>
        </select>
        <div class="error" id="countryErr"></div>
    </div>
    <div class="row">
        <label>Gender</label>
        <div class="form-inline">
            <label><input type="radio" name="gender" value="male"> Male</label>
            <label><input type="radio" name="gender" value="female"> Female</label>
        </div>
        <div class="error" id="genderErr"></div>
    </div>
    </div>
    <div class="row">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset All"/>
    </div>
</form>
<?php
        if($insert == true){
            echo '<center><p style="color:red;">Thanks for submitting your from.</p><center>';

        }
        ?>
</body>
</html>
