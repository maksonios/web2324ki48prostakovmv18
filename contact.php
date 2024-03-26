<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale=1.0">
    <title>Contact form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="./contact.js"></script>
</head>

<body>

<header class="mb-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="./contact.php">Contact</a></li>
    </ul>
    </nav>
    <h1 class="text-center">My Business Card</h1>
</header>

<section class="container">
    <h2>Contact information</h2>
    <ul class="list-unstyled">
        <li>Email: <a href="mailto:maksym.prostakov.ki.2020@lpnu.ua">maksym.prostakov.ki.2020@lpnu.ua</a></li>
        <li>Telegram: <a href="https://t.me/maksonidc">https://t.me/maksonidc</a></li>
        <li>LinkedIn: <a href="https://www.linkedin.com/in/maksym-prostakov-b954481ba/">https://www.linkedin.com/in/maksym-prostakov-b954481ba/</a></li>
        <li>GitHub: <a href="https://github.com/maksonios">https://github.com/maksonios</a></li>
    </ul>

    <h2>Contact me</h2>
    <form id="contactForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" novalidate>
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" name="name" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" name="email" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="text">Message:</label>
				<textarea name="text" rows="4" class="form-control" required></textarea>
			</div>

			<input type="submit" id="sendMessageBtn" value="Send a message" class="btn btn-primary">
		</form>
</section>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>