<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sign In</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!-- Main css -->
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="main">
	<!-- Sing in  Form -->
	<section class="sign-in">
		<div class="container">
			<div class="signin-content">
				<div class="signin-image">
					<figure><img src="/images/signin-image.jpg" alt="sing up image"></figure>
					<a href="/register" class="signup-image-link">Create an account</a>
				</div>

				<div class="signin-form">
					<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none">
						<strong>Oops!</strong> <span>You should check in on some of the fields below.</span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<h2 class="form-title">Sign In</h2>
					<form class="register-form" id="login-form">
						<div class="form-group">
							<label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
							<input type="text" name="email" id="email" placeholder="Your Email"/>
						</div>
						<div class="form-group">
							<label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
							<input type="password" name="password" id="password" placeholder="Password" required/>
						</div>
						<div class="form-group">
							<input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
							<label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
						</div>
						<div class="form-group form-button">
							<button type="submit" class="btn btn-warning">Sign In</button>
						</div>
					</form>
					<div class="social-login">
						<span class="social-label">Or login with</span>
						<ul class="socials">
							<li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
							<li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
							<li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
						</ul>
					</div>
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
    $('#login-form').validate({
        rules: {
            email: 'required'
        },
        submitHandler: form => {
            const data = {};
            $(form).serializeArray().map(function (object) {
                data[object.name] = object.value;
            });

            $(form).find($('button[type="submit"]')).prop('disabled', true).text('Please wait')

            $.ajax({
                data: data,
                method: 'POST',
                url: '/loginCheck',
                dataType: 'json',
                success: result => {
                    if (result.message === 'Invalid Credentials') {
                        $('#alert').show()
                        $('#alert span').text('Invalid Credentials');
                    } else if (result.message === 'Not a valid email') {
                        $('#alert').show()
                        $('#alert span').text('Not a valid email');
                        $("#emailResult").show().text("* " + result.message);
                    } else if (result.message === 'No such Record') {
                        $('#alert').show()
                        $('#alert span').text('No such Record');
                    } else {
                        if (result.role === 2)
                            window.location.href = "/";
                        else
                            window.location.href = "/admin";
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