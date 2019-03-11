<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Configurações'); ?>

<div class="col-lg-7">
<form method="post" action="<?php echo URLBASE_ADMIN ?>/configuracoes/salvarconfig">
	<div class="card panel">
		<h3 class="card-header">Dados da empresa</h3>
		<div class="card-block">
				<div class="row">
					<div class="col-md-8">
						<label><strong>Nome da empresa</strong></label>
						<input type="text" name="nome_empresa" class="form-control" value="<?php echo $config[0]->nome_empresa ?>">
					</div>
					<div class="col-md-4">
						<label><strong>CNPJ</strong></label>
						<input type="text" name="cnpj" class="form-control" value="<?php echo $config[0]->cnpj ?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label><strong>Estado</strong></label>
						<input type="text" name="estado" class="form-control" value="<?php echo $config[0]->estado ?>">
					</div>
					<div class="col-md-3">
						<label><strong>Cidade</strong></label>
						<input type="text" name="cidade" class="form-control" value="<?php echo $config[0]->cidade ?>">
					</div>
					<div class="col-md-6">
						<label><strong>Bairro</strong></label>
						<input type="text" name="bairro" class="form-control" value="<?php echo $config[0]->bairro ?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label><strong>Rua</strong></label>
						<input type="text" name="rua" class="form-control" value="<?php echo $config[0]->rua ?>">
					</div>
					<div class="col-md-3">
						<label><strong>Numero</strong></label>
						<input type="text" name="numero" class="form-control" value="<?php echo $config[0]->numero ?>">
					</div>
					<div class="col-md-3">
						<label><strong>Complemento</strong></label>
						<input type="text" name="complemento" class="form-control" value="<?php echo $config[0]->complemento ?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-8">
						<label><strong>Site</strong></label>
						<input type="text" name="site" class="form-control" value="<?php echo $config[0]->site ?>">
					</div>
					<div class="col-md-4">
						<label><strong>Telefone</strong></label>
						<input type="text" name="telefone" class="form-control" value="<?php echo $config[0]->telefone ?>"> 
					</div>
				</div>
		</div>
	</div>

	<br>	
	<input type="submit" class="btn btn-lg btn-success" value="Salvar">
</form>
</div>

<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
<?php echo @$msg; ?>
</html>
