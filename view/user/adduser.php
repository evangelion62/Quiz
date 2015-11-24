<div class="jumbotron">
	<h1>ajout d'un nouvel utilisateur</h1>
	<br>
	<form action="?controler=user&action=add" method="POST" class="form-horizontal">
		
		<div class="form-group">
			<label for="lgin" class="col-sm-2 control-label">Nom d'utilisateur</label>
			<div class="col-sm-10">
				<input type="text" id="login" name="login" class="form-control">
			</div>
		</div>
		
		<div class="form-group">
			<label for="pass" class="col-sm-2 control-label">Mot de passe</label>
			<div class="col-sm-10">
				<input type="password" id="pass" name="pass" class="form-control">
			</div>
			</div>
		<div class="form-group">
   			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-default" value="Ajouter">
			</div>
		</div>
	</form>
</div>