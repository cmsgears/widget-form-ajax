<?php if( !empty( $fieldsHtml ) ) { ?>

<div class="frm-fields <?= $widget->split4060 ? 'frm-split-40-60' : null ?>">
	<?= $fieldsHtml ?>

	<?php if( $widget->wrapCaptcha ) { ?>
		<div class="frm-captcha clear clearfix">
			<?= $captchaHtml ?>
		</div>
	<?php } else { ?>
		<?= $captchaHtml ?>
	<?php } ?>

	<?php if( $widget->wrapActions ) { ?>
		<div class="frm-actions clear clearfix">
			<input type="submit" value="Submit" />
		</div>
	<?php } else { ?>
		<div class="frm-actions">
			<input type="submit" value="Submit" />
		</div>
	<?php } ?>
</div>

<?php } else { ?>
	<div class="warning">Form submission is disabled.</div>
<?php } ?>
