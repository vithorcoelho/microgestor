<div id="loading-modal">
	<?php echo form_open('', array('autocomplete'=>'off', 'class'=>'modaladdproduto')) ?>

	<div class="form-modal">
		<h4 class="modal-header">Dados produto</h4>
		<div class="modal-body">
			<div class="form-group">
				<div class="row">
					<div class="col-md-8 form-group">
						<label><strong>Nome do produto*</strong></label>
						<?php echo form_input('nome', set_value('nome'), array('class'=>'form-control')) ?>	
					</div>
						
					<div class="col-md-4 form-group">
						<label><strong>Tipo de produto*</strong></label>
						<select class="form-control" name="tipo">
							<option value="Produto Acabado">Produto Acabado</option>
							<option value="Matéria Prima">Matéria Prima</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md form-group">
						<label><strong>Custo Unitário</strong></label>
						<?php echo form_input('custo', set_value('custo'), array('class'=>'form-control money', 'data-thousands'=>".", 'data-decimal'=>",")) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Preço Unitário*</strong></label>
						<?php echo form_input('preco', set_value('preco'), array('class'=>'form-control money', 'data-thousands'=>".", 'data-decimal'=>",")) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Preço de Atacado</strong></label>
						<?php echo form_input('preco_atacado', set_value('preco_atacado'), array('class'=>'form-control money', 'data-thousands'=>".", 'data-decimal'=>",")) ?>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md form-group">
						<label><strong>SKU</strong></label>
						<?php echo form_input('ref', set_value('ref'), array('class'=>'form-control')) ?>	
					</div>

					<div class="col-md form-group">
						<label><strong>Estoque inicial</strong></label>
						<?php echo form_input('estoque_inicial', set_value('estoque_inicial'), array('class'=>'form-control')) ?>
					</div>

					<div class="col-md form-group">
						<label><strong>Estoque minimo</strong></label>
						<?php echo form_input('estoque_maximo', set_value('estoque_maximo'), array('class'=>'form-control')) ?>
					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
	        <button type="button" class="btn btn-primary-outline ks-light" data-dismiss="modal">Fechar</button>
	        <input type="submit" class="btn btn-success" value="Cadastrar">
	    </div>
	</div>
	<?php echo form_close() ?>
</div>
