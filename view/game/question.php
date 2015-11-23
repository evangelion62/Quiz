<div class="jumbotron">
<h1>Question n°<?php echo ($_SESSION['lastquestion']+1)?></h1>
<p><?php echo $question->question()?><p>
<form action="?controler=game&action=checkrep" method="POST">
<!-- 	<select id="rep" name="rep" size="4">
		<option value="rep1"><?php echo $question->rep1()?></option>
		<option value="rep2"><?php echo $question->rep2()?></option>
		<option value="rep3"><?php echo $question->rep3()?></option>
		<option value="rep4"><?php echo $question->rep4()?></option>
</select> -->
	<label>
	<input type="radio" name="rep" value="rep1">
	<?php echo $question->rep1()?>
	</label>
	<br>
	<label>
	<input type="radio" name="rep" value="rep2">
	<?php echo $question->rep2()?>
	</label>
	<br>
	<label>
	<input type="radio" name="rep" value="rep3">
	<?php echo $question->rep3()?>
	</label>
	<br>
	<label>
	<input type="radio" name="rep" value="rep4">
	<?php echo $question->rep4()?>
	</label>
	
	<input id="qid" name="qid" type="hidden" value="<?php echo $question->id()?>"><br><br>
	<input class="btn btn-primary btn-lg" type="submit">
</form>
</div>