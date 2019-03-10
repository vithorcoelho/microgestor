<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Cliente'); ?>

<div class="body">
	<div class="card panel">
		<h5 class="card-header">Dados Cliente</h5>
		<?php echo form_open(null, array('autocomplete'=>'off', 'class'=>'form-cliente')) ?>

		<div class="card-block">
			<div class="card-body">
				<input type="hidden" name="id" value="<?php echo $cliente[0]->id ?>">

				<div class="form-group">
					<div class="row">
						<div class="col-md form-group">
							<label><strong>Nome*</strong></label>
							<?php echo form_input('nome', $cliente[0]->nome, array('class'=>'form-control', 'required'=>'')) ?>	
						</div>
						
						<div class="col-md form-group">
							<label><strong>Email</strong></label>
							<?php echo form_input('email', $cliente[0]->email, array('class'=>'form-control')) ?>
						</div>

						<div class="col-md-3 form-group">
							<label><strong>CPF</strong></label>
							<?php echo form_input('cpf', $cliente[0]->cpf, array('class'=>'form-control')) ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-4 form-group">
							<label><strong>Cidade</strong></label>
							<?php echo form_input('cidade', $cliente[0]->cidade, array('class'=>'form-control')) ?>
						</div>
						
						<div class="col-md-8 form-group">
							<label><strong>Endereço</strong></label>
							<?php echo form_input('endereco', $cliente[0]->endereco, array('class'=>'form-control')) ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6 form-group">
							<label><strong>Telefone</strong></label>
							<?php echo form_input('telefone', $cliente[0]->telefone, array('class'=>'form-control')) ?>
						</div>

						<div class="col-md-6 form-group">
							<label><strong>Celular</strong></label>
							<?php echo form_input('celular', $cliente[0]->celular, array('class'=>'form-control')) ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<a href="<?php echo base_url('clientes/deletarcliente/'.$cliente[0]->id) ?>" class="btn btn-danger">Excluir</a>
		    <input type="submit" class="btn btn-success" value="Salvar">
		</div>
		
		<?php echo form_close() ?>
		<?php echo modules::run('footer') ?>
		<?php echo get_message_cookie(); ?>
	</div>
</div>
</html>

<script type="text/javascript">
$("form").submit(function()
{
	var dados = $(this).serialize();

	$('.card-footer input').attr('disabled', true);
	$('.card-footer input').attr('value', 'Salvando');
	$('.form-control').attr('disabled', true);
    
    $.ajax({
       url: '<?php echo base_url('clientes/ajax_atualizarcliente') ?>',
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
		          msg_flutuante(response.error, 'danger');
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