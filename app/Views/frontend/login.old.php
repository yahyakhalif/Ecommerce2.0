<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login - Phil's Soko</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato: 100,300,400,700|Luckiest+Guy|Oxygen:300,400" rel="stylesheet">
    <link href="<?php echo base_url('/css/login.css') ?>" type="text/css" rel="stylesheet">
    <script src="<?= base_url('/scripts/login.js') ?>"></script>
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Lato", sans-serif;
        }
    </style>
</head>

<body>
    <ul class="navigation"><span class="my-name">SOKO la njue</span>
        <li><a href="index.php">home</a></li>
        <li><a href="menu.php">menu</a></li>
        <li style="float: right;"><a href="<?= base_url('register') ?>">sign up</a></li>
    </ul>

    <main style="margin: auto; width: 60%;">

        <?php
        if (isset($num)) : ?>
            <div class="w3-display-container w3-container w3-blue w3-section">
                <span onclick="this.parentElement.style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
                <h3>Not Authenticated</h3>
                <p>You have to login first...</p>
            </div>
        <?php endif ?>


        <?php
        if (isset($logout)) : ?>
            <div class="w3-display-container w3-container w3-green w3-section">
                <span onclick="this.parentElement.style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
                <h3>Success</h3>
                <p>Logout Successful</p>
            </div>
        <?php endif ?>

        <div class="w3-display-container w3-container w3-red w3-section w3-animate-opacity" id="invalid-msg" style="display: none;">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
            <h3>Invalid Credentials</h3>
            <p>Try Again...</p>
        </div>

        <div class="w3-display-container w3-container w3-red w3-section w3-animate-opacity" id="no-record-msg" style="display: none;">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
            <h3>Invalid Credentials</h3>
            <p>User not registered to Phil's Soko...</p>
        </div>

        <div class="w3-card-4 w3-section w3-animate-opacity" style="background-color: #fff;">

            <div class="w3-container w3-teal">
                <h1>Login</h1>
                <p>Log back in to order more food!</p>
            </div>

            <div class="w3-container">
                <br>
                <label for="emailaddress">Email</label>
                <input class="w3-input" type="text" id="emailaddress" name="email" autocomplete="new-password">
                <p id="emailResult" class="w3-margin-bottom w3-text-red" hidden style="margin-top: 0;"></p><br>

                <label for="password1">Password</label>
                <input class="w3-input" type="password" id="password1" name="password">
                <p id="passResult" class="w3-margin-bottom w3-text-red" hidden style="margin-top: 0;"></p>

                <button class="w3-button w3-center w3-teal w3-hover-black w3-section" name="Login" onclick="checkEmail()">Login</button>

            </div>

            <div class="w3-container w3-teal">
                <h4>Don't Have An Account?</h4>
                <p>Click <a href="<?= base_url('register') ?>">here</a> to sign up to Soko la Njue</p>
            </div>

            <script>
                function checkEmail() {
                    let email = $('#emailaddress').val();
                    let pass = $("#password1").val();

                    $("#invalid-msg").hide()
                    $("#no-record-msg").hide()
                    $("#emailResult").hide();
                    $("#passResult").hide();

                    if (email === '') {
                        $("#emailResult").show().text("* Email field is empty");
                        return;
                    }

                    if (pass === '') {
                        $("#passResult").show().text("* Password field is empty");
                        return;
                    }

                    let test_url = '/loginCheck/' + email + '/' + pass;

                    $.ajax({
                        url: test_url,
                        success: function(result) {
                            if (result.message == 'Invalid Credentials') {
                                $("#invalid-msg").show()
                            } else if (result.message == 'Not a valid email') {
                                $("#emailResult").show().text("* " + result.message);
                            } else if (result.message == 'No such Record') {
                                $("#no-record-msg").show()
                            } else {
                                if (result.role == 2)
                                    window.location.href = "/";
                                else
                                    window.location.href = "/admin";
                            }
                        },
                        error: function() {
                            $("#emailResult").show().text("* Login Authentication failed...");
                        }
                    });
                }
            </script>

        </div>
    </main>

</body>
</html>