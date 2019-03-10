<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Produto'); ?>

<div class="col-lg-8">
	<div class="card panel">
	<h5 class="card-header">Dados Produto</h5>
	<?php echo form_open('', array('autocomplete'=>'off')) ?>

		<div class="card-block">
			<div class="form-group">
				<div class="row">
					<input type="hidden" name="id" value="<?php echo $produto[0]->id ?>">

					<div class="col-md-8 form-group">
						<label><strong>Nome do produto*</strong></label>
						<?php echo form_input('nome',  $produto[0]->nome, array('class'=>'form-control')) ?>	
					</div>
						
					<div class="col-md-4 form-group">
						<label><strong>Tipo de produto*</strong></label>
						<select class="form-control" name="tipo">
							<option value="Produto Acabado" <?php echo ($produto[0]->tipo == "Produto Acabado" ? 'selected' : '') ?> >Produto Acabado</option>
							<option value="Matéria Prima" <?php echo ($produto[0]->tipo == "Matéria Prima" ? 'selected' : '') ?>>Matéria Prima</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md form-group">
						<label><strong>Custo Unitário</strong></label>
						<?php echo form_input('custo',  number_format($produto[0]->custo, 2, ',', '.'), array('class'=>'form-control money', 'data-thousands'=>".", 'data-decimal'=>",")) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Preço Unitário*</strong></label>
						<?php echo form_input('preco',  number_format($produto[0]->preco, 2, ',', '.'), array('class'=>'form-control money', 'data-thousands'=>".", 'data-decimal'=>",")) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Preço de Atacado</strong></label>
						<?php echo form_input('preco_atacado',  number_format($produto[0]->preco_atacado, 2, ',', '.'), array('class'=>'form-control money', 'data-thousands'=>".", 'data-decimal'=>",")) ?>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md form-group">
						<label><strong>SKU</strong></label>
						<?php echo form_input('ref',  $produto[0]->ref, array('class'=>'form-control')) ?>	
					</div>

					<div class="col-md form-group">
						<label><strong>Estoque inicial</strong></label>
						<?php echo form_input('estoque_inicial',  $produto[0]->estoque_inicial, array('class'=>'form-control')) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Estoque minimo</strong></label>
						<?php echo form_input('estoque_maximo',  $produto[0]->estoque_maximo, array('class'=>'form-control')) ?>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<a href="<?php echo base_url("produtos/deletarproduto/" . $produto[0]->id) ?>" class="btn btn-danger">Excluir</a>
	       	<input type="submit" class="btn btn-success" value="Salvar">
	   	</div>
	<?php echo form_close() ?>
	</div>
</div>

<?php echo body_close() ?>
<?php echo modules::run('footer') ?>
<?php echo get_message_cookie() ?>

</html>

<script type="text/javascript">
$("form").submit(function()
{
	var dados = $(this).serialize();

	$('.card-footer input').attr('disabled', true);
	$('.card-footer input').attr('value', 'Salvando');
	$('.form-control').attr('disabled', true);
    
    $.ajax({
       url: '<?php echo base_url('produtos/Ajax_AtualizarProduto') ?>',
       type: "POST",
       data: dados,
       dataType: 'json',
       success: function (response)
       {
		   setTimeout(function()
		   {
		       	$('.card-footer input').attr('disabled', false);
		        $('.card-footer input').attr('value', 'Salvar');
		        $('.form-control').attr('disabled', false);

		        if(response.error)
		        {
		          msg_flutuante(response.error, 'danger', 'bottomCenter');
		        }
		        if(response.success)
		        {
		          msg_flutuante(response.success, 'success', 'bottomCenter');
		        }
			},200);
	    }
  	});
   	return false;
});
</script>