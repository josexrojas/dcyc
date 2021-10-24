<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="display: none;"></th>
			<th>Fecha</th>
			<th>Tipo</th>
			<th>N° Comprobante</th>
			<th>Descripción</th>
			<th>Importe</th>
		</tr>
	</thead>
	<tbody>
        <?php foreach ($ordenpago->facturas as $f): ?>
        <tr class="gradeX">
			<td style="display: none"><input type="hidden" name="id[]" value="<?php echo $f->get('id');?>" /></td>
			<td><?php echo $f->get('fecha_comprobante'); ?></td>
			<td><?php echo $f->get('letra_comprobante'); ?></td>
			<td><?php echo $f->get('numero_comprobante'); ?></td>
			<td><?php echo $f->get('descripcion'); ?></td>
			<td align="right"><?php echo $f->get('importe_neto'); ?></td>
		</tr>
        <?php endforeach; ?>                                            
    </tbody>
</table>

<table class="col-6 table table-striped table-bordered table-hover">
	<tr>
		<th>Importe retención ARBA IIBB</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_retencion1'), 2)?></td>
	</tr>
	<!-- <tr>
		<th>Importe retención 2</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_retencion2'), 2)?></td>
	</tr>
	<tr>
		<th>Importe retención 3</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_retencion3'), 2)?></td>
	</tr>
	<tr>
		<th>Importe retención 4</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_retencion4'), 2)?></td>
	</tr>  -->

	<tr>
		<th>Importe retención ARBA IIGG</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_retencion1'), 0)?></td>
	</tr>
	<!-- <tr>
		<th>Importe retención 2</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_retencion2'), 2)?></td>
	</tr>
	<tr>
		<th>Importe retención 3</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_retencion3'), 2)?></td>
	</tr>
	<tr>
		<th>Importe retención 4</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_retencion4'), 2)?></td>
	</tr>  -->
	<tr>
	<tr>
		<th>Importe a pagar</th>
		<td align="right"><?php echo number_format($ordenpago->get('importe_neto') - $ordenpago->get('importe_retencion1') - $ordenpago->get('importe_retencion2') - $ordenpago->get('importe_retencion3') - $ordenpago->get('importe_retencion4'), 2)?></td>
	</tr>
</table>

