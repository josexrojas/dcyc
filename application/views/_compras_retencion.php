<table border="1" style="width:100%; border:2px solid black;">
	<tr>
		<td>Provincia de Buenos Aires<br>ARBA<br>Agencia de Retención</td>
		<td><h2>R 122</h2></td>
		<td>IMPUESTO SOBRE LOS INGRESOS BRUTOS<br>Comprobante de retención<br>Nº <?php echo $ordenpago->get('certificado_retencion'); ?></td> 
	</tr>
</table>

<h2>Agente de retención</h2>
<p>
	<b>CUIT</b>: <?php echo $miempresa->get('cuit'); ?><br>
	<b><?php echo $miempresa->get('razon_social'); ?></b>
</p>

	
<h2>Datos de la operación</h2>
<p>
	<b>Fecha</b>: <?php echo $ordenpago->get('fecha'); ?><br>
	<b>Comprobantes:</b> <?php foreach ($ordenpago->get_facturas() as $factura); echo $factura->get('letra_comprobante').str_pad($factura->get('numero_comprobante'), 12, '0', STR_PAD_LEFT)." "; ?><br>
	<b>Base imponible</b>: <?php echo $ordenpago->get('importe_neto'); ?><br>
	<b>Alícuota</b>: <?php echo $ordenpago->get('importe_retencion1') / $ordenpago->get('importe_neto') * 100; ?><br>
	<b>Importe retenido</b>: <?php echo $ordenpago->get('importe_retencion1'); ?><br>
</p>
			
		
<h2>Contribuyente</h2>
<p>
	<?php $proveedor = $ordenpago->get_proveedor(); ?>
	<b>CUIT</b>: <?php echo $proveedor->get('cuit'); ?><br>
	<b>Razón social</b>: <?php echo $proveedor->get('razon_social'); ?><br>
	<b>Domicilio</b>: <?php echo $proveedor->get('domicilio'); ?><br>
</p>

<p>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
</p>
