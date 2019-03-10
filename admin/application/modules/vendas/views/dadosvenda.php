<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Dados do pedido'); ?>

<div class="body">
	<div class="row">
		<div class="col-md-4">
			<div class="card ks-card-widget ks-widget-table" style="height: 230px">
				<h3 class="card-header" style="margin-bottom: 10px">Geral</h3>
				<div class="card-block">
					<span><strong>Data da venda: </strong><?php echo date('d/m/Y', strtotime($venda[0]->data )) ?></span><br>
					<span><strong>Frete: </strong><?php echo number_format($venda[0]->frete, 2, ',', '.') ?></span><br>
					<span><strong>Total de produtos: </strong><?php echo $total_venda ?></span><br>
					<span><strong>Total: </strong><?php echo number_format(($venda[0]->total + $venda[0]->frete), 2, ',', '.') ?></span><br>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card ks-card-widget ks-widget-table" style="height: 230px">
				<h3 class="card-header" style="margin-bottom: 10px">Dados Cliente</h3>
				<div class="card-block">
								<span><strong>Nome:</strong><input type="hidden" name="<?php echo $cliente[0]->nome ?>"><?php echo $cliente[0]->nome ?></span><br>
								<span><strong>CPF:</strong> <?php echo $cliente[0]->cpf ?></span><br>
								<span><strong>Email:</strong> <?php echo $cliente[0]->email ?></span><br>
								<span><strong>Telefone:</strong> <?php echo $cliente[0]->telefone ?></span><br>
								<span><strong>Celular:</strong> <?php echo $cliente[0]->celular ?></span><br>
								<span><strong>Cidade:</strong> <?php echo $cliente[0]->cidade ?></span><br>
								<span><strong>Endereço:</strong> <?php echo $cliente[0]->endereco ?></span><br>
				</div>
			</div>
		</div>
			
		<div class="col-md-4">
			<div class="card ks-card-widget ks-widget-table" style="height: 230px">
				<h5 class="card-header" style="margin-bottom: 10px">Observações</h5>
				<div class="card-block">
					<span><?php echo ($venda[0]->obs != '') ? $venda[0]->obs : 'Nenhuma' ?></span>
				</div>
			</div>
		</div>
	</div>

<form method="post" action="<?php echo base_url('vendas/salvarvenda') ?>">

	<input type="hidden" name="chave" value="<?php echo $venda[0]->chave ?>">
	<br>

	<div class="row">
		<div class="col-lg-12">
			<div class="card panel">
				<div class="card-block">
					
					<table border="0" cellpadding="0" cellspacing="0" width="80%" class="table table-bordered table-striped stacktable large-only">
						<tbody id="content_retorno">
							<?php foreach($produtos as $campo): ?>
							<tr class="<?php echo ($campo->idproduto) ?>">
								<td>
									<input type="hidden" value="<?php echo ($campo->ref) ?>" name="up_ref[]">
									<input type="hidden" value="<?php echo $campo->produto ?>" name="up_produtos[]"><?php echo $campo->produto ?>
								</td>

								<td>
									<input type="text" id="preco" value="<?php echo number_format($campo->preco, 2, ',', '.') ?>" class="form-control form-control-sm money" data-thousands="." data-decimal="," name="up_preco[]">
								</td>

								<td>
									<input type="text" class="qtdproduto form-control form-control-sm" value="<?php echo $campo->quantidade ?>" name="up_quantidade[]">
								</td>

								<td width="2">
									<a href="<?php echo $campo->id ?>#<?php echo $campo->idproduto ?>" class="excluirproduto btn"><label class="la la-trash ks-icon" style="color: #ef6161; cursor: pointer"></label></a>
								</td>
							</tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>

					<input type="text" id="busca" class="form-control" placeholder="Adicionar produtos...">

					<div id="resultado_busca" class="listaprodutosvendas scroll"></div>
					<br>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="card panel" style="padding: 20px 15px">
				
				<input type="hidden" name="chave" value="<?php echo $venda[0]->chave ?>">
				<input type="hidden" name="idcliente" value="<?php echo $venda[0]->idcliente ?>">

				<div class="row">
					<div class="col-md-7">
						<div class="" style="display: flex">
							<div class="col-4">
									<label><strong>Situação</strong></label>
									<select name="status" class="form-control ">
							        	<option <?php echo ($venda[0]->status == 'Em andamento') ? 'selected' : '' ?> value="Em andamento">Em andamento</option>
							        	<option <?php echo ($venda[0]->status == 'Atendido') ? 'selected' : '' ?> value="Atendido">Atendido</option>
							        	<option <?php echo ($venda[0]->status == 'Entregue') ? 'selected' : '' ?> value="Entregue">Entregue</option>
							        	<option <?php echo ($venda[0]->status == 'Concluido') ? 'selected' : '' ?> value="Concluido">Concluido</option>
						        	</select>
							</div>

							<div class="col-5">
									<label><strong>Meio de Pagamento</strong></label>
									<select class="form-control" name="pagamento">
										<option <?php echo ($venda[0]->pagamento == 'Dinheiro') ? 'selected' : '' ?> value="Dinheiro">Dinheiro</option>
										<option <?php echo ($venda[0]->pagamento == 'Boleto') ? 'selected' : '' ?> value="Boleto">Boleto</option>
										<option <?php echo ($venda[0]->pagamento == 'Cartão de Crédito') ? 'selected' : '' ?> value="Cartão de Crédito">Cartão de Crédito</option>
										<option <?php echo ($venda[0]->pagamento == 'Cartão de Débito') ? 'selected' : '' ?> value="Cartão de Débito">Cartão de Débito</option>
										<option <?php echo ($venda[0]->pagamento == 'Transferência') ? 'selected' : '' ?> value="Transferência">Transferência</option>
									</select>
							</div>

							<div class="col-3">
									<label><strong>Frete</strong></label>
									<?php echo form_input('frete',  number_format($venda[0]->frete, 2, ',', '.'), array('class'=>'form-control money', 'data-thousands'=>".", 'data-decimal'=>",")) ?>
							</div>
						</div>
					</div>
					
					<div class="col-md-5">
						<div class="col-2">
							<label>&nbsp;</label>
						</div>

						<input type="submit" value="Salvar" class="btn btn-success" style="float: right; margin: 0 10px">

						<a class="btn btn-danger" data-toggle="modal" data-target=".btn-excluir" style="float: right; color: #fff">
					        Exluir
				        </a>
					
						<a href="<?php echo base_url('vendas/resumopedido/'.$this->uri->segment(3)) ?>" target="_blank" class="btn btn-primary-outline" style="float: right; margin: 0 10px">
				            Imprimir
				        </a>
					</div>
				</div>	
			</div>
		</div>
	</div>
