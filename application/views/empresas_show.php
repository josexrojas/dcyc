<div class="wrapper">
	<div class="crumb">
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('home')?>"><i
					class="icon16 i-home-4"></i>Home</a></li>
			<li class="active">Empresas</li>
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
						<h4>Empresas</h4>
						<a href="#" class="minimize"></a>
					</div>
					<!-- End .panel-heading -->

					<div class="panel-body">

						<a href="<?php echo site_url('empresas/create')?>"
							class="btn btn-primary">Nueva empresa</a> <br>
						<br>

						<table class="table table-striped table-bordered table-hover"
							id="dataTable">
							<thead>
								<tr>
									<th style="display: none;"></th>
									<th>CUIT</th>
									<th>IIBB</th>
									<th>Condición IVA</th>
									<th>Razón social</th>
									<th>Nombre fantasía</th>
									<th>Teléfono</th>
									<th>E-mail</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($empresas as $empresa): ?>
								<tr class="gradeX">
									<td style="display: none"></td>
									<td><?php echo $empresa->get('cuit'); ?></td>
									<td><?php echo $empresa->get('iibb'); ?></td>
									<td><?php echo $empresa->get_condicion()->get('descripcion'); ?></td>
									<td><?php echo $empresa->get('razon_social'); ?></td>
									<td><?php echo $empresa->get('nombre_fantasia'); ?></td>
									<td><?php echo $empresa->get('telefono'); ?></td>
									<td><?php echo $empresa->get('email'); ?></td>
									<td>
										<a href="<?php echo site_url('empresas/edit/'.$empresa->get('id')); ?>" class="i-pencil-5"  title="Editar"></a>
										<a href="<?php echo site_url('compras/show?empresa_id='.$empresa->get('id')); ?>" class="i-zoom-in" title="Ver facturas"></a>
										<a href="<?php echo site_url('empresas/delete/'.$empresa->get('id')); ?>" class="i-cancel-circle" title="Eliminar"></a>
									</td>
								</tr>
								<?php endforeach; ?>      
							</tbody>
						</table>
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
