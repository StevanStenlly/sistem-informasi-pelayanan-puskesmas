<!doctype html>
<html lang="en">

<head>
	<title>Login Dokter</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style1.css">

	<!-- Favicons -->
	<link href="../img/logo_pkm.jpg" rel="icon">
	<link href="../img/logo_pkm.jpg" rel="apple-touch-icon">

</head>

<body>
	<section class="ftco-section img" style="background-image: url(images/puskesmas.jpg);">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/logo_pkm.jpg);">
						</div>
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">LOGIN DOKTER</h3>
								</div>
							</div>
							<form action="proses-logindokter.php" method="POST" class="signin-form" autocomplete="off">
								<div class="form-group mb-3">
									<label class="label" for="name">NIP</label>
									<input type="text" name="nip_dokter" class="form-control" placeholder="NIP" maxlength="18" autocomplete="off" required
										oninput="this.value = this.value.replace(/[^0-9]/g, '')">
								</div>

								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input type="password" name="password_dokter" class="form-control" placeholder="Password" maxlength="18" autocomplete="new-password" required>
								</div>
								<div class="form-group">
									<button type="submit" class="form-control btn btn-primary rounded submit px-3">MASUK</button>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>