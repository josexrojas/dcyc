            <div class="wrapper">
                <div class="crumb">
                    <ul class="breadcrumb">
                      <li><a href="#"><i class="icon16 i-home-4"></i>Home</a></li>
					  <li><a href="#"><i class="icon16"></i>Configuración</a></li>
					  <li class="active">Padrón de CUIT</li>
                    </ul>
                </div>
                                <div class="container-fluid">
                    
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="icon"><i class="icon20 i-menu-6"></i></div>
                                    <h4>Padrón de CUIT</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .panel-heading -->
                            
                                <div class="panel-body">
                                    
                                    <?php if (!$in_progress) : ?>
                                    
                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('padron/do_upload');?>">
										
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Seleccione el archivo .ZIP<br />Recuerde que este proceso dura varios minutos</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="file" name="file">
                                            </div>
                                        </div>
										

                                        <div class="form-group">
                                            
                                            <div class="col-lg-offset-2">
                                                <div class="pad-left15">
                                                    <button type="submit" class="btn btn-primary">Cargar</button>
                                                    <button type="button" class="btn">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                            
                                    </form>
                                    
                                    <?php else: ?>
                                    
                                    	Porcentaje de importación completado: <?php print number_format($progress, 2); ?>%
                                    	 
                                    <?php endif; ?>

                                </div><!-- End .panel-body -->
                            </div><!-- End .widget -->
                                                
                        </div><!-- End .col-lg-12  -->                     
                                            
                    </div><!-- End .row-fluid  -->

                </div> <!-- End .container-fluid  -->
            </div> <!-- End .wrapper  -->
