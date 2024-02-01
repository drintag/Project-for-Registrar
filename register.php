<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="shortcut icon" href="img/lo.png" />

   <title>Regisration Form </title>
</head>
<style>
	/* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url('assets/img/bg.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
.container{
    position: relative;
    max-width: 900px;
    width: 100%;
    border-radius: 6px;
    padding: 30px;
    margin: 0 15px;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}
.container header{
    position: relative;
    font-size: 20px;
    font-weight: 600;
    color: #333;
}
.container header::before{
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    height: 3px;
    width: 27px;
    border-radius: 8px;
    background-color: #4070f4;
}
.container form{
    position: relative;
    margin-top: 16px;
    min-height: 490px;
    background-color: #fff;
    overflow: hidden;
}
.container form .form{
    position: absolute;
    background-color: #fff;
    transition: 0.3s ease;
}
.container form .form.second{
    opacity: 0;
    pointer-events: none;
    transform: translateX(100%);
}
form.secActive .form.second{
    opacity: 1;
    pointer-events: auto;
    transform: translateX(0);
}
form.secActive .form.first{
    opacity: 0;
    pointer-events: none;
    transform: translateX(-100%);
}
.container form .title{
    display: block;
    margin-bottom: 8px;
    font-size: 16px;
    font-weight: 500;
    margin: 6px 0;
    color: #333;
}
.container form .fields{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
form .fields .input-field{
    display: flex;
    width: calc(100% / 3 - 15px);
    flex-direction: column;
    margin: 4px 0;
}
.input-field label{
    font-size: 12px;
    font-weight: 500;
    color: #2e2e2e;
}
.input-field input, select{
    outline: none;
    font-size: 14px;
    font-weight: 400;
    color: #333;
    border-radius: 5px;
    border: 1px solid #aaa;
    padding: 0 15px;
    height: 42px;
    margin: 8px 0;
}
.input-field input :focus,
.input-field select:focus{
    box-shadow: 0 3px 6px rgba(0,0,0,0.13);
}
.input-field select,
.input-field input[type="date"]{
    color: #707070;
}
.input-field input[type="date"]:valid{
    color: #333;
}
.container form button, .backBtn{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;
    max-width: 200px;
    width: 100%;
    border: none;
    outline: none;
    color: #fff;
    border-radius: 5px;
    margin: 25px 0;
    background-color: #4070f4;
    transition: all 0.3s linear;
    cursor: pointer;
}
.container form .btnText{
    font-size: 14px;
    font-weight: 400;
}
form button:hover{
    background-color: #265df2;
}
form button i,
form .backBtn i{
    margin: 0 6px;
}
form .backBtn i{
    transform: rotate(180deg);
}
form .buttons{
    display: flex;
    align-items: center;
}
form .buttons button , .backBtn{
    margin-right: 14px;
}

@media (max-width: 750px) {
    .container form{
        overflow-y: scroll;
    }
    .container form::-webkit-scrollbar{
       display: none;
    }
    form .fields .input-field{
        width: calc(100% / 2 - 15px);
    }
}

@media (max-width: 550px) {
    form .fields .input-field{
        width: 100%;
    }
}
input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button{
			-webkit-appearance: none;
			margin: 0;
		}


</style>
<body>
    <div class="container">
        <header>Registration</header>

        <form action="function/registercode.php" method="POST">
                <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>

                    <div class="fields">
                    <div class="input-field">
                        <label>First Name</label>
                        <input type="text" placeholder="Enter your first name" name="fname" required oninput="capitalizeName(this)">
                    </div> 

                        <div class="input-field">
                            <label>Middle Initial</label>
                            <input type="text" placeholder="Enter your middle name" name="mname" required oninput="handleMiddleInitialInput(this)">
                        </div>
                        
                        <div class="input-field">
                        <label>Last Name</label>
                        <input type="text" placeholder="Enter your last name" name="lname" required oninput="capitalizeName(this)">
                    </div>
                    
                    <div class="input-field">
                        <label>Gender</label>
                        <select required id="genderSelect" name="sex" onchange="disableSuffixField()">
                            <option disabled selected>Select gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                        
                        <div class="input-field">
                        <label>Suffix(if any)</label>
                        <select  id="suffixSelect" name="nextension">
                            <option disabled selected>Select Suffix</option>
                            <option>Jr.</option>
                            <option>Senior</option>
                            <option>None</option>
                        </select>
                    </div>

                    <div class="input-field">
                            <label>Email</label>
                            <input type="email" id="email" placeholder="Enter your email" name="email" required>
                               <div id="em" style="color: red"></div>
                        </div>
     
                    </div>

                    </div>
              
                <div class="details ID">
                    <span class="title">Identity Details</span>

                    <div class="fields">
                        <div class="input-field">
                        <label>ID Number</label>
                        <input type="text" class="form-control" placeholder="Enter your ID number" name="StudID" onkeyup="validateInput(this)" required>
						<span id="error-msg" style="color: red;"></span>
                        </div>
                       
                        <div class="input-field">
                            <label>College Department</label>
                            <input type="text" placeholder="Enter your College Department" name="college" required>
                        </div>

                        <div class="input-field">
                            <label>Program/Degree</label>
                            <input type="text" placeholder="Enter your Program/Degree" name="degree" required>
                        </div>
                    </div>
 
                    <div class="buttons">
                    <a href="login.php" class="backBtn">
                        <i class="uil uil-navigator"></i>
                        <span class="btnText">Login</span>
                    </a>
                                            
                        <button class="sumbit" name="submit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div> 
            </div>

           
        </form>
    </div>

  
</body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function disableSuffixField() {
        var genderSelect = document.getElementById("genderSelect");
        var suffixSelect = document.getElementById("suffixSelect");
        
        if (genderSelect.value === "Female") {
            suffixSelect.disabled = true;
            suffixSelect.selectedIndex = 0; // Reset the selected option
        } else {
            suffixSelect.disabled = false;
        }
    }
    function handleMiddleInitialInput(input) {
        var value = input.value.trim();

        // Remove any non-alphabetic characters
        value = value.replace(/[^a-zA-Z]/g, '');

        if (value.length > 1) {
            // Truncate to the first two characters
            value = value.slice(0, 1);
        }

        if (value.length > 0) {
            // Convert the middle initial to uppercase
            value = value.toUpperCase() + '.';
        }

        input.value = value;
    }
    function capitalizeName(input) {
    var words = input.value.split(" ");

    // Capitalize the first letter of each word and convert the rest to lowercase
    for (var i = 0; i < words.length; i++) {
        var word = words[i];
        if (word.length > 0) {
            words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        }
    }

    // Join the words back together with spaces
    input.value = words.join(" ");
}
    function validateDateOfBirth() {
        var dobInput = document.getElementById("dobInput");
        var dob = new Date(dobInput.value);
        var currentDate = new Date();
        var minAge = 16;

        if (dob > currentDate) {
            alert("Invalid date of birth. Please select a date in the past.");
            dobInput.value = ""; // Reset the input value
            return;
        }

        var age = currentDate.getFullYear() - dob.getFullYear();
        if (currentDate.getMonth() < dob.getMonth() || (currentDate.getMonth() === dob.getMonth() && currentDate.getDate() < dob.getDate())) {
            age--;
        }

        if (age < minAge) {
            alert("You must be at least 16 years old above to proceed.");
            dobInput.value = ""; // Reset the input value
        }
    }

    var dobInput = document.getElementById("dobInput");
    dobInput.addEventListener("input", validateDateOfBirth);

</script>
    <script type="text/javascript">

  $(document).ready(function(){
    $('#email').keyup(function()
    { var email = $('#email').val();
      
      $.ajax({
        type: "post",
        url: "function/check.php",
        data: {"checkem": 1,
              "email": email,
              
      },
      success: function (response) {
        $('#em').text(response);
        
        
      }
      });
    });
  });
  </script>
<script>
    var numberInput = document.querySelector('input[name="number"]');
    var errorMessage = document.getElementById('error-message');
    
    function validateInput() {
        var inputValue = numberInput.value;
        
        // Remove any non-digit characters
        var digitsOnly = inputValue.replace(/\D/g, '');
        
        // Check if the input is exactly 11 digits starting with "09"
        if (/^\d{11}$/.test(digitsOnly) && digitsOnly.startsWith('09')) {
            errorMessage.textContent = '';
            numberInput.setCustomValidity('');
        } else if (inputValue === '') {
            errorMessage.textContent = '';
            numberInput.setCustomValidity('');
        } else {
            errorMessage.textContent = 'Please enter a valid 11-digit number starting with 09';
            numberInput.setCustomValidity('Invalid');
        }
    }
    
    numberInput.addEventListener('input', validateInput);
    numberInput.addEventListener('change', validateInput);
</script>


<script>
     function validateInput(input) {
        var value = input.value;
        var errorElement = document.getElementById('error-msg');
        
        // Check if the value contains any disallowed characters
        if (/[^0-9!@#$%^&*()\-_=+{}\[\]:";'<>?,./|`~]/.test(value)) {
            errorElement.textContent = "Only numbers and symbols are allowed.";
            input.value = value.replace(/[^0-9!@#$%^&*()\-_=+{}\[\]:";'<>?,./|`~]/g, ''); // Remove disallowed characters from the input value
        } else {
            errorElement.textContent = "";
        }
    }
</script>
</html>