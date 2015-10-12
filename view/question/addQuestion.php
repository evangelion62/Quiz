<h1>ajout de question</h1>

<form action="?controler=question&action=add" method="POST">
	<label for="question">question</label>
	<input type="text" id="question" name="question"><br>
	<label for="rep1">reponse 1</label>
	<input type="text" id="rep1" name="rep1"><br>
	<label for="rep2">reponse 2</label>
	<input type="text" id="rep2" name="rep2"><br>
	<label for="rep3">reponse 3</label>
	<input type="text" id="rep3" name="rep3"><br>
	<label for="rep4">reponse 4</label>
	<input type="text" id="rep4" name="rep4"><br>
	<label for="rep">bonne reponse</label>
	<select id='rep 'name="rep">

    	<option value="rep1">rep1</option>

    	<option value="rep2">rep2</option>

    	<option value="rep3">rep3</option>

    	<option value="rep4">rep4</option>
	</select><br>
	<select id='themeid' name="themeid">
		<?php
			foreach ($themes as $theme) {
		?>
		<option value="<?php echo $theme->id()?>"><?php echo $theme->theme()?></option>
		<?php
			} 
		?>
	</select>
	<input type="submit">
</form>