<?php
use yii\captcha\Captcha;
?>

<div class='frm-field'>
	<div><span class="warning">Click on the Captcha to get new code.</span></div>
	<div class="filler-height filler-height-default"></div>
	<?= Captcha::widget([ 'name' => 'GenericForm[captcha]', 'captchaAction' =>  '/cmgforms/site/captcha', 'options' => [ 'placeholder' => 'Captcha Key*' ] ] ); ?>
	<span class="error" cmt-error="captcha"></span>
</div>