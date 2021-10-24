                                        <input type="hidden" name="id" value="<?php echo $configuracion->get('id'); ?>" />

										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="razon_social">Razón social</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="razon_social" value="<?php echo $configuracion->get('razon_social'); ?>" />
                                                <?php echo form_error('razon_social') ?>
                                            </div>
                                        </div>
                                        
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="cuit">CUIT</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="cuit" value="<?php echo $configuracion->get('cuit'); ?>" />
                                                <?php echo form_error('cuit') ?>
                                            </div>
                                        </div>
                                        										
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="iibb">IIBB</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="iibb" value="<?php echo $configuracion->get('iibb'); ?>" />
                                                <?php echo form_error('iibb') ?>
                                            </div>
                                        </div>
                                                                                										
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Úlima carga de Padrón ARBA</label>
                                            <div class="col-lg-10">
                                            <label class="form-control">
                                                <?php echo dates::YMDtoDMY($configuracion->get('ultimo_padron_arba') ); ?>
                                                </label>
                                            </div>
                                        </div>
                                        										
                                        
                                        <div class="form-group">
                                            
                                            <div class="col-lg-offset-2">
                                                <div class="pad-left15">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
