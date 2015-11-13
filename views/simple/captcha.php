<?php
use yii\captcha\Captcha;
?>

<div class='frm-field wrap-captcha'>
	<?= Captcha::widget([ 'name' => 'GenericForm[captcha]', 'captchaAction' =>  '/cmgforms/site/captcha', 'options' => [ 'placeholder' => 'Captcha Key*' ] ] ); ?>
	<span class="warning">Click on the captcha image to get new code.</span>
	<span class="error" cmt-error="captcha"></span>
</div>