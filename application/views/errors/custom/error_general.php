<div class="row">
	<div class="col-12">
		<div class="card card-outline card-warning">
			<div class="card-body">
				<center>
					<h1 style="font-size: 60pt;"><i class="fas fa-exclamation-circle fa-lg"></i></h1>
					<p style="font-size: 20pt;">
						<?php echo (isset($egc) ? $egc : DEFAULT_ERROR_GENERAL_MESSAGE);?>
					</p>
					<a href="<?php echo $button_link;?>" class="btn btn-link"><i class="fas fa-chevron-left"></i> <?php echo $button_text;?></a>
				</center>
			</div>
		</div>
	</div>
</div>