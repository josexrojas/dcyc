                                        <input type="hidden" name="id" value="<?php echo $provincia->get('id'); ?>" />

										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">País</label>
                                            <div class="col-lg-10">
                                            	<?php Dropdown::render('pais_id', $paises, $provincia->get('pais_id'), 'class="form-control"'); ?>
                                                <?php echo form_error('pais_id') ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Nombre</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="descripcion" value="<?php echo $provincia->get('descripcion'); ?>" />
                                                <?php echo form_error('descripcion') ?>
                                            </div>
                                        </div>
										

                                        <div class="form-group">
                                            
                                            <div class="col-lg-offset-2">
                                                <div class="pad-left15">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <a href="<?php echo site_url('provincias/show'); ?>" class="btn">Cancelar</a>
                                                </div>
                                            </div>
                                        </div>
