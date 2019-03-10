<!DOCTYPE html>
<html>

<?php echo modules::run('head'); ?>
<?php echo modules::run('header'); ?>
<?php echo body_open('Em construção'); ?>


<div class="col-lg-7">
	<div class="row">
		<div class="col-lg-12">
			<div class="card panel">
				<h3 style="text-align: center; margin-top: 50px;">Ainda estamos construindo, em breve estará pronto!</h3>
				<p style="text-align: center;">Algumas funcionalidades ainda estão sendo implementadas pela nossa equipe</p>

				<div class="card-block">
					<div class="" style="margin: 0 auto; width:350px">
						<img style="width: 100%" src="<?php echo base_url('assets/images/emconstrucao.png') ?>">
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo body_close(); ?>
<?php echo modules::run('footer'); ?>
<?php echo @$msg; ?>
</html>
