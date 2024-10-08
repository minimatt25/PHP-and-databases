<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login System.css">
    <title>Sign In</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="mainSection">
        <h1 class="signUp centerText">Login</h1>
        <fieldset>
            <legend>Your Information</legend>

            <div class="loginTable">
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

            <div class="loginTable">
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
            
            <br>
            <div class="loginCreate">
                <button id="createAccount" disabled>Login to account</button>
            </div>
            <br>
            <div id="invalidMessage"></div>
        </fieldset>
        
        <div class="accounts">
            <br>
            <a href="Sign Up System.php"><p>Don't have an account, sign up here</p></a>
            <br><br>
            <h2>Working accounts</h2>
            <?php
                $connection = new mysqli("localhost","root","","test");
                $result = $connection->query("SELECT * FROM people");
                echo "<table border='1'>";
                echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Password<th></tr>";

                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $row['firstName'] . "</td>";
                    echo "<td>" . $row['lastName'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                $connection->close();
                echo "<br> table inserted from connected database"
            ?>
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

                if ( firstName!='' && lastName!='' && email!=''){
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