                                        <input type="hidden" name="id" value="<?php echo $empresa->get('id');?>" />
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">CUIT</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="cuit" maxlength="11" value="<?php echo $empresa->get('cuit');?>" />
                                                <h6>Ingrese el cuit sin guiones ni espacios</h6>
                                                <?php echo form_error('cuit'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">IIBB</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="iibb" maxlength="11" value="<?php echo $empresa->get('iibb');?>" />
                                                <?php echo form_error('iibb'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Condición IVA</label>
                                            <div class="col-lg-10">
                                                <?php Dropdown::render('condicion_id', $condiciones, $empresa->get('condicion_id'), 'class="form-control"'); ?>
                                                <?php echo form_error('iibb'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Razón social</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="razon_social" value="<?php echo $empresa->get('razon_social');?>" />
                                                <?php echo form_error('razon_social'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Nombre fantasía</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="nombre_fantasia" value="<?php echo $empresa->get('nombre_fantasia');?>" />
                                                <?php echo form_error('nombre_fantasia'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Pais</label>
                                            <div class="col-lg-10">
                                                <?php Dropdown::render('pais_id', $paises, $empresa->get('pais_id'), 'class="form-control"'); ?>
                                                <?php echo form_error('pais_id'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Provincia</label>
                                            <div class="col-lg-10">
                                                <?php Dropdown::render('provincia_id', $provincias, $empresa->get('provincia_id'), 'class="form-control"'); ?>
                                                <?php echo form_error('provincia_id'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Domicilio</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="domicilio" value="<?php echo $empresa->get('domicilio');?>" />
                                                <?php echo form_error('domicilio'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Teléfono</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="telefono" value="<?php echo $empresa->get('telefono');?>" />
                                                <?php echo form_error('telefono'); ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">E-mail</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="email" value="<?php echo $empresa->get('email');?>" />
                                                <?php echo form_error('email'); ?>
                                            </div>
                                        </div>
										

                                        <div class="form-group">
                                            
                                            <div class="col-lg-offset-2">
                                                <div class="pad-left15">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <a href="<?php echo site_url('empresas/show'); ?>" class="btn">Cancelar</a>
                                                </div>
                                            </div>
                                        </div>
                            