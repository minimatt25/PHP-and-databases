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
        <h1 class="signUp centerText">Sign Up</h1>
        <fieldset>
            <legend>Your Information</legend>

            <div class="signUpTable">
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

            <div class="signUpTable">
                <div class="cell">
                    <label for="email">Email</label>
                    <br>
                    <input type="email" id="email" name="email">
                </div>
                <div class="cell">
                    <label for="Cemail">Confirm Email</label>
                    <br>
                    <input type="email" id="Cemail" name="email">
                </div>
                <div class="cell signUpCreate">
                    <button id="createAccount" disabled>Create Account</button>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    $('#password, #confirm').on('keyup',function (){
                        if ($('#password').val() == $('#confirm').val()){
                            $('#message').html('Matching').css('color', 'green');
                        } else{
                            $('#message').html('Not Matching').css('color', 'red');
                        }
                    });
                });
            </script>

            <div class="signUpTable"></div>
                <div class="cell">
                    <label for="password">Password</label>
                    <br>
                    <input type="password" id="password" name="password">
                </div>
                <div class="cell">
                    <label for="confirm">Confirm Password</label>
                    <br>
                    <input type="password" id="confirm" name="confirm">
                </div>
                <div class="cell" id="message"></div>
            </div>
        </fieldset>
    </div>

    <script>
        $(document).ready(function (){
            const createAccountButton = $('#createAccount');

            function validation(){
                const firstName = $('#firstName').val().trim();
                const lastName = $('#lastName').val().trim();
                const email = $('#email').val().trim();
                const Cemail = $('#Cemail').val().trim()
                const password = $('#password').val().trim();
                const confirm = $('#confirm').val().trim();

                if ( firstName!='' && lastName!='' && email!='' && Cemail == email && password.length>=8 && confirm == password)
                {
                    createAccountButton.prop('disabled', false);
                } else{
                    createAccountButton.prop('disabled', true);
                }
            }

            $('#firstName, #lastName, #email, #Cemail, #password, #confirm').on('input', validation);

            $('#createAccount').on('click', function(event){
                event.preventDefault();

                const firstName = $('#firstName').val().trim();
                const lastName = $('#lastName').val().trim();
                const email = $('#email').val().trim();
                const Cemail = $('#Cemail').val().trim()
                const password = $('#password').val().trim();
                const confirm = $('#confirm').val().trim();

                $.ajax({
                    url:'User Sign Up.php',
                    type: "post",
                    data: {
                        firstName:firstName,
                        lastName:lastName,
                        email:email,
                        Cemail:Cemail,
                        password:password,
                        confirm:confirm
                    },
                    success: function(response){
                        if(response == "success"){
                            window.location.href = "SignUpWorked.html";
                        } else{
                            $("#invalidMessage").html(response);
                        }
                    }
                })
            });
        });
    </script>
</body>
</html>