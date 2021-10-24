<div class="wrapper">
	<div class="crumb">
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('home')?>"><i
					class="icon16 i-home-4"></i>Home</a></li>
			<li class="active">Compras</li>
		</ul>
	</div>
	<div class="container-fluid">

		<div class="row">

			<div class="col-lg-12">

				<div class="panel panel-default">

					<div class="panel-heading">
						<div class="icon">
							<i class="icon20 i-table"></i>
						</div>
						<h4>Compras</h4>
						<a href="#" class="minimize"></a>
					</div>
					<!-- End .panel-heading -->

					<div class="panel-body">

						<?php if (isset($_GET['empresa_id'])): ?>
						<form method="post" action="<?php echo site_url('compras/show_pagar?empresa_id='.$_GET['empresa_id']); ?>">
						<?php else: ?>
						<form method="post" action="<?php echo site_url('compras/show_pagar'); ?>">
						<?php endif; ?>

							<?php if ($this->input->get('empresa_id')): ?>
							<a href="<?php echo site_url('compras/create?empresa_id='.$this->input->get('empresa_id'))?>" class="btn btn-primary">Nueva compra</a>
							<?php else: ?>
							<a href="<?php echo site_url('compras/create')?>" class="btn btn-primary">Nueva compra</a>
							<?php endif; ?>
					
							<button type="submit" class="btn btn-inverse">Pagar seleccionados</button>
							<br>
							<br>

							<table class="table table-striped table-bordered table-hover"
								id="dataTable">
								<thead>
									<tr>
										<th style="display: none;"></th>
										<th></th>
										<th>Fecha</th>
										<th>Tipo</th>
										<th>N° Comprobante</th>
										<th>Proveedor</th>
										<th>Importe</th>
										<th>Saldo a pagar</th>
										<th>Descripción</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($compras as $compra ): ?>
									<tr class="gradeX">
										<td style="display: none"></td>
										<td><input name="id[]" value="<?php echo $compra->get('id'); ?>" type="checkbox" <?php  $t = $this->input->post('id'); echo in_array($compra->get('id'), is_array($t) ? $t : array()) ? 'checked' : ''?>></td>
										<td><?php echo $compra->get('fecha_comprobante'); ?></td>
										<td><?php echo $compra->get('letra_comprobante'); ?></td>
										<td><?php echo $compra->get('numero_comprobante'); ?></td>
										<td><?php echo $compra->get_proveedor()->get('nombre_fantasia'); ?></td>
										<td align="right"><?php echo number_format($compra->get('importe_neto'), 2); ?></td>
										<td align="right"><?php echo number_format($compra->get_saldo(), 2); ?></td>
										<td><?php echo $compra->get('descripcion'); ?></td>
										<td>
											<?php if (isset($_GET['empresa_id'])): ?>
											<a href="<?php echo site_url('compras/view/'.$compra->get('id').'?empresa_id='.$_GET['empresa_id']); ?>" title="Ver" class="i-zoom-in"></a>
											<?php else: ?>
											<a href="<?php echo site_url('compras/view/'.$compra->get('id')); ?>" title="Ver" class="i-zoom-in"></a>
											<?php endif; ?>
											<?php if ($compra->get('certificado_retencion')): ?>
												<a target="_blank" href="<?php echo site_url('compras/retencion_factura/'.$compra->get('id')); ?>" title="Ver certificado de retención" class="i-file"></a>
											<?php endif; //elseif (!$compra->has_ordenespago()): ?>
												<?php if (isset($_GET['empresa_id'])): ?>
												<a href="<?php echo site_url('compras/edit/'.$compra->get('id').'?empresa_id='.$_GET['empresa_id']); ?>" title="Editar" class="i-pencil-5"></a>
												<?php else: ?>
												<a href="<?php echo site_url('compras/edit/'.$compra->get('id')); ?>" title="Editar" class="i-pencil-5"></a>
												<?php endif; ?>
								
												<a href="<?php echo site_url('compras/delete/'.$compra->get('id')); ?>" title="Eliminar" class="i-cancel-circle"></a>
											<?php //endif; ?>
										</td>
									</tr>
									<?php endforeach; ?>                                            
								</tbody>
							</table>
						</form>
					</div>
					<!-- End .panel-body -->
				</div>
				<!-- End .widget -->

			</div>
			<!-- End .col-lg-12  -->

		</div>
		<!-- End .row-fluid  -->

	</div>
	<!-- End .container-fluid  -->
</div>
<!-- End .wrapper  -->
