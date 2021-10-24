<input type="hidden" name="id" value="<?php echo $venta->get('id'); ?>" />
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Fecha</label>
	<div class="col-lg-10">
		<div id="datepicker" class="input-group date"
			data-date-format="dd-mm-yyyy" data-maxlength="10" data-autocomplete="off">
			<input size="16" class="form-control" type="text" name="fecha_comprobante" value="<?php echo dates::YMDtoDMY($venta->get('fecha_comprobante'), date('d-m-Y')); ?>" />
			<span class="input-group-addon"><i class="icon16 i-calendar-4"></i></span>
		</div>
        <?php echo form_error('fecha_comprobante'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Tipo de Comprobante</label>
	<div class="col-lg-10">
		<select class="form-control" name="letra_comprobante">
			<option value="A" <?php echo $venta->get('letra_comprobante') == 'A' ? 'selected' : ''; ?>>Factura A</option>
			<option value="B" <?php echo $venta->get('letra_comprobante') == 'B' ? 'selected' : ''; ?>>Factura B</option>
			<option value="C" <?php echo $venta->get('letra_comprobante') == 'C' ? 'selected' : ''; ?>>Factura C</option>
			<option value="E" <?php echo $venta->get('letra_comprobante') == 'E' ? 'selected' : ''; ?>>Factura E</option>
		</select>
        <?php echo form_error('letra_comprobante'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">N° Comprobante</label>
	<div class="col-lg-10">
		<input class="form-control" type="text" name="numero_comprobante" value="<?php echo $venta->get('numero_comprobante'); ?>" />
		<?php echo form_error('numero_comprobante'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Descripcion</label>
	<div class="col-lg-10">
		<input class="form-control" type="text" name="descripcion" value="<?php echo $venta->get('descripcion'); ?>" />
		<?php echo form_error('descripcion'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Cliente</label>
	<div class="col-lg-10">
		<?php Dropdown::render('cliente_id', $clientes, $venta->get('cliente_id'), 'class="form-control select2"'); ?>
		<?php echo form_error('cliente_id'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Importe Neto</label>
	<div class="col-lg-10">
		<input class="form-control" type="text" name="importe_neto" value="<?php echo $venta->get('importe_neto'); ?>" />
		<?php echo form_error('importe_neto'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Importe IVA 10.5%</label>
	<div class="col-lg-10">
		<input class="form-control" type="text" name="importe_iva10" value="<?php echo $venta->get('importe_iva10'); ?>" />
		<?php echo form_error('importe_iva10'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Importe IVA 21%</label>
	<div class="col-lg-10">
		<input class="form-control" type="text" name="importe_iva21" value="<?php echo $venta->get('importe_iva21'); ?>" />
		<?php echo form_error('importe_iva21'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Importe IVA 27%</label>
	<div class="col-lg-10">
		<input class="form-control" type="text" name="importe_iva27" value="<?php echo $venta->get('importe_iva27'); ?>" />
		<?php echo form_error('importe_iva27'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Importe No Gravado</label>
	<div class="col-lg-10">
		<input class="form-control" type="text" name="importe_nograv" value="<?php echo $venta->get('importe_nograv'); ?>" />
		<?php echo form_error('importe_nograv'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Percepción IIBB ARBA (calculado al guardar)</label>
	<div class="col-lg-10">
		<input class="form-control red" type="text" disabled="disabled" value="<?php echo number_format((double)$venta->get('importe_percepcion1'), 2); ?>" />
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Importe TOTAL (calculado al guardar)</label>
	<div class="col-lg-10">
		<input class="form-control" type="text" disabled="disabled" value="<?php echo number_format($venta->get_total(), 2); ?>" />
	</div>
</div>
<div class="form-group">
	<label class="col-lg-2 control-label" for="normal">Estado</label>
	<div class="col-lg-10">
		<select class="form-control" name="estado_id">
			<option value="1" <?php echo ($venta->get('estado_id') == 1 ? 'selected' : '')?>>Impaga</option>
			<option value="2" <?php echo ($venta->get('estado_id') == 2 ? 'selected' : '')?>>Paga parcialmente</option>
			<option value="3" <?php echo ($venta->get('estado_id') == 3 ? 'selected' : '')?>>Totalmente paga</option>
		</select>
		<?php echo form_error('estado_id'); ?>
	</div>
</div>


<div class="form-group">
	<div class="col-lg-offset-2">
		<div class="pad-left15">
			<button type="submit" class="btn btn-primary">Guardar</button>
			<a href="<?php echo site_url('ventas/show'); ?>" class="btn">Cancelar</a>
		</div>
	</div>
</div>
