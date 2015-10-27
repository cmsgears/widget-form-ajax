<div class='frm-field'>

	<?php if( isset( $field->label ) ) { ?>
	
		<label><?=$field->label?></label>
	<?php } ?>

	<?=$fieldHtml?>

	<span class="error" cmt-error="<?=$field->name?>"></span>
</div>