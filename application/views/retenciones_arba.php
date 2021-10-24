
            <div class="wrapper">
                <div class="crumb">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url('home')?>"><i class="icon16 i-home-4"></i>Home</a></li>
                      <li class="active">TXT Retenciones</li>
                    </ul>
                </div>
                                <div class="container-fluid">
                    
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="panel panel-default">
							
                                <div class="panel-heading">
                                    <div class="icon"><i class="icon20 i-table"></i></div> 
                                    <h4>TXT Retenciones</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .panel-heading -->
                            
                                <div class="panel-body">
                                <form method="post" action="<?php echo site_url('compras/download_retenciones_arba');?>">
                                	<select name="mes">
                                    	<option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                    <br /><br />
                                    <select name="anio">
										<?php for ($i=2015;$i<=date('Y'); $i++){ ?>
											<option value="<?=$i?>"><?=$i?></option>
										<?php } ?>
                                    	
                                    </select>
                                    <br /><br />
                                    <input type="submit" class="btn btn-primary" value="Descargar TXT">								
                                 </form>

                                </div><!-- End .panel-body -->
                            </div><!-- End .widget -->
                                                
                        </div><!-- End .col-lg-12  -->                     
                                            
                    </div><!-- End .row-fluid  -->

                </div> <!-- End .container-fluid  -->
            </div> <!-- End .wrapper  -->
       