<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Interfafe CRUD</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		 <!-- Font Awesome -->
		 <link rel="stylesheet" href="css/all.css">
	</head>
	<body>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<a class="navbar-brand" href="index.php">
				Ma grille CRUD-PHP 
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</nav>
		<div class="container" style=" padding-top: 70px;">
			<div class="row">
				<p>
					<a class="btn btn-success"data-toggle="modal" data-target="#ModalCenter"><i class="fas fa-user-plus"></i> Create</a>
				</p>
			</div>
			<div class="row">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Email-Adresse</th>
							<th>mobile</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						include 'class/database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM customers ORDER BY id DESC';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>' . $row['name'] . '</td>';
							echo '<td>' . $row['email'] . '</td>';
							echo '<td>' . $row['mobile'] . '</td>';
							echo '</tr>';
						}
						Database::disconnect();
						?>
							
						</tbody>
					</table>
				</div>
			</div> <!-- /container -->

			<!--AJouter un client dans la base de donnée -->
			<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
				<div role="document" class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 id="ModalLongTitle" class="modal-title">
								L'AJOUT D'UN NOUVEAU CLIENT
							</h5>
							<button type="button" class="close" dat-dismiss="modal" aria-label="Close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
							<?php if (!empty($erreurs)):?>
	                            <div class="alert alert-danger">
	                                <strong><p>Impossible de créer un compte pour les raisons suivantes :</p></strong>
	                                    <ul>
	                                        <?php foreach($erreurs as $erreur): ?>
	                                            <li><?= $erreur;?></li>
	                                        <?php endforeach ?>
	                                    </ul>
	                            </div>
	                        <?php endif;?>
						<form action="Create.php"method="post"enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-row">
									<div class="input-group form-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="far fa-user"></i></span>
										</div>
										<input name="name"type="text"placeholder="Entrer votre nom"value="<?php echo !empty($name)?$name:'';?>">
									</div>
									<div class="input-group form-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-at"></i></span>
										</div>
										<input name="email"type="email"placeholder="Entrer votre E-Mail-Adresse"value="<?php echo !empty($email)?$email:'';?>">
									</div>
									<div class="input-group form-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
										</div>
										<input name="mobile"type="tel"placeholder="Entrer votre numéro de téléphone"value="<?php echo !empty($mobile)?$mobile:'';?>">
								</div>
							</div>
						</form>
                    <div class="modal-footer">
                      <div class="form-group text-while">
                        <input type="submit" name="login" value="Ajouter"class="btn float-right text-black">
                        <input type="reset"value="Annuler"class="btn float-right text-black"data-dismiss="modal">
                      </div>
                    </div>
                  </div>
                </form>
        </div>
    </div>
</div>
		<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/all.js"></script>
		<!-- Your custom scripts (optional) -->
	</body>
</html>