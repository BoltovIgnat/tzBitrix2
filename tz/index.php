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

	<div class="container">
		<form class="registration" id="registration" onsubmit="return Send(this)">
			<h1>Форма обратной связи</h1>

			<label for="username">
				<span>Имя пользователя</span>

				<input type="text" id="username" minlength="3" required>

				<ul class="input-requirements">
					<li>Дожно быть длинее 3 символов</li>
					<li>Должно содежать только буквы и цифры</li>
				</ul>
			</label>

			<label for="telefon">
				<span>Телефон</span>

				<input type="text" id="telefon" maxlength="12" minlength="11" required>

				<ul class="input-requirements">
					<li>В телефоне Должно присутсвовать 11 символов</li>
					<li>В телефоне должны присутсвовать только цифры</li>
				</ul>
			</label>

			<label for="message">
                <span>Сообщение</span>
				<input type="text" id="message" maxlength="100" minlength="1" required>
			</label>


            
            <label for="checkbox">
                <input type="checkbox" class="checkbox" id="checkbox" />
                <span>Согласие на обработку персвональных данных</span>

                <ul class="input-requirements">
					<li>Галочка должна быть нажата</li>
				</ul>
            </label>
			<br>

			<input type="submit">

		</form>
	</div>

    <script src="script.js"></script>
</body>
</html>
