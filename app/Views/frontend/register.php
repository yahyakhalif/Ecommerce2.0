<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!-- Main css -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="main">

    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
	                <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none">
		                <strong>Oops!</strong> <span>You should check in on some of those fields below.</span>
		                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </div>
                    <h2 class="form-title">Sign up</h2>
                    <form action="#" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="first_name" id="first_name" placeholder="First name" required/>
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="last_name" id="last_name" placeholder="Last name" required/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group">
	                        <select id="gender" name="gender" class="form-select" aria-label required>
		                        <option value="" selected hidden>Gender</option>
		                        <option value="male">Male</option>
		                        <option value="female">Female</option>
	                        </select>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required/>
                        </div>
                        <div class="form-group form-button">
	                        <button type="submit" class="btn btn-warning">Register</button>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="/images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="/login" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="/vendors/jquery/jquery.min.js"></script>
<script src="/vendors/jquery_validation/jquery.validation.min.js"></script>
<script src="/vendors/jquery_validation/additional-methods.min.js"></script>
<script>
	$('#register-form').validate({
		rules: {
            name: 'required'
		},
		submitHandler: form => {
            const data = {};
            $(form).serializeArray().map(function (object) {
                data[object.name] = object.value;
            });

            $.ajax({
                data: data,
	            method: 'POST',
                url: '/regCheck',
                dataType: 'json',
                success: result => {
                    console.log(result, result.message)

                    if (result.message === 'Registration Failed') {
                        $('#alert').show()
                        $('#alert span').text('Registration Failed');
                    } else if (result.message === 'Not a valid email') {
                        $('#alert').show()
                        $('#alert span').text(result.message);
                    } else if (result.message === 'Email already exists') {
                        $('#alert').show()
                        $('#alert span').text('Email already exists');
                    } else {
                        window.location.href = "/";
                    }
                },
	            error: xhr => {
                    console.log(xhr)
	            }
            })
		}
	})
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>