<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once './includes/libraries.php';
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Clean Zone</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <?= css_bootstrap() ?>
    <?= css_font_awesome() ?>


    <!-- Custom styles for this template -->
    <?= css_style() ?>

</head>

<body class="texture">

    <div id="cl-wrapper" class="login-container">

	<div class="middle-login">
            <div class="block-flat">
                <div class="header">							
                        <h3 class="text-center"><img class="logo-img" src="images/logo.png" alt="logo"/>QCC</h3>
                </div>
                <div>
                    <form style="margin-bottom: 0px !important;" class="form-horizontal" action="index.php">
                        <div class="content">
                            <h4 class="title">Login Access</h4>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" placeholder="Username" id="username" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" placeholder="Password" id="password" class="form-control">
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="foot">
                            <button class="btn btn-primary" data-dismiss="modal" type="submit">Log me in</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center out-links"><a href="#">&copy; <?= date('Y') ?> QCC</a></div>
	</div> 
	
    </div>

    <?= js_jquery() ?>
    <?= js_general() ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>