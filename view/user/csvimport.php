<h2><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Import de fichier de question</h2>
<div class="jumbotron col-sm-5">
<h3><span class="glyphicon glyphicon-import" aria-hidden="true"></span> Selection du fichier</h3>
<form action="?controler=user&action=csvImport" method="post">
<div class="form-group">
	<select id="file" name="file">
	<?php foreach ($files as $file) {
		echo '<option value="'.$file.'">'.$file.'</option>';
	}?>
	</select>
	 <p class="help-block">Selectioner votre fichier.</p>
</div>
<input class="btn btn-default" type="submit" value="Importer">
</form>
</div>
<div class="col-sm-1"></div>
<div class="jumbotron col-sm-6">
<h3><span class="glyphicon glyphicon-open" aria-hidden="true"></span> Envoyer un nouveau fichier</h3>
<form action="?controler=csv&action=upload" method="post" enctype="multipart/form-data">
	<div class="form-group">
	    <input type="file" id="file" name="file">
	    <p class="help-block">Selectioner votre fichier au format csv.</p>
 	</div>
 	
 	<button type="submit" name="submit" class="btn btn-default">Envoyer</button>
</form>
</div>