<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="?controler=index">Quiz</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="?controler=game">Play</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">parametres <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="?controler=theme&action=list">Thémes</a></li>
            <li><a href="?controler=question&action=list">Questions</a></li>
            <li><a href="?controler=user&action=list">Utilisateurs</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="?controler=csv&action=upload">Upload csv</a></li>
<!--             <li role="separator" class="divider"></li> -->
<!--             <li><a href="#">One more separated link</a></li> -->
          </ul>
        </li>
      </ul>
      <?php if (isset($_SESSION['token'])){?>
      <form class="navbar-form navbar-right" action="?controler=user&action=logout" method="post">
        <button type="submit" class="btn btn-default">Déconnexion</button>
      </form>
      <?php }else{?>
      <form class="navbar-form navbar-right" action="?controler=user&action=login" method="post">
        <div class="form-group">
          <input type="text" class="form-control" id="login" name="login" placeholder="Identifiant">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Mot de passe">
        </div>
        <button type="submit" class="btn btn-default">Connexion</button>
      </form>
      <?php }?>
<!--       <ul class="nav navbar-nav navbar-right"> -->
<!--         <li><a href="#">Link</a></li> -->
<!--         <li class="dropdown"> -->
<!--           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a> -->
<!--           <ul class="dropdown-menu"> -->
<!--             <li><a href="#">Action</a></li> -->
<!--             <li><a href="#">Another action</a></li> -->
<!--             <li><a href="#">Something else here</a></li> -->
<!--             <li role="separator" class="divider"></li> -->
<!--             <li><a href="#">Separated link</a></li> -->
<!--           </ul> -->
<!--         </li> -->
<!--       </ul> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>