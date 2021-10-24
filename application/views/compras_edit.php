<div class="wrapper">
	<div class="crumb">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url('home')?>"><i class="icon16 i-home-4"></i>Home</a></li>
					  <li><i class="icon16"></i>Operaciones</li>
                      <li><a href="<?php echo site_url('compras/show')?>"><i class="icon16"></i>Compras</a></li>
                      <li class="active">Editar</li>
                    </ul>
                </div>
                                <div class="container-fluid">
                    
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="panel panel-default">
							
                                <div class="panel-heading">
                                    <div class="icon"><i class="icon20 i-table"></i></div> 
                                    <h4>Compras</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .panel-heading -->
                            
                                <div class="panel-body">
                                
									<?php if (isset($_GET['empresa_id'])): ?>
									<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('compras/save?empresa_id='.$_GET['empresa_id']); ?>">
									<?php else: ?>
									<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('compras/save'); ?>">
									<?php endif; ?>
                                	 
										<?php include_partial('compras_form', array('compra' => $compra, 'proveedores' => $proveedores)); ?>
                                    </form>									
                                
                                </div><!-- End .panel-body -->
                            </div><!-- End .widget -->
                                                
                        </div><!-- End .col-lg-12  -->                     
                                            
                    </div><!-- End .row-fluid  -->

                </div> <!-- End .container-fluid  -->
            </div> <!-- End .wrapper  -->
