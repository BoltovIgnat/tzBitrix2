<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Realtime Form Validation</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/style.css">


</head>
<body>
    <?$configs = include('config.php');?>
	<div class="container">
		<form class="registration" id="registration" onsubmit="return Send(this)">
			<h1>Форма подключения config.php</h1>

			<label for="color">
				<span>Color</span>

				<input type="text" id="color" value="<?$configs[color]?>" required>

			</label>

			<label for="font">
				<span>Размер шрифта</span>

				<input type="text" id="font" value="<?$configs[font]?>" required>

			</label>

			<br>

			<input type="submit">

		</form>
	</div>

    <script src="scriptForConfig.js"></script>
</body>
</html>