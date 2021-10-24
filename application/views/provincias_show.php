<div class="wrapper">
                <div class="crumb">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url('home')?>"><i class="icon16 i-home-4"></i>Home</a></li>
					  <li><i class="icon16"></i>Configuración</li>
                      <li class="active">Provincias</li>
                    </ul>
                </div>
                                <div class="container-fluid">
                    
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="panel panel-default">
							
                                <div class="panel-heading">
                                    <div class="icon"><i class="icon20 i-table"></i></div> 
                                    <h4>Provincias</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .panel-heading -->
                            
                                <div class="panel-body">
								
								<a href="<?php echo site_url('provincias/create')?>" class="btn btn-primary">Nueva provincia</a> <br><br>
                                    
                                    <table class="table table-striped table-bordered table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th style="display:none;"></th>
												<th>País</th>
												<th>Provincia</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($provincias as $provincia): ?>
                                            <tr class="gradeX">
                                                <td style="display:none"></td>
												<td><?php echo $provincia->get_pais()->get('descripcion'); ?></td>
												<td><?php echo $provincia->get('descripcion'); ?></td>
												<td>
													<a href="<?php echo site_url('provincias/edit/'.$provincia->get('id')); ?>" class="i-pencil-5"></a>
													<a href="<?php echo site_url('provincias/delete/'.$provincia->get('id')); ?>"class="i-cancel-circle"></a>
												</td>
                                            </tr>
                                            <?php endforeach; ?>                                            
                                        </tbody>
                                    </table>
                                </div><!-- End .panel-body -->
                            </div><!-- End .widget -->
                                                
                        </div><!-- End .col-lg-12  -->                     
                                            
                    </div><!-- End .row-fluid  -->

                </div> <!-- End .container-fluid  -->
            </div> <!-- End .wrapper  -->
