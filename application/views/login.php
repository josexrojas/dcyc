<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>DCyC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="PIPE-it" />
	
    <!-- Headings -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700' rel='stylesheet' type='text/css'>
    <!-- Text -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' />

     <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:800" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->

    <!-- Core stylesheets do not remove -->
    <link href="<?php echo base_url('css/bootstrap/bootstrap.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/bootstrap/bootstrap-theme.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/icons.css');?>" rel="stylesheet" />

    <!-- Plugins stylesheets -->
    <link href="<?php echo base_url('js/plugins/forms/uniform/uniform.default.css');?>" rel="stylesheet" /> 

    <!-- app stylesheets -->
    <link href="<?php echo base_url('css/app.css');?>" rel="stylesheet" /> 

    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="<?php echo base_url('css/custom.css');?>" rel="stylesheet" /> 

    <!--[if IE 8]><link href="<?php echo base_url('css/ie8.css');?>" rel="stylesheet" type="text/css" /><![endif]-->

    <!-- Force IE9 to render in normal mode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url('js/html5shiv.js');?>"></script>
      <script src="<?php echo base_url('js/respond.min.js');?>"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('images/ico/apple-touch-icon-144-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('images/ico/apple-touch-icon-114-precomposed.png');?>">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('images/ico/apple-touch-icon-72-precomposed.png');?>">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('images/ico/apple-touch-icon-57-precomposed.png');?>">
                                   <link rel="shortcut icon" href="<?php echo base_url('images/ico/favicon.png');?>">
    
    <!-- Le javascript
    ================================================== -->
    <!-- Important plugins put in all pages -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url('js/bootstrap/bootstrap.js');?>"></script>  
    <script src="<?php echo base_url('js/conditionizr.min.js');?>"></script>  
    <script src="<?php echo base_url('js/plugins/core/nicescroll/jquery.nicescroll.min.js');?>"></script>
    <script src="<?php echo base_url('js/plugins/core/jrespond/jRespond.min.js');?>"></script>
    <script src="<?php echo base_url('js/jquery.genyxAdmin.js');?>"></script>

    <!-- Form plugins -->
    <script src="<?php echo base_url('js/plugins/forms/uniform/jquery.uniform.min.js');?>"></script>
    <script src="<?php echo base_url('js/plugins/forms/validation/jquery.validate.js');?>"></script>

    <!-- Init plugins -->
    <script src="<?php echo base_url('js/app.js');?>"></script><!-- Core js functions -->
    <script src="<?php echo base_url('js/pages/login.js');?>"></script><!-- Init plugins only for page -->

  </head>
  <body>
    <div class="container-fluid">
        <div id="login">
            <div class="login-wrapper" data-active="log">
                <div id="log">
                    <div id="avatar">
                        <img src="<?php echo base_url('images/logo.jpg');?>" class="img-responsive">
                    </div>
                    <div class="page-header">
                        <h3 class="center">Iniciar sesi??n</h3>
                    </div>
                    <form role="form" id="login-form" class="form-horizontal" method="post" action="<?php echo site_url('login/loginuser');?>">
                        <div class="row">
                            <div class="form-group relative">
                                <div class="icon"><i class="icon20 i-user"></i></div>
                                <input class="form-control" type="text" name="user" id="user" placeholder="E-mail" >
                                
                            </div><!-- End .control-group  -->
                            <div class="form-group relative">
                                <div class="icon"><i class="icon20 i-key"></i></div>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Contrase??a">
                                
                            </div><!-- End .control-group  -->
                            <div class="form-group relative">
                                <button id="loginBtn" type="submit" class="btn btn-primary pull-right col-lg-5">Login</button>
                            </div>
                        </div><!-- End .row-fluid  -->
                    </form>
                </div>
                
            </div>
            <div id="bar" data-active="log">
                <div class="btn-group btn-group-vertical">
                    <a id="log" href="#" class="btn tipR" title="Login"><i class="icon16 i-key"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
  </body>
</html>