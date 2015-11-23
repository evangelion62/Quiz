<div class="jumbotron">
<h1>Selection du fichier</h1>
<form action="?controler=question&action=csvImport" method="post">
<div class="form-group">
	<select size="10" id="file" name="file">
	<?php foreach ($files as $file) {
		echo '<option value="'.$file.'">'.$file.'</option>';
	}?>
	</select>
</div>
<input class="btn btn-default" type="submit" value="Importer">
</form>
</div>
<div class="jumbotron">
<h1>Envoyé un nouveau fichier</h1>
<form action="?controler=csv&action=upload" method="post" enctype="multipart/form-data">
	<div class="form-group">
	    <label for="file">Import Ficher de Questions</label>
	    <input type="file" id="file" name="file">
	    <p class="help-block">Veuillé selectioner votre fichier de question au format csv.</p>
 	</div>
 	
 	<button type="submit" name="submit" class="btn btn-default">Envoyer</button>
</form>
</div>