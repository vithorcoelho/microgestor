<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<main id="main">
	<div class="ks-page-container">
	    <div class="ks-column ks-page">
	        <div class="ks-content">
	            <div class="ks-body">
	                <div class="ks-nav-body-wrapper">
	                	<div class="container-fluid ks-rows-section">
	                    	<div class="row justify-content-center">
								<div class="col-lg-8">

									<div class="row">
										<div class="col">
											<h4>microGestor.me</h4>
										</div>

										<span style="float: right;">#<?php echo $this->uri->segment(3) ?></span>
									</div>

									<hr>
	
									<h3>Emitente</h3>
									<table class="table table-bordered">
										<tr>	
											<td>Empresa:</td>
											<td>CNPJ:</td>
											<td>Telefone:</td>
										</tr>

										<tr>	
											<td>Cidade:</td>
											<td>Bairro:</td>
											<td>Email:</td>
										</tr>
									</table>

									<div class="row">
										<div class="col-6">
											<h3>Emitente</h3>
											<label><strong>Empresa: </strong>Fernanda Melo</label><br>
											<label><strong>CNPJ: </strong>0000000000</label><br>
											<label><strong>Cidade: </strong>Três Corações</label><br>
											<label><strong>Endereço: </strong>Rua José Jorge Chediak</label><br>
											<label><strong>Telefone: </strong>8848552233</label><br>
											<label><strong>Email: </strong>exemplo@gmail.com</label><br>
										</div>

										<div class="col-6" style="text-align: right;">
											<h3>Pedido</h3>
											<label><strong>Data de venda: </strong><?php echo date('d/m/Y', strtotime($venda[0]->data)); ?></label><br>
											<label><strong>Cliente: </strong><?php echo $cliente[0]->nome ?></label><br>
											<label><strong>Email: </strong><?php echo $cliente[0]->email ?></label><br>
											<label><strong>Cidade: </strong><?php echo $cliente[0]->cidade ?></label><br>
											<label><strong>Endereço: </strong><?php echo $cliente[0]->endereco ?></label><br>
											<label><strong>Telefone: </strong><?php echo $cliente[0]->telefone ?></label><br>
											<label><strong>Celular: </strong><?php echo $cliente[0]->celular ?></label><br>
										</div>
									</div>

									<div class="row">
										<table class="table">
											<thead>
												<th>Produto</th>
												<th>SKU</th>
												<th>Preço</th>
												<th>Qtd</th>
												<th>Subtotal</th>
											</thead>

											<tbody>
												<?php foreach($produtos as $campo): ?>
												<tr>
													<td><?php echo $campo->produto ?></td>
													<td><?php echo ($campo->ref) ? $campo->ref : '-' ?></td>
													<td><?php echo number_format($campo->preco, 2, ',', '.') ?></td>
													<td><?php echo $campo->quantidade ?></td>
													<td><?php echo number_format(($campo->preco * $campo->quantidade), 2, ',', '.') ?></td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>

									<div class="row">
										<div class="col-8">
											<h4>Observações</h4>
											
										</div>

										<div class="col-4" style="text-align: right;">
											<h4>Totais</h4>
											<label><strong>Total de produtos: </strong><?php echo $total_venda ?></label><br>
											<label><strong>Total de Frete: </strong>0,00</label><br>
											<label><strong>Total: </strong><?php echo $total_venda ?></label><br>
										</div>
									</div>

								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
	     </div>
	</div>
</main>

<?php echo modules::run('footer'); ?>
</html>

<script type="text/javascript">

//$(function(){
//	window.print();
//});
	
</script>