
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Fecha</label>
	<div class="col-lg-10">
		<?php echo dates::YMDtoDMY($compra->get('fecha_comprobante'), date('d-m-Y')); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Tipo de Comprobante</label>
	<div class="col-lg-10">
		<?php echo $compra->get('letra_comprobante'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">N° Comprobante</label>
	<div class="col-lg-10">
		<?php echo $compra->get('numero_comprobante'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Proveedor</label>
	<div class="col-lg-10">
		<?php echo $compra->get_proveedor()->get('razon_social'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Importe Neto</label>
	<div class="col-lg-10">
		<?php echo number_format($compra->get('importe_neto'), 2); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Saldo a pagar</label>
	<div class="col-lg-10">
		<?php echo number_format($compra->get_saldo(), 2); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Descripcion</label>
	<div class="col-lg-10">
		<?php echo $compra->get('descripcion'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Ordenes de pago</label>
	<div class="col-lg-10">
		<table class="table table-striped table-bordered table-hover" id="dataTable">
			<thead>
				<tr>
					<th style="display: none;"></th>
					<th># retención</th>
					<th>Fecha</th>
					<th>Pago</th>
					<th>Retención</th>
					<th>Pago final</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($compra->get_ordenespago() as $pago): ?>
				<tr class="gradeX">
					<td style="display: none"></td>
					<td><?php echo $pago->get('certificado_retencion'); ?></td>
					<td><?php echo substr($pago->get('fecha'), 8, 2)."/".substr($pago->get('fecha'), 5, 2)."/".substr($pago->get('fecha'), 0, 4); ?></td>
					<td align="right"><?php echo number_format($pago->get('importe_neto'), 2, ',', ''); ?></td>
					<td align="right"><?php echo number_format($pago->get('importe_retencion1'), 2, ',', ''); ?></td> 
					<td align="right"><?php echo number_format($pago->get('importe_neto') + $pago->get('importe_retencion1'), 2, ',', ''); ?></td>
					<td>
						<?php if ($pago->get('certificado_retencion')): ?>
						<a target="_blank" href="<?php echo site_url('compras/retencion/'.$pago->get('id')); ?>" title="Ver certificado de retención" class="i-file"></a>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>                                            
			</tbody>
		</table>
	</div>
</div>

<div class="form-group">
	<div class="col-lg-offset-2">
		<div class="pad-left15">
			
			<form method="post" action="<?php echo site_url('compras/show_pagar?empresa_id='.$compra->get('proveedor_id')); ?>">
				<input type="hidden" name="id[]" value="<?php echo $compra->get('id'); ?>" />
				<button type="submit" class="btn btn-inverse">Pagar</button>
			
				<?php if (isset($_GET['empresa_id'])): ?>
				<a href="<?php echo site_url('compras/show?empresa_id='.$_GET['empresa_id'] )?>" class="btn">Cerrar</a>
				<?php else: ?>
				<a href="<?php echo site_url('compras/show')?>" class="btn">Cerrar</a>
				<?php endif; ?>
			</form>
			
		</div>
	</div>
</div>
