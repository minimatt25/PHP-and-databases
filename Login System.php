<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login System.css">
    <title>Sign Up</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="mainSection">
        <h1 class="signUp centerText">Sign In</h1>
        <fieldset>
            <legend>Your Information</legend>

            <div class="table">
                <div class="cell">
                    <label for="firstName">First Name</label>
                    <br>
                    <input type="text" id="firstName" name="firstName">
                </div>
                <div class="cell">
                    <label for="lastName">Last Name</label>
                    <br>
                    <input type="text" id="lastName" name="lastName">
                </div>
            </div>

            <div class="table">
                <div class="cell">
                    <label for="email">Email</label>
                    <br>
                    <input type="email" id="email" name="email">
                </div>

                <div class="cell">
                    <label for="password">Password</label>
                    <br>
                    <input type="password" id="password" name="password">
                </div>
            </div>

            <div class="create">
                <button id="createAccount" disabled>Create Account</button>
            </div>
            <br>
            <div id="invalidMessage"></div>
        </fieldset>

        <br><br>
        <div class="accounts">
            <h2>Working accounts</h2>
            <ul>
                <li>Matthew, Adam, matt123@gmail.com, cheese1234</li>
                <li>John, Smith, JSmith@gmail.com, password1234</li>
            </ul>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            const createAccountButton = $('#createAccount');

            function validation(){
                const firstName = $('#firstName').val().trim();
                const lastName = $('#lastName').val().trim();
                const email = $('#email').val().trim();
                const password = $('#password').val().trim();

                if ( firstName!='' && lastName!='' && email!='' &&   password.length>=8){
                    createAccountButton.prop('disabled', false);
                } else{
                    createAccountButton.prop('disabled', true);
                }

            }

            $('#firstName, #lastName, #email, #password').on('input', validation);
            
            $('#createAccount').on('click', function(event){
                event.preventDefault();

                const firstName = $('#firstName').val().trim();
                const lastName = $('#lastName').val().trim();
                const email = $('#email').val().trim();
                const password = $('#password').val().trim();

                //communicating with php file to check if user valid
                $.ajax({
                    url: "User Check.php",
                    type: "post",
                    data: {
                        firstName:firstName,
                        lastName:lastName,
                        email:email,
                        password:password
                    },
                    success: function(response){
                        if(response === "success"){
                            window.location.href = "SignUpWorked.html";
                        } else{
                            $("#invalidMessage").html(response);
                        }
                    }
                });

            });

        });
    </script>
</body>
</html>