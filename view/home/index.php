<div class="col-lg-2 col-md-1"></div>
<div id="carousel-example-generic" class="carousel slide col-lg-8 col-md-10" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  <?php 
  $cmpt=0;
  foreach ($themes as $theme) {?>
    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $cmpt;?>" <?php if($cmpt == 0){echo' class="active"';}?>></li>
  <?php 
		$cmpt++;
	}?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <?php 
  $cmpt = 0;
  foreach ($themes as $theme) {?>
    <div class="item <?php if($cmpt == 0){echo 'active';$cmpt++;}?>">
    <a href="?controler=game&action=starttheme&id=<?php echo $theme->id();?>">
      <img src="web/img/quiz.jpg" alt="quiz" style="text-align: center;">
      <div class="carousel-caption" style="font-size: 4.5em">
       <span ><?php echo $theme->theme();?></span>
      </div>
     </a>
    </div>
<?php }?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>