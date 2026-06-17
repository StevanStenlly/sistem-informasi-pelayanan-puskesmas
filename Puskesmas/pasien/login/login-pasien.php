<!doctype html>
<html lang="en">

<head>
	<title>Login Pasien</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
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
						<div class="img" style="background-image: url(images/logo_pkm.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">LOGIN PASIEN</h3>
								</div>
							</div>
							<form action="proses-loginpasien.php" method="POST" class="signin-form" autocomplete="off">
								<div class="form-group mb-3">
									<label class="label" for="nik_pasien">NIK</label>
									<input
										type="text"
										name="nik_pasien"
										id="nik_pasien"
										class="form-control"
										placeholder="NIK"
										maxlength="16"
										pattern="\d{16}"
										inputmode="numeric"
										title="Masukkan 16 digit angka NIK"
										required>
								</div>

								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input type="password" name="password_pasien" class="form-control" placeholder="Password" maxlength="16" autocomplete="new-password" required>
								</div>

								<div class="form-group">
									<button type="submit" class="form-control btn btn-primary rounded submit px-3">MASUK</button>
								</div>
							</form>
							<p class="text-center">Belum mendaftar? <a type="button" href="pendaftaran.php">DAFTAR</a></p>
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

	<!-- Script validasi input hanya angka -->
	<script>
		document.getElementById("nik_pasien").addEventListener("input", function() {
			this.value = this.value.replace(/\D/g, ''); // Hapus semua non-digit
		});
	</script>
</body>

</html>