<?php $form->html(); ?>
<?php $form->view()->attr('action', '/'.\Request::$current->uri().'#lead-form-anchor'); ?>
<div class="row-fluid">
	<div id="lead-form" class="<?=$full ? 'span12' : 'span8'?>">
		<div id="lead-form-anchor" class="span3"></div>
		<div class="span3 contact-well">
			<div class="padded-content padded-top">
				<h3>Send me a message</h3>
				<p>Please fill out the inquiry form, or contact me below using traditional methods.</p>
				<table>
					<tr>
						<td class="align-top"><h4>Email:&nbsp;</h4></td>
						<td class="align-top">
							<h4><a href="mailto:jneslen@yahoo.com">jneslen@yahoo.com</a></h4>
						</td>
					</tr>
					<tr>
						<td class="align-top"><h4>Phone:&nbsp;</h4></td>
						<td class="align-top"><h4>801.508.4175</h4></td>
					</tr>
				</table>
			</div>
		</div><!-- contact-well -->
		<div class="<?=$full ? 'span8' : 'span4'?> contact-form">
			<div class="row padded-top">
				<?php if($complete): ?>
				<div class="span8">
					<h2 class="padded-content">Your inquiry has been submitted</h2>
					<p class="padded-content">You will be contacted shortly in regards to your request.</p>
				</div>
				<?php else: ?>
				<?=$form->view()->open()?>
				<?=$form->campaign_id->render()?>
				<?=$form->download->render()?>
				<div class="span4">
					<div class="padded-content">
						<?=$form->name->render()?>
						<?=$form->email->render()?>
						<?=$form->number->render()?>
					</div>
				</div>
				<div class="<?=$full ? 'span6' : 'span3'?>">
					<div class="padded-content">
						<?=$form->message->render()?>
						<?=$form->submit->render()?>
					</div>
				</div>
				<?=$form->view()->close()?>
				<?php endif; ?>
			</div>
		</div><!-- contact-form -->
		<div class="clear"></div>
	</div><!-- lead-form -->
</div><!-- row -->
<?php if($complete): ?>
	<?=\Analytics::factory(array('google_adwords' => 'all'))->render()?>
<?php endif; ?>