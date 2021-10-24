<div class="wrapper">
	<div class="crumb">
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('home')?>"><i
					class="icon16 i-home-4"></i>Home</a></li>
			<li class="active">Informes</li>
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
						<h4>Retenciones</h4>
						<a href="#" class="minimize"></a>
					</div>
					<!-- End .panel-heading -->

					<div class="panel-body">

                    		<form method="post" action="<?php echo site_url('compras/ver_retenciones_arba');?>">
<select name="mes">
                                    <option value="01" <?=($mes == 1) ? "selected=selected" : ""?>>Enero</option>
                                    <option value="02" <?=($mes == 2) ? "selected=selected" : ""?>>Febrero</option>
                                    <option value="03" <?=($mes == 3) ? "selected=selected" : ""?>>Marzo</option>
                                    <option value="04" <?=($mes == 4) ? "selected=selected" : ""?>>Abril</option>
                                    <option value="05" <?=($mes == 5) ? "selected=selected" : ""?>>Mayo</option>
                                    <option value="06" <?=($mes == 6) ? "selected=selected" : ""?>>Junio</option>
                                    <option value="07" <?=($mes == 7) ? "selected=selected" : ""?>>Julio</option>
                                    <option value="08" <?=($mes == 8) ? "selected=selected" : ""?>>Agosto</option>
                                    <option value="09" <?=($mes == 9) ? "selected=selected" : ""?>>Septiembre</option>
                                    <option value="10" <?=($mes == 10) ? "selected=selected" : ""?>>Octubre</option>
                                    <option value="11" <?=($mes == 11) ? "selected=selected" : ""?>>Noviembre</option>
                                    <option value="12" <?=($mes == 12) ? "selected=selected" : ""?>>Diciembre</option>
                                </select>
                                <br /><br />
                                <select name="anio">
									<?php for ($i=2015;$i<=date('Y'); $i++){ ?>
											<option value="<?=$i?>" <?=($anio == $i) ? "selected=selected" : ""?>><?=$i?></option>
										<?php } ?>
                                </select>
                                <br /><br />
                                <input type="submit" class="btn btn-primary" value="Filtrar">	
                                <br /><br />
                             </form>
							
                            
                            <?php 
							
							$total = 0;
							foreach ($retenciones as $retencion)
							{
								$total+= $retencion->get('importe_retencion1');
                            } 
							
							?>
                            <b>Total Retenido: $<?=number_format($total, 2)?></b>
                            <br /><br />
                            

							<table class="table table-striped table-bordered table-hover"
								id="dataTable">
								<thead>
									<tr>
										<th style="display: none;"></th>
										<th># retención</th>
										<th>Fecha</th>
										<th>CUIT</th>
										<th>Proveedor</th>
										<th>Comprobante</th>
										<th>Importe Neto</th>
										<th>Importe Retención</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($retenciones as $retencion): ?>
									<tr class="gradeX">
										<td style="display: none"></td>
										<td><?php echo $retencion->get('certificado_retencion'); ?></td>
										<td><?php echo substr($retencion->get('fecha'), 8, 2)."/".substr($retencion->get('fecha'), 5, 2)."/".substr($retencion->get('fecha'), 0, 4); ?></td>
										<td><?php echo $retencion->get_proveedor() != null ? $retencion->get_proveedor()->get('cuit') : ''; ?></td>
										<td><?php echo $retencion->get_proveedor() != null ? $retencion->get_proveedor()->get('razon_social') : ''; ?></td>
										<td><?php echo str_pad(array_pop($retencion->get_facturas())->get('letra_comprobante'), 2, ' ', STR_PAD_RIGHT) . str_pad(array_pop($retencion->get_facturas())->get('numero_comprobante'), 12, '0', STR_PAD_LEFT); ?></td>
										<td align="right"><?php echo str_pad(number_format($retencion->get('importe_neto'), 2, ',', ''), 12 , '0', STR_PAD_LEFT); ?></td>
										<td align="right"><?php echo number_format($retencion->get('importe_retencion1'), 2); ?></td>
										<td>
											<a target="_blank" href="<?php echo site_url('compras/retencion/'.$retencion->get('id')); ?>" title="Ver certificado de retención" class="i-file"></a>
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
