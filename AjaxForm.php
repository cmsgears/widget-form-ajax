<?php
namespace cmsgears\widgets\aform;

// Yii Imports
use \Yii;
use yii\helpers\Html;
use yii\helpers\Url;

// CMG Imports
use cmsgears\forms\common\models\entities\FormField;

use cmsgears\forms\common\services\FormService;

class AjaxForm extends \cmsgears\widgets\form\BaseForm {

	// Variables ---------------------------------------------------

	// Public Variables --------------------

	public $slug;
	public $ajaxUrl;

	// Instance Methods --------------------------------------------

	// yii\base\Widget

	public function run() {

		// TODO Remove comment after adding cmgtools to bower.
		// FormAssetBundle::register( $this->getView() );

		return parent::run();
    }

	// AjaxForm

    public function renderForm() {
    	
		// Form and Fields
		$this->form		= FormService::findBySlug( $this->slug );
		
		if( isset( $this->form ) && $this->form->active ) {

			$fields			= $this->form->fields;
			$fieldsHtml		= '';
			$captchaHtml	= null;
	
			// Paths
			$formPath		= $this->template . '/form';
			$fieldPath		= $this->template . '/field';
			$captchaPath	= $this->template . '/captcha';
	
			if( !isset( $this->ajaxUrl ) ) {
	
				$formSlug		= $this->form->slug;
				$this->ajaxUrl	= Url::toRoute( [ "/cmgforms/apix/site/index?form=$formSlug" ] );	
			}
	
			foreach ( $fields as $field ) {
				
				$fieldHtml	= null;
	
				if( isset( $field->options ) ) {
	
					$field->options	= json_decode( $field->options, true );
				}
				else {
	
					$field->options	= [];
				}
	
				switch( $field->type ) {
	
					case FormField::TYPE_TEXT: {
	
						$fieldHtml = Html::input( 'text', "GenericForm[$field->name]", null, $field->options );
	
						break;
					}
					case FormField::TYPE_TEXTAREA: {
	
						$fieldHtml = Html::textarea( "GenericForm[$field->name]", null, $field->options );
	
						break;
					}
				}
	
				$fieldsHtml	   .= $this->render( $fieldPath, [
																'field' => $field, 
																'fieldHtml' => $fieldHtml 
															]);
			}
			
			if( $this->form->captcha ) {
				
				$captchaHtml	= $this->render( $captchaPath );
			}
	
			$formHtml 		= $this->render( $formPath, [ 'fieldsHtml' => $fieldsHtml, 'captchaHtml' => $captchaHtml ] );
	
			$this->options[ 'action' ]			= $this->ajaxUrl;
			$this->options[ 'method' ]			= 'post';
			$this->options[ 'cmt-controller' ]	= 'form';
			$this->options[ 'cmt-action' ]		= 'generic';
	
	        return Html::tag( 'form', $formHtml, $this->options );
		}
		else {
			
			echo "<div class='warning'>Form submission is disabled by site admin.</div>";	
		}
	}
}

?>