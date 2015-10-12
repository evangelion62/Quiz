<h1>Question</h1>
<p><?php echo $question->question()?><p>
<form action="?controler=game&action=checkrep" method="POST">
	<select id="rep" name"rep">
		<option value="rep1"><?php echo $question->rep1()?></option>
		<option value="rep2"><?php echo $question->rep2()?></option>
		<option value="rep3"><?php echo $question->rep3()?></option>
		<option value="rep4"><?php echo $question->rep4()?></option>
	</select>
	<input type="submit">
</form>