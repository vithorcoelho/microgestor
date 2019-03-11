<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<main id="main">
	<div class="ks-page-container">
	    <div class="ks-column ks-page">
	        <div class="ks-content">
	            <div class="">
	                <div class="ks-nav-body-wrapper">
	                	<div class="container-fluid ks-rows-section">
	                    	<div class="row justify-content-center">
								<div class="col-lg-8">

									<div class="row">
										<div class="col">
											<h5>microGestor.me</h5>
										</div>

										<div style="float: right;"><label>Numero do pedido: </label> #<?php echo $this->uri->segment(3) ?> </div>
									</div>

									<div style="float: right;">Data de venda: <?php echo date('d/m/Y', strtotime($venda[0]->data)); ?></div>
										
									<br><br>

									<h5>Dados do emitente</h5>
									<table class="table table-bordered">
										<tr>
											<td colspan="2"><strong>Empresa: </strong></td>
											<td colspan="2"><strong>CNPJ: </strong></td>
										</tr>

										<tr>
											<td><strong>Estado: </strong></td>
											<td><strong>Cidade: </strong></td>
											<td><strong>Bairro: </strong></td>
											<td><strong>Rua: </strong></td>
										</tr>

										<tr>
											<td><strong>Numero: </strong></td>
											<td colspan="1"><strong>Email: </strong></td>
											<td colspan="2"><strong>Site: </strong></td>
										</tr>
									</table>

									<h5>Remetente</h5>
									<table class="table table-bordered">
										<tr>
											<td><strong>Nome: </strong><?php echo $cliente[0]->nome ?></td>
											<td><strong>Telefone: </strong><?php echo $cliente[0]->telefone ?></td>
											<td><strong>Celular: </strong><?php echo $cliente[0]->celular ?></td>
											<td><strong>Email: </strong><?php echo $cliente[0]->email ?></td>
										</tr>

										<tr>
											<td><strong>Estado: </strong></td>
											<td><strong>Cidade: </strong><?php echo $cliente[0]->cidade ?></td>
											<td colspan="2"><strong>Bairro: </strong><?php echo $cliente[0]->endereco ?></td>
										</tr>

										<tr>
											<td colspan="2"><strong>Rua: </strong><?php echo $cliente[0]->endereco ?></td>
											<td><strong>Numero: </strong></td>
											<td><strong>Complemeto: </strong><?php echo $cliente[0]->cidade ?></td>
										</tr>
									</table>

									<br>
									<h5>Pedido</h5>
									<table class="table table-bordered">
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

									<br>
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

$(function(){
	window.print();
});
	
</script>