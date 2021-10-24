                                        <input type="hidden" name="id" value="<?php echo $usuario->get('id'); ?>" />

										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Nombre de usuario</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="username" value="<?php echo $usuario->get('username'); ?>" />
                                                <?php echo form_error('username') ?>
                                            </div>
                                        </div>
                                        
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Nombre</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="nombre" value="<?php echo $usuario->get('nombre'); ?>" />
                                                <?php echo form_error('nombre') ?>
                                            </div>
                                        </div>

										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Perfil</label>
                                            <div class="col-lg-10">
                                                <?php Dropdown::render('perfil', $perfiles, $usuario->get('perfil'), 'class="form-control"'); ?>
                                                <?php echo form_error('perfil') ?>
                                            </div>
                                        </div>
                                        
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Contraseña</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="password" autocomplete="off" name="password1" value="" />
                                                <?php echo form_error('password1') ?>
                                            </div>
                                        </div>
                                        
										<div class="form-group">
                                            <label class="col-lg-2 control-label" for="normal">Repita contraseña</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="password" autocomplete="off" name="password2" value="" />
                                                <?php echo form_error('password2') ?>
                                            </div>
                                        </div>
                                                                                

                                        <div class="form-group">
                                            
                                            <div class="col-lg-offset-2">
                                                <div class="pad-left15">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <a href="<?php echo site_url('usuarios/show'); ?>" class="btn">Cancelar</a>
                                                </div>
                                            </div>
                                        </div>
