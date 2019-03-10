<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Configurações'); ?>

<div class="body">
	<h3>Configurações</h3>
	<div class="card panel">
		<h3 class="card-header">Dados do usuário</h3>
		<div class="card-block">
			<form>
				<div class="row">
					<div class="col-md-3">
						<label><strong>Nome da empresa</strong></label>
						<input type="text" name="nome_empresa" class="form-control">
					</div>
					<div class="col-md-6">
						<label><strong>Email da empresa</strong></label>
						<input type="text" name="email_empresa" class="form-control">
					</div>
					<div class="col-md-3">
						<label><strong>CNPJ</strong></label>
						<input type="text" name="cnpj" class="form-control">
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label><strong>Cidade</strong></label>
						<input type="text" name="cidade" class="form-control">
					</div>
					<div class="col-md-5">
						<label><strong>Endereço</strong></label>
						<input type="text" name="endereco" class="form-control">
					</div>
					<div class="col-md-5">
						<label><strong>Telefone</strong></label>
						<input type="text" name="telefone" class="form-control">
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="card panel">
		<h3 class="card-header">Dados da empresa</h3>
		<div class="card-block">
			<form>
				<div class="row">
					<div class="col-md-3">
						<label><strong>Nome da empresa</strong></label>
						<input type="text" name="nome_empresa" class="form-control">
					</div>
					<div class="col-md-6">
						<label><strong>Email da empresa</strong></label>
						<input type="text" name="email_empresa" class="form-control">
					</div>
					<div class="col-md-3">
						<label><strong>CNPJ</strong></label>
						<input type="text" name="cnpj" class="form-control">
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label><strong>Cidade</strong></label>
						<input type="text" name="cidade" class="form-control">
					</div>
					<div class="col-md-5">
						<label><strong>Endereço</strong></label>
						<input type="text" name="endereco" class="form-control">
					</div>
					<div class="col-md-5">
						<label><strong>Telefone</strong></label>
						<input type="text" name="telefone" class="form-control">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
<?php echo @$msg; ?>
</html>
