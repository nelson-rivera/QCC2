
<?php
include_once './includes/password.php';
echo password_hash('12345', PASSWORD_BCRYPT, array("cost" => 10)); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once './includes/libraries.php';
    include_once './includes/lang/text.es.php';
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">

    <title><?= txt_title() ?></title>
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
                    <form id="frm-login" name="frm-login" style="margin-bottom: 0px !important;" class="form-horizontal">
                        <div class="content">
                            <h4 class="title">Login Access</h4>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" placeholder="Username" id="username" name="username" class="form-control" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" placeholder="Password" id="password" name="password" class="form-control" required >
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="foot">
                            <button class="btn btn-primary" data-dismiss="modal" type="submit">Log me in</button>
                        </div>
                        <div class="foot" id="div_message" >
                            
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="text-center out-links"><a href="#">&copy; <?= date('Y') ?> QCC</a></div>
	</div> 
	
    </div>

    <?= js_jquery() ?>
    <?= js_jquery_ui() ?>
    <?= js_bootstrap_datetimepicker() ?>
    <?= js_jquery_nanoscroller() ?>
    <?= js_jquery_nestable() ?>
    <?= js_bootstrap_switch() ?>
    <?= js_select2() ?>
    <?= js_bootstrap_slider() ?>
    <?= js_general() ?>
    <?= js_jquery_parsley() ?>
    <?= js_i18n_es() ?>
    
    <script type="text/javascript">
        $(document).ready(function(){
        //initialize the javascript
        window.ParsleyValidator.setLocale('es');
        $("#frm-login").parsley().subscribe('parsley:form:validate', function (formInstance) {
            formInstance.submitEvent.preventDefault();
                if(formInstance.isValid('', true)){
                    $.ajax({
                        url: "ajax/login.php",
                        data: $("#frm-login").serialize(),
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.status == "0") {
                                location.href = "index.php";
                            }
                            else {
                                $("#div_message").html('<div class="alert alert-danger alert-white rounded">'
                                    +'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'
                                    +'<div class="icon"><i class="fa fa-times-circle"></i></div>'
                                    +response.msg+'</div>');
                            }
                        }
                    });
                }
            });
            return;
        });
        
    </script>
</body>

</html>