<?php
use yii\captcha\Captcha;
?>

<div class='frm-field wrap-captcha'>
	<?= Captcha::widget([ 'name' => 'GenericForm[captcha]', 'captchaAction' =>  '/forms/form/acaptcha', 'options' => [ 'placeholder' => 'Captcha Key*' ] ] ); ?>
	<span class="info">Click on the captcha image to get new code.</span>
	<span class="error" cmt-error="captcha"></span>
</div>
