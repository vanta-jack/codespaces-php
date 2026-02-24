<?php

/*----------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 * Licensed under the MIT License. See LICENSE in the project root for license information.
 *---------------------------------------------------------------------------------------*/

function sayHello($name) {
	echo "Hello $name!";
}

?>

<html>
	<head>
		<title>Visual Studio Code Remote :: PHP</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<h1>Forms Test</h1>
		<div>
		<?php
		sayHello('remote world');
		?>
		</div>
		<div class="form-container">
			<h2>Sign Up</h2>
			<form method="POST" action="welcome.php">
				<div style="margin-bottom: 1rem;">
					<label for="name">Name:</label>
					<input type="text" id="name" name="name" required>
				</div>
				<div style="margin-bottom: 1rem;">
					<label for="email">Email:</label>
					<input type="email" id="email" name="email" required>
				</div>
				<div style="margin-bottom: 1rem;">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" required>
				</div>
				<div style="margin-bottom: 1rem;">
					<label for="confirm_password">Confirm Password:</label>
					<input type="password" id="confirm_password" name="confirm_password" required>
				</div>
				<button type="submit">Sign Up</button>
			</form>
		</div>

	</body>
</html>