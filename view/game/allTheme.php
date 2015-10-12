<div class="row">
<?php foreach ($themes as $theme) {?>
  <div class="col-xs-6 col-md-3">
    <div class="thumbnail">
      <img src="web/img/quiz.jpg" alt="quiz">
		<div class="caption">
        <h3><?php echo $theme->theme();?></h3>
        <p><a href="?controler=game&action=starttheme&id=<?php echo $theme->id()?>" class="btn btn-primary" role="button">Lancer</a></p>
      </div>
    </div>
  </div>
<?php }?>
</div>