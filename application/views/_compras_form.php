                                        <input type="hidden" name="id" value="<?php echo $compra->get('id'); ?>" />
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Fecha</label>
                                            <div class="col-lg-10">
                                                <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy" data-maxlength="10" data-autocomplete="off">
                                                    <input size="16" class="form-control" type="text" name="fecha_comprobante" value="<?php echo dates::YMDtoDMY($compra->get('fecha_comprobante'), date('d-m-Y')); ?>" />
                                                    <span class="input-group-addon"><i class="icon16 i-calendar-4"></i></span>
                                                </div>
                                                <?php echo form_error('fecha_comprobante'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Tipo de Comprobante</label>
                                            <div class="col-lg-10">
                                                <select class="form-control" name="letra_comprobante">
                                                	<option value="A" <?php echo $compra->get('letra_comprobante') == 'A' ? 'selected' : ''; ?>>Factura A</option>
                                                   	<option value="B" <?php echo $compra->get('letra_comprobante') == 'B' ? 'selected' : ''; ?>>Factura B</option>
                                                   	<option value="C" <?php echo $compra->get('letra_comprobante') == 'C' ? 'selected' : ''; ?>>Factura C</option>
                                                   	<option value="E" <?php echo $compra->get('letra_comprobante') == 'E' ? 'selected' : ''; ?>>Factura E</option>
                                                </select>
                                                <?php echo form_error('letra_comprobante'); ?>
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                                <label class="col-lg-2 control-label" for="normal"> Tipo de Facturacion</label>
                                                <div class="col-lg-10">
                                                    <select  class="form-control" name="tipo_facturacion">
                                                        <option value="1" <?php echo $compra->get('tipo_facturacion') == '1' ? 'selected' : ''; ?>>Enajenación de Bienes Muebles y Bienes de Cambio</option>
                                                        <option value="2" <?php echo $compra->get('tipo_facturacion') == '2' ? 'selected' : ''; ?>>Locaciones de Obra y/o Servicios</option>
                                                    </select>
                                                </div>
                                            </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">N° Comprobante</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="numero_comprobante" value="<?php echo $compra->get('numero_comprobante'); ?>" />
                                                <?php echo form_error('numero_comprobante'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Proveedor</label>
                                            <div class="col-lg-10">
                                                <?php Dropdown::render('proveedor_id', $proveedores, $compra->get('proveedor_id'), 'class="form-control select2"'); ?>
                                                <?php echo form_error('proveedor_id'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Importe Neto</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="importe_neto" value="<?php echo $compra->get('importe_neto'); ?>" />
                                                <?php echo form_error('importe_neto'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Descripcion</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="descripcion" value="<?php echo $compra->get('descripcion'); ?>" />
                                                <?php echo form_error('descripcion'); ?>
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            
                                            <div class="col-lg-offset-2">
                                                <div class="pad-left15">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
													<?php if (isset($_GET['empresa_id'])): ?>
													<a href="<?php echo site_url('compras/show?empresa_id='.$_GET['empresa_id'] )?>" class="btn">Cancelar</a>
													<?php else: ?>
													<a href="<?php echo site_url('compras/show')?>" class="btn">Cancelar</a>
													<?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                            