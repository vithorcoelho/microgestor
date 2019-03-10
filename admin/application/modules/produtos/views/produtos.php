<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Produtos'); ?>

	<div class="body">
		<div class="modal add-receita add-despesa modal-produto verfluxo form-modal">
		   	<div class="modal-dialog">
				<div id="loading-modal"><?php $this->load->view('include_addprodutos') ?></div>
			</div>	
		</div>

		<div class="row">
			<div class="col">
				<button class="btn btn-success btn-receita" data-toggle="modal" data-target=".add-receita">
                   	<span class="">Cadastrar produto</span>
                </button>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card panel panel-default panel-table">
	                
					<div class="card-header">
						<div class="search">
							<div class="input-group">
			                   	<input type="text" class="form-control busca-produto" placeholder="Buscar produto...">
			                   	<div id="pb_loader" class="">
									<svg class="circular" width="48px" height="48px">
										<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
										<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#1d82ff"/>
									</svg>
								</div>
			               	</div>
						</div>

						<div class="header-buttons-options">
							<div style="float: left; margin: 0 5px">
								<button class="btn btn-info-outline btn-circle arquivo">
						            <span class="la la-file ks-icon"></span>
						        </button>

						        <div class="boxarquivo" style="display: none;">
						        	<button class="btn btn-success" name="export">
						        		<span class="la la-arrow-down ks-icon"></span>
                            			<span class="ks-text">Baixar Excel</span>
                            		</button>

						        	<a href="<?php echo base_url('importar/produtos') ?>" class="btn btn-info">
						        		<span class="la la-cloud-upload ks-icon"></span>
						        	 	<span class="ks-text">Importar</span>
						        	 </a>
						        </div>
							</div>

							<div class="filter-options">
							<form method="post" action="<?php echo base_url('produtos/CookieFiltroProduto') ?>">
								<div class="form-group">
									<select class="form-control" name="limit">
										<option value="">Mostrar</option>
										<option value="75">75</option>
										<option value="100">100</option>
									</select>
								</div>
								<div class="form-group">
									<select class="form-control" name="order_name">
										<option value="id">Ordem por cadastro</option>
										<option value="nome">Ordem alfabetica</option>
									</select>
								</div>
								<div class="form-group">
									<select class="form-control" name="order">
										<option value="DESC">Decrescente</option>
										<option value="ASC">Crescente</option>
									</select>
								</div>
								<button class="btn btn-success">Aplicar</button>
								</form>
							</div>

							<button class="filterproduto btn btn-info-outline btn-circle ks-no-text">
				        	    <span class="la la-filter ks-icon"></span>
				        	</button>
						</div>	
					</div>

	                <div class="card-block ks-browse ks-scrollable jspScrollable" style="min-height: 400px">
	                    	
	                    <div id="resultado"></div>

	                    <table class="table table-striped stacktable small-only listaprodutos">
	                        	<thead>
	                        		<th class="th-none">
	                        			<label class="custom-control custom-checkbox ks-no-description">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </th>
	                        		<th class="th-none">ID</th>
	                        		<th>Nome</th>
	                        		<th>Preço</th>
	                        		<th class="th-none">Cod.</th>
	                        	</thead>
							<tbody>
	                        	<?php foreach ($produtos as $v): ?>
		                        	<tr>
			                        	<td width="5" class="td-none">
			                        		<label class="custom-control custom-checkbox ks-no-description">
	                                            <input type="checkbox" class="custom-control-input">
	                                            <span class="custom-control-indicator"></span>
	                                        </label>
	                                    </td>
			                        	<td width="100" class="td-none"><?php echo $v->id ?></td>
			                        	<td width="200" class=""><a href="<?php echo base_url('produtos/dadosproduto/'.$v->id) ?>"><?php echo $v->nome ?></td>
			                        	<td class="preco"><?php echo '<span class="badge badge-pill badge-info">'.number_format($v->preco, 2, ',', '.').'</span>' ?></td>
			                        	<td class="td-none"><?php echo ($v->ref) ? $v->ref : '-' ?></td>
			                        </tr>
		                    	<?php endforeach; ?>
	                    	</tbody>
	                	</table>
	                </div>
	            </div>
			</div>
		</div>
		<div class="row">
	        <div class="col" style="margin: 50px 0;">
				<nav>       
					<?php echo $paginacao ?>
		      	</nav>
		 	</div>
	    </div>
	</div>
	
<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
<?php $this->load->view('loadergif') ?>
<?php $this->load->view('include_scriptjs') ?>
<?php echo get_message_cookie(); ?>

</html>