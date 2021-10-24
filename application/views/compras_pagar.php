<div class="wrapper">
	<div class="crumb">
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('home')?>"><i
					class="icon16 i-home-4"></i>Home</a></li>
			<li><i class="icon16"></i>Operaciones</li>
			<li><a href="<?php echo site_url('compras/show')?>"><i class="icon16"></i>Compras</a></li>
			<li class="active">Órden de pago</li>
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
						<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('compras/pagar?empresa_id='.$_GET['empresa_id']); ?>"> 
						<?php else: ?>
						<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('compras/pagar'); ?>"> 
						<?php endif; ?>

							<?php if (!$ordenpago->get('id')) { ?>
							
								<div class="form-group">
									<label class="col-lg-2 control-label" for="normal">Importe a pagar</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="importe_pagado" value="<?php echo $ordenpago->get('importe_neto'); ?>" />
                                    </div>
									<div class="col-lg-1">
										<button type="submit" id="recalcular" class="btn btn-primary">Recalcular</button>
									</div>
									
								</div>
								
							<?php } ?>
							
							<?php include_partial('ordenpago', array('ordenpago' => $ordenpago)); ?>
							
							<div class="form-group">

								<div class="pad-left15">
									<button type="submit" class="btn btn-primary">Guardar
										definitivamente</button>
									<?php if (isset($_GET['empresa_id'])): ?>
									<a href="<?php echo site_url('compras/show?empresa_id='.$_GET['empresa_id'] )?>" class="btn">Cancelar</a>
									<?php else: ?>
									<a href="<?php echo site_url('compras/show')?>" class="btn">Cancelar</a>
									<?php endif; ?>
								</div>

							</div>

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

<script type="text/javascript">
$(document).ready(function () {
	$('#recalcular').on('click', function() {
		$('form').removeAttr('action');
	});
});
</script>