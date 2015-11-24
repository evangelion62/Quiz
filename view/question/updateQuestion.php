<div class="jumbotron">
	<div class="col-sm-2"></div>
	<div class="col-sm-10">
		<h2 ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> modifier la question</h2><br>
	</div>
	
	<form action="?controler=question&action=update" method="POST" class="form-horizontal">
		<div class="form-group">
			<label for="question" class="col-sm-2 control-label">question</label>
			<div class="col-sm-10">
				<textarea class="form-control"  rows="3" id="question" name="question"><?php echo $question->question()?></textarea>
			</div>
		</div>
		<br>
		<div class="form-group">
			<label for="rep1" class="col-sm-2 control-label">reponse 1</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" id="rep1" name="rep1" value="<?php echo $question->rep1()?>">
			</div>
		</div>
		<div class="form-group">
			<label for="rep2" class="col-sm-2 control-label">reponse 2</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" id="rep2" name="rep2" value="<?php echo $question->rep2()?>">
			</div>
		</div>
		<div class="form-group">
		<label for="rep3" class="col-sm-2 control-label">reponse 3</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" id="rep3" name="rep3" value="<?php echo $question->rep3()?>">
			</div>
		</div>
		<div class="form-group">
		<label for="rep4" class="col-sm-2 control-label">reponse 4</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" id="rep4" name="rep4" value="<?php echo $question->rep4()?>">
			</div>
		</div>
		<div class="form-group">
			<label for="rep" class="col-sm-2 control-label">bonne reponse</label>
			<div class="col-sm-10">
				<select class="form-control" id='rep 'name="rep" value="<?php echo $question->rep()?>">
			
			    	<option value="rep1" <?php if ($question->rep()=='rep1'){echo 'selected="selected"';}?>>reponse 1</option>
			
			    	<option value="rep2" <?php if ($question->rep()=='rep2'){echo 'selected="selected"';}?>>reponse 2</option>
			
			    	<option value="rep3" <?php if ($question->rep()=='rep3'){echo 'selected="selected"';}?>>reponse 3</option>
			
			    	<option value="rep4" <?php if ($question->rep()=='rep4'){echo 'selected="selected"';}?>>reponse 4</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="rep" class="col-sm-2 control-label">Théme</label>
			<div class="col-sm-10">
				<select  class="form-control" id='themeid' name="themeid">
					<?php
						foreach ($themes as $theme) {
					?>
					<option value="<?php echo $theme->id()?>" <?php if($question->themeid()==$theme->id()){echo 'selected="selected"';}?>><?php echo $theme->theme()?></option>
					<?php
						} 
					?>
				</select>
			</div>
		</div>
		<input type="hidden" id="id" name="id" value="<?php echo $question->id()?>">
		<div class="form-group">
   			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-default" value="Editer">
			</div>
		</div>
	</form>
</div>