                                        <input type="hidden" name="id" value="<?php echo $pais->get('id'); ?>" />

										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Nombre</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="descripcion" value="<?php echo $pais->get('descripcion'); ?>" />
                                                <?php echo form_error('descripcion') ?>
                                            </div>
                                        </div>
										

                                        <div class="form-group">
                                            
                                            <div class="col-lg-offset-2">
                                                <div class="pad-left15">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <a href="<?php echo site_url('paises/show'); ?>" class="btn">Cancelar</a>
                                                </div>
                                            </div>
                                        </div>
