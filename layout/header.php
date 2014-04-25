<?php include("lib/mongo.php");
    $mongoDB = new MongoHelper();
    $adminDB = $mongoDB->getDb("admin");
?>
<html>
	<head>
		<title>MongoAdmin for Sharding</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">MongoAdmin</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a href="index.php">Shards</a></li>
                <li><a href="databases.php">Databases</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">MongoDB Connection</a></li>
		          </ul>
		        </li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">About <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">v. 1.0.0</a></li>
		            <li><a href="#">Javier De la Hoz</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</head>
    <div style="height: 55px"></div>
	<body>
    <div class="container">
    <?php if(!$mongoDB->isMongos()): ?>
        <div class="alert alert-block alert-danger">This is not a MONGOS instance</div>
    <?php
        die();
        endif;
    ?>
        <?php if(!empty($_GET['error'])){ ?>
            <div class="alert alert-block alert-danger">Error: <?php echo $_GET['error']; ?></div>
        <?php } ?>
        <?php if(!empty($_GET['success'])){ ?>
            <div class="alert alert-block alert-success"><?php echo $_GET['success']; ?></div>
        <?php } ?>