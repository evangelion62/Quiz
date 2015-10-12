<h1>modifier la theme</h1>
<form action="?controler=theme&action=update" method="POST">
	<label for="theme">theme</label>
	<input type="text" id="theme" name="theme" value="<?php echo $theme->theme()?>"><br>
	<input type="hidden" id="id" name="id" value="<?php echo $theme->id()?>">
	<input type="submit">
</form>
