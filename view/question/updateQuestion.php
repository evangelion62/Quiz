<h1>modifier la question</h1>

<form action="?controler=question&action=update" method="POST">
	<label for="question">question</label>
	<input type="text" id="question" name="question" value="<?php echo $question->question()?>"><br>
	<label for="rep1">reponse 1</label>
	<input type="text" id="rep1" name="rep1" value="<?php echo $question->rep1()?>"><br>
	<label for="rep2">reponse 2</label>
	<input type="text" id="rep2" name="rep2" value="<?php echo $question->rep2()?>"><br>
	<label for="rep3">reponse 3</label>
	<input type="text" id="rep3" name="rep3" value="<?php echo $question->rep3()?>"><br>
	<label for="rep4">reponse 4</label>
	<input type="text" id="rep4" name="rep4" value="<?php echo $question->rep4()?>"><br>
	<label for="rep">bonne reponse</label>
	<select id='rep 'name="rep" value="<?php echo $question->rep()?>">

    	<option value="rep1" <?php if ($question->rep()=='rep1'){echo 'selected="selected"';}?>>rep1</option>

    	<option value="rep2" <?php if ($question->rep()=='rep2'){echo 'selected="selected"';}?>>rep2</option>

    	<option value="rep3" <?php if ($question->rep()=='rep3'){echo 'selected="selected"';}?>>rep3</option>

    	<option value="rep4" <?php if ($question->rep()=='rep4'){echo 'selected="selected"';}?>>rep4</option>
	</select><br>
	<select id='themeid' name="themeid">
		<?php
			foreach ($themes as $theme) {
		?>
		<option value="<?php echo $theme->id()?>" <?php if($question->themeid()==$theme->id()){echo 'selected="selected"';}?>><?php echo $theme->theme()?></option>
		<?php
			} 
		?>
	</select>
	<input type="hidden" id="id" name="id" value="<?php echo $question->id()?>">
	<input type="submit">
</form>
