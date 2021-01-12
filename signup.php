<!DOCTYPE html>
<html>
    <head>
    <?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    </head>
<style>
body {font-family: Arial, Helvetica, sans-serif;
  background: url(assets/img/loan-cover.jpg);
  background-repeat: no-repeat;
	    background-size: cover;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

a {text-decoration: none;
color:white} 

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
/* Set a style for all buttons */
button {
  background-color: #ed3330;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  transition: transform .2s;
}

button:hover {
  opacity:1;
  transform: scale(1.1);
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 60%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>

<center>
<br>
<br>
<div class="container" style="background: rgba(60,60,60, 0.8); width:30%">


<br>
<div class="col">
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign Up as Borrower</button>

</div>
<div class="col">
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up as Lender</button>

</div>
  <div class="col">
  <button style="width:auto;" ><a href="login.php">Login</a></button>

  </div>
  <div class="col">
  <button style="width:auto;" ><a href="Selecao/index.html">Home</a></button>

  </div>

</div>
</center>



<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content form-group" id="login-form1" action="POST">  
    <div class="container">
      <h1>Sign Up - Lender</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <div class="container" >
            <div class="row align-items-start">
                <div class="col">
                    <label for="firstname"><b>First name</b></label>
                    <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" 
                    pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Enter valid first name')" required>
                </div>
                <div class="col">
                    <label for="lastname"><b>Last name</b></label>                      
                    <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" 
                    pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Enter valid last name')" required>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="email"><b>Email</b></label>
                    <p>  </p>
                    <input type="text" placeholder="Enter Email" name="email" id="email" 
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="this.setCustomValidity('Enter valid email')" required>
                </div>
            </div>
            <p>
            </p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="password"><b>Password</b> <small>(must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter)</small></label>
                    <p></p>

                    <input type="password" placeholder="Enter Password" name="password" id="password" 
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                    oninvalid="this.setCustomValidity('Please follow password criteria')" 
                    required>

                    
                </div>
            </div>
            <p></p>
        
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat Password" name="confirm_password" id="confirm_password" required>
                    <span id='message'></span>
                </div>
            </div>  
            <p></p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="birthday"><b>Date of Birth</b></label>
                    <p></p>
                    <input type="date" id="birthday" name="birthday" id="birthday" 
                    min="1910-01-01" max="2002-01-01"
                    required>
                </div>
            </div> 
            <p></p>
            <p></p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="gender"><b>Gender</b></label>
                    <p></p>
                    <select class="form-control" name="gender" id="gender">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>
            </div> 

            <p></p>
            
            <br>
            <div class="row align-items-start">
            <p><b>Phone</b></p>
                <div class="input-group mb-3">
                    
                    <br>
                    
                    <span class="input-group-text" name="basic" id="basic">+91</span>
                    
                    <input type="tel" aria-describedby="basic" name="phone" id="phone" 
                    pattern="[7-9]{1}[0-9]{9}" 
                    oninvalid="this.setCustomValidity('Please enter valid phone number')"
                    required>
                </div>
            </div> 
            <p></p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="aadhar"><b>Aadhar Number</b></label>
                    <p></p>
                    <input type="tel" placeholder="Enter Aadhar Number" name="aadhar" id="aadhar" 
                    pattern="[0-9]{12}" 
                    oninvalid="this.setCustomValidity('Please enter Aadhar Number')"
                    required>
                </div>
            </div> 
      </div>
      <input type="checkbox" name="" id="" required>
      <p>By creating an account you agree to our Terms & Privacy.</p>

      <div class="clearfix">
        <!-- <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> -->
        <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary" >Signup</button></center>
      </div>
    </div>
  </form>
</div>

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content form-group" id="login-form2" action="POST">  
    <div class="container">
      <h1>Sign Up -Borrower</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <div class="container">
            <div class="row align-items-start">
                <div class="col">
                    <label for="firstname"><b>First name</b></label>
                    <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" 
                    pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Enter valid first name')" required>
                </div>
                <div class="col">
                    <label for="lastname"><b>Last name</b></label>                      
                    <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" 
                    pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Enter valid last name')" required>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" id="email" 
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="this.setCustomValidity('Enter valid email')" 
                    required>
                </div>
            </div>
            
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="password"><b>Password</b> <small>(must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter)</small></label>
                    <p></p>

                    <input type="password" placeholder="Enter Password" name="password" id="password1" 
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                    oninvalid="this.setCustomValidity('Please follow password criteria')" 
                    required>

                    
                </div>
            </div>
            <p></p>
        
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat Password" name="confirm_password" id="confirm_password1" required>
                    <span id='message1'></span>
                </div>
            </div>  
            
            <p></p>
            
            
            <p></p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="gender"><b>Gender</b></label>
                    <select class="form-control" name="gender" id="gender">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>
            </div> 
            <p></p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="birthday"><b>Date of Birth</b></label>
                    <p></p>
                    <input type="date" id="birthday" name="birthday" id="birthday" 
                    min="1910-01-01" max="2002-01-01"
                    required>
                </div>
            </div> 
            <p></p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="edu"><b>Education</b></label>
                    <select class="form-control" name="edu" id="edu">
                        <option>HIgh School</option>
                        <option>Diploma</option>
                        <option>Bachelors</option>
                        <option>Masters</option>
                        <option>Doctorate</option>

                    </select>
                </div>
            </div> 
            <p></p>
            <p></p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="income"><b>Annual Income (in rupees) </b></label>
                    <input type="number" placeholder="Enter Income" name="income" id="income"
                    min="10000" required>
                </div>
            </div> 

            <p></p>
            <p></p>

            <div class="row align-items-start">
                <div class="col-6">
                    <label for="profession"><b>Profession</b></label>
                    <input type="text" placeholder="Enter Profession" name="profession" id="professsion" 
                    pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Enter valid profession')" required>
                </div>
            </div> 
            <p></p>
            <div class="row align-items-start">
            <p><b>Phone</b></p>
                <div class="input-group mb-3">
                    
                    <br>
                    
                    <span class="input-group-text" name="basic" id="basic">+91</span>
                    
                    <input type="tel" aria-describedby="basic" name="phone" id="phone" 
                    pattern="[7-9]{1}[0-9]{9}" 
                    oninvalid="this.setCustomValidity('Please enter valid phone number')"
                    required>
                </div>
            </div> 
            <p></p>
            <div class="row align-items-start">
                <div class="col-6">
                    <label for="aadhar"><b>Aadhar Number</b></label>
                    <p></p>
                    <input type="tel" placeholder="Enter Aadhar Number" name="aadhar" id="aadhar" 
                    pattern="[0-9]{12}" 
                    oninvalid="this.setCustomValidity('Please enter Aadhar Number')"
                    required>
                </div>
            </div> 
      </div>
      <input type="checkbox" name="" id="" required>
      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <!-- <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> -->
        <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Signup</button></center>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal2 = document.getElementById('id02');
var modal1 = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
}
document.addEventListener("wheel", function(event){
    if(document.activeElement.type === "number"){
        document.activeElement.blur();
    }
});
$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
$('#password1, #confirm_password1').on('keyup', function () {
  if ($('#password1').val() == $('#confirm_password1').val()) {
    $('#message1').html('Matching').css('color', 'green');
  } else 
    $('#message1').html('Not Matching').css('color', 'red');
});

$('#login-form1').submit(function(e){
		e.preventDefault()
		$('#login-form1 button[type="button"]').attr('disabled',true).html('Signing up...');

		$.ajax({
			url:'ajax.php?action=signup_lender',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
				$('#login-form1 button[type="button"]').removeAttr('disabled').html('Login');
			},
			success:function(resp){
				if(resp == 1){
          alert("Signup complete");
					location.href ='index.php?page=home';
				}else{
                    if(resp == 2)
                        alert("User with same email already exists");
					alert(resp);
				}
			}
		})
	})

$('#login-form2').submit(function(e){
		e.preventDefault()
		$('#login-form2 button[type="button"]').attr('disabled',true).html('Signing up...');

		$.ajax({
			url:'ajax.php?action=signup_borrower',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
				$('#login-form2 button[type="button"]').removeAttr('disabled').html('Login');
			},
			success:function(resp){
				if(resp == 1){
          alert("Signup complete");

					location.href ='index.php?page=home';
				}else{
                    if(resp == 2)
                        alert("User with same email already exists");
					else
                        alert(resp);
				}
			}
		})
	})
</script>

</body>
</html>
