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
    <link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
    
    <!-- Plugins stylesheets -->
    <link href="<?php echo base_url('js/plugins/forms/uniform/uniform.default.css');?>" rel="stylesheet" /> 
    <link href="<?php echo base_url('js/plugins/tables/datatables/jquery.dataTables.css');?>" rel="stylesheet" /> 

    <!-- app stylesheets -->
    <link href="<?php echo base_url('css/app.css');?>" rel="stylesheet" /> 

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
    <script src="<?php echo base_url('js/select2.min.js');?>"></script>
    
    <!-- Form plugins -->
    <script src="<?php echo base_url('js/plugins/forms/uniform/jquery.uniform.min.js');?>"></script>

    <!-- Tables plugins -->
    <script src="<?php echo base_url('js/plugins/tables/datatables/jquery.dataTables.min.js');?>"></script>

    <!-- Init plugins -->
    <script src="<?php echo base_url('js/app.js');?>"></script><!-- Core js functions -->
    <script src="<?php echo base_url('js/pages/data-tables.js');?>"></script><!-- Init plugins only for page -->

  </head>
  <body>
    <header id="header">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <a class="navbar-brand" href="dashboard.html"><img src="<?php echo base_url('images/logo.jpg');?>" alt="DCyC" class="img-responsive" style="width: 33px;"></a>
            <button type="button" class="navbar-toggle btn-danger" data-toggle="collapse" data-target="#navbar-to-collapse">
                <span class="sr-only">Menu</span>
                <i class="icon16 i-arrow-8"></i>
            </button>          
            <div class="collapse navbar-collapse" id="navbar-to-collapse">  
                <ul class="nav navbar-nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="dropdown user">
                         <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                            <img src="<?php echo base_url('images/avatars/no_avatar.jpg');?>" alt="sugge">
                            <span class="more"><i class="icon16 i-arrow-down-2"></i></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="<?php echo site_url('login/logout'); ?>" class=""><i class="icon16 i-exit"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <li class="divider-vertical"></li>
                </ul>
            </div><!--/.nav-collapse -->
        </nav>
    </header> <!-- End #header  -->
    <div class="main">
        <aside id="sidebar">
            <div class="side-options">
                <ul>
                    <li><a href="#" id="collapse-nav" class="act act-primary tip" title="Mostrar/Ocultar"><i class="icon16 i-arrow-left-7"></i></a></li>
                </ul>
            </div>

            <div class="sidebar-wrapper">
                <nav id="mainnav">
                    <ul class="nav nav-list">
                        <li>
                            <a href="<?php echo site_url('empresas'); ?>">
                                <span class="icon"><i class="icon20 i-menu-6"></i></span>
                                <span class="txt">Empresas</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="icon20 i-cube-3"></i></span>
                                <span class="txt">Operaciones</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="<?php echo site_url('compras'); ?>">
                                        <span class="icon"><i class="icon20 i-stack-list"></i></span>
                                        <span class="txt">Compras</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('ventas'); ?>">
                                        <span class="icon"><i class="icon20 i-stack-star"></i></span>
                                        <span class="txt">Ventas</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
						<li>
                            <a href="#">
                                <span class="icon"><i class="icon20 i-file-8"></i></span>
                                <span class="txt">Informes</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="<?php echo site_url('compras/ver_retenciones_arba'); ?>">
                                        <span class="icon"><i class="icon20 i-file-9"></i></span>
                                        <span class="txt">Retenciones</span>
                                    </a>
								</li>
								<li>
									<a href="<?php echo site_url('compras/retenciones_arba'); ?>">
										<span class="icon"><i class="icon20  i-file-download-2"></i></span>
										<span class="txt">TXT Retenciones</span>
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('ventas/ver_percepciones_arba'); ?>">
										<span class="icon"><i class="icon20 i-file-9"></i></span>
										<span class="txt">Percepciones</span>
									</a>
								</li>								
								<li>
									<a href="<?php echo site_url('ventas/percepciones_arba'); ?>">
										<span class="icon"><i class="icon20  i-file-download-2"></i></span>
										<span class="txt">TXT Percepciones</span>
									</a>
								</li>
							</ul>
						</li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="icon20 i-cogs"></i></span>
                                <span class="txt">Configuración</span>
                            </a>
                            <ul class="sub">
								<li>
                                    <a href="<?php echo site_url('miempresa'); ?>">
                                        <span class="icon"><i class="icon20 i-newspaper"></i></span>
                                        <span class="txt">Mi empresa</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('usuarios'); ?>">
                                        <span class="icon"><i class="icon20 i-users"></i></span>
                                        <span class="txt">Usuarios</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('paises'); ?>">
                                        <span class="icon"><i class="icon20 i-file"></i></span>
                                        <span class="txt">Paises</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('provincias'); ?>">
                                        <span class="icon"><i class="icon20 i-file"></i></span>
                                        <span class="txt">Provincias</span>
                                    </a>
                                </li>
								<li>
                                    <a href="<?php echo site_url('padron'); ?>">
                                        <span class="icon"><i class="icon20 i-file-upload-2"></i></span>
                                        <span class="txt">Padrón de CUIT</span>
                                    </a>
                                </li>
                            </ul>
                        </li>                        
                    </ul>
                </nav> <!-- End #mainnav -->
            </div> <!-- End .sidebar-wrapper  -->
        </aside><!-- End #sidebar  -->

        <section id="content">

        	<?php if (session_flashdata('message')) { ?>
            <div id="mensaje" style="margin-top: 10px;">  
                <?php if (session_flashdata('level') == LoginController::SUCCESS) { ?>
                        <div  class="alert alert-success">
                            <p><strong>CORRECTO! </strong>   <?php echo session_flashdata('message'); ?></p>
                        </div>  
                <?php }elseif (session_flashdata('level') == LoginController::NOTICE) { ?>
                        <div  class="alert alert-info">
                            <p><strong>NOTICE! </strong>   <?php echo session_flashdata('message'); ?></p>
                        </div> 
                <?php } else {?>
                        <div class="alert alert-danger">
                            <p><strong>ERROR! </strong>   <?php echo session_flashdata('message'); ?></p>
                        </div> 
                <?php } ?>
            </div>  
            <?php }?>
        
        	<?php $this->load->view($content_view); ?>    
            
		</section>
    </div><!-- End .main  -->
    
    <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', 'a.i-cancel-circle', function() {
            if (!confirm('¿Confirma la eliminación?'))
                return false;
            return true;
        });

        $('.select2').select2();
    });
    </script>
    
  </body>
</html>            