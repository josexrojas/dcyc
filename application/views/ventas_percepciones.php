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
						<h4>Percepciones</h4>
						<a href="#" class="minimize"></a>
					</div>
					<!-- End .panel-heading -->

					<div class="panel-body">
							<form method="post" action="<?php echo site_url('ventas/ver_percepciones_arba');?>">
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
							foreach ($percepciones as $percepcion)
							{
								$total+= $percepcion->get('importe_percepcion1');
                            } 
							
							?>
                            <b>Total Percibido: $<?=number_format($total, 2)?></b>
                            <br /><br />
                            
							<table class="table table-striped table-bordered table-hover"
								id="dataTable">
								<thead>
									<tr>
										<th style="display: none;"></th>
										<th># percepción</th>
										<th>CUIT</th>
										<th>Cliente</th>
										<th>Fecha</th>
										<th>Importe Percepción</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($percepciones as $percepcion): ?>
									<tr class="gradeX">
										<td style="display: none"></td>
										<td><?php echo $percepcion->get('id'); ?></td>
										<td><?php echo $percepcion->get_cliente() != null ? $percepcion->get_cliente()->get('cuit') : ''; ?></td>
										<td><?php echo $percepcion->get_cliente() != null ? $percepcion->get_cliente()->get('razon_social') : ''; ?></td>
										<td><?php echo substr($percepcion->get('fecha_comprobante'), 8, 2)."/".substr($percepcion->get('fecha_comprobante'), 5, 2)."/".substr($percepcion->get('fecha_comprobante'), 0, 4); ?></td>
										<td align="right"><?php echo number_format($percepcion->get('importe_percepcion1'), 2); ?></td>
										<td>
											<a href="<?php echo site_url('ventas/edit/'.$percepcion->get('id')); ?>" title="Ver factura" class="i-file"></a>
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