</form>

</div>

<div class="modal fade btn-excluir form-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   	<div class="modal-dialog modal-sm">
		<div class="alert alert-danger ks-solid" role="alert">
            <h5 class="alert-heading">Tem certeza?</h5>
            <p>Excluir uma venda pode as alterar todas as informações de relatório</p>
            <div class="ks-actions">
                 <button type="button" class="btn btn-danger-outline" data-dismiss="modal">Cancelar</button>
                <a href="<?php echo base_url('vendas/deletarvenda/'.$venda[0]->chave) ?>" class="btn btn-danger ks-approve">Sim</a>
            </div>
        </div>
	</div>	
</div>

<?php echo body_close(); ?>

	

<?php echo modules::run('footer'); ?>
<?php echo get_message_cookie(); ?>

</html>

<script type="text/javascript">

	$(document).on('click', '.excluirproduto', function()
	{
		var idprodutodelete = $(this).attr('href').split('#');

		$.ajax({
			method: 'post',
			url: '<?php echo base_url('vendas/DeletarListaProdutos') ?>',
			data: {
				id: idprodutodelete[0]
			},
			dataType: 'json',
			success: function(retorno){
				$('#content_retorno').find('.' + idprodutodelete[1]).remove();
			}
		});

		return false;
	});


	$('#busca').click(function()
	{
		if($(this).val() != '')
		{
			$('#resultado_busca').show();
		}
	});

	$('#busca').keyup(function()
	{
		var campo = $(this).val();

		if(campo.length >= 1)
		{
			$('#resultado_busca').show();
	    	$.ajax({
	       		type: 'POST',
	       		url:  '<?php echo base_url('vendas/Ajax_BuscarProdutos') ?>',
	       		dataType: 'json',
	       		data: {
	           	texto: $("#busca").val()
	       		},
		       	success: function(retorno) 
		       	{
		       		$('#resultado_busca').html(retorno.dados);
		       	}
	     	});
	 	}
		else
		{
			$('#resultado_busca').hide();
		}
	});

    $('#resultado_busca').delegate("a", "click", function ()
    {
		var dadosProduto = $(this).attr('id');
		var splitDados = dadosProduto.split(':');
		var produtosadicionados = [];
		    
		$("#content_retorno tr").each(function(index, tr)
		{
		    produtosadicionados.push({
		        id_product: $(tr).attr("class"),
		        qtd:  $(tr).find("#qtdproduto").val(),
		    });
		});

		var existe = 0;

		$(produtosadicionados).each(function(index, id)
		{
	       if(id.id_product == splitDados[0])
	       {
	       	 existe = 1;

	       	 var idclicado = '.'+splitDados[0];
	       	 var pr = $('#content_retorno').find(idclicado + ' .qtdproduto').val();
	       	 var pr =+ pr + 1;
	       	 $('#content_retorno').find(idclicado + ' .qtdproduto').val(pr);
	       }
	    });

		if(existe == 0)
		{
			$.ajax({
			method: 'post',
			url: '<?php echo base_url('vendas/AjaxAdicionaLinhaProduto') ?>',
			data: {
				idproduto: splitDados[0]
			},
			dataType: 'json',
			success: function(retorno){
				$('tbody#content_retorno').append(retorno.dados);
				$('.money').maskMoney();
			}
			});
			$('#resultado_busca').hide();
		}
    });
</script>