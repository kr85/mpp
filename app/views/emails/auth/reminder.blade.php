<!DOCTYPE html>
<html lang="en-US">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="A place where you can track your physical performance,
            log your training workouts, read cool blogs.">
        <meta name="author" content="Kosta Rashev">
        <title>Welcome to Maximal Physical Performance!</title>
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, complete this form:
			<a href="{{ URL::to('password/reset', array($token)) }}">
			    {{ URL::to('password/reset', array($token)) }}
			</a>.
			<br/>
			This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
		</div>
	</body>
</html>
