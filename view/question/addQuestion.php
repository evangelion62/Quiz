<script src="lib/ckeditor/ckeditor.js"></script>
<div class="jumbotron">
	<h1>ajout de question</h1>
	<br>
	<form action="?controler=question&action=add" method="POST" class="form-horizontal">
		<div class="form-group">
			<label for="question" class="col-sm-2 control-label">Question</label>
			<div class="col-sm-10">
				<textarea name="question" id="question" rows="10" cols="80">
            	</textarea>
			</div>
		</div>
		<br>
		<div class="form-group">
			<label for="rep1" class="col-sm-2 control-label">reponse 1</label>
			<div class="col-sm-10">
				<input type="text" id="rep1" name="rep1" class="form-control">
			</div>
		</div>
		
		<div class="form-group">
			<label for="rep2" class="col-sm-2 control-label">reponse 2</label>
			<div class="col-sm-10">
				<input type="text" id="rep2" name="rep2" class="form-control">
			</div>
			</div>
		
		<div class="form-group">
			<label for="rep3" class="col-sm-2 control-label">reponse 3</label>
			<div class="col-sm-10">
				<input type="text" id="rep3" name="rep3" class="form-control">
			</div>
			</div>
		
		<div class="form-group">
			<label for="rep4" class="col-sm-2 control-label">reponse 4</label>
			<div class="col-sm-10">
				<input type="text" id="rep4" name="rep4" class="form-control">
			</div>
		</div>
		
		<br>
		<div class="form-group">
			<label for="rep" class="col-sm-2 control-label">bonne reponse</label>
			<div class="col-sm-10">
				<select id='rep 'name="rep" class="form-control">
			
			    	<option value="rep1">reponse 1</option>
			
			    	<option value="rep2">reponse 2</option>
			
			    	<option value="rep3">reponse 3</option>
			
			    	<option value="rep4">reponse 4</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="themeid" class="col-sm-2 control-label">théme</label>
			<div class="col-sm-10">
				<select id='themeid' name="themeid" class="form-control">
					<?php
						foreach ($themes as $theme) {
					?>
					<option value="<?php echo $theme->id()?>"><?php echo $theme->theme()?></option>
					<?php
						} 
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
   			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-default" value="Ajouter">
			</div>
		</div>
		<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'question' );
        </script>
	</form>
</div>