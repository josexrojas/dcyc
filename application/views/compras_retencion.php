<?php $firstpage = true; ?>
<?php foreach ($ordenespagos as $ordenpago): ?>
	<?php if ($firstpage) { $firstpage = false; } else { ?>
	<p style="display: block; page-break-before: always;"><!-- pagebreak --></p>
	<?php } ?>
	<?php include_partial('compras_retencion', array('miempresa' => $miempresa, 'ordenpago' => $ordenpago)); ?>
<?php endforeach; ?>
