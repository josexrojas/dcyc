
            <div class="wrapper">
                <div class="crumb">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url('home')?>"><i class="icon16 i-home-4"></i>Home</a></li>
                      <li class="active">Ventas</li>
                    </ul>
                </div>
                                <div class="container-fluid">
                    
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="panel panel-default">
							
                                <div class="panel-heading">
                                    <div class="icon"><i class="icon20 i-table"></i></div> 
                                    <h4>Ventas</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .panel-heading -->
                            
                                <div class="panel-body">
								
									<?php if ($this->input->get('empresa_id')): ?>
									<a href="<?php echo site_url('ventas/create?empresa_id='.$this->input->get('empresa_id'))?>" class="btn btn-primary">Nueva venta</a><br><br>
									<?php else: ?>
									<a href="<?php echo site_url('ventas/create')?>" class="btn btn-primary">Nueva venta</a><br><br>
									<?php endif; ?>
                                	
                                    <table class="table table-striped table-bordered table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th style="display:none;"></th>
                                                <th>Fecha</th>
												<th>Tipo</th>
                                                <th>N° Comprobante</th>
                                                <th>Cliente</th>
                                                <th>Importe</th>
                                                <th>Estado</th>
                                                <th>Descripción</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($ventas as $venta ): ?>
                                            <tr class="gradeX">
                                                <td style="display:none"></td>
                                                <td><?php echo $venta->get('fecha_comprobante'); ?></td>
												<td><?php echo $venta->get('letra_comprobante'); ?></td>
												<td><?php echo $venta->get('numero_comprobante'); ?></td>
												<td><?php echo $venta->get_cliente()->get('razon_social'); ?></td>
												<td align="right">$ <?php echo number_format($venta->get_total(), 2); ?></td>
												<td><?php echo $venta->get('estado'); ?></td>
												<td><?php echo $venta->get('descripcion'); ?></td>
												<td>
													<a href="<?php echo site_url('ventas/edit/'.$venta->get('id')); ?>" class="i-pencil-5"></a>
													<a href="<?php echo site_url('ventas/delete/'.$venta->get('id')); ?>"class="i-cancel-circle"></a>
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
       