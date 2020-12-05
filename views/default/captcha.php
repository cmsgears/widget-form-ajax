<?php
use cmsgears\core\common\widgets\Captcha;
?>
<div class="form-group captcha-wrap clearfix">
	<?= Captcha::widget([
		'name' => 'GenericForm[captcha]',
		'captchaAction' => '/forms/form/acaptcha',
		'options' => [ 'placeholder' => 'Captcha Key*' ]
	])?>
	<span class="info">Click the Captcha Image to get new code.</span>
	<span class="error" cmt-error="GenericForm[captcha]"></span>
</div>
