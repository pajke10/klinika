 	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="calendar.php">Profmedika</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="proba.php">Zakazani pregledi <span class="sr-only"></span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="proba_ordinacija.php">Pregled ordinacija</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="pretragaPacijenataNew.php">Registracija pacijenta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="fakturisanje.php">ZA SASKU</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><b>sestra: <?php                  
					echo $_SESSION['users'];
				?></b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="logout.php"><b>Odjavi se</b></a>
			</li>
		</ul>
	</div>
</nav>