<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\aform;

// Yii Imports
use Yii;
use yii\helpers\Html;

// CMG Imports
use cmsgears\core\common\config\CoreGlobal;

use cmsgears\widgets\aform\assets\FormAssets;

use cmsgears\core\common\utilities\FormUtil;

/**
 * AjaxFormWidget submits dynamic form using ajax.
 *
 * @since 1.0.0
 */
class AjaxFormWidget extends \cmsgears\widgets\form\BaseForm {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $wrap	= true;
	public $wrapper = 'div';

	public $slug;

	public $type = CoreGlobal::TYPE_FORM;

	public $spinner = 'cmti cmti-3x cmti-spinner-10';

	public $ajaxUrl;

	public $cmtApp			= 'forms';
	public $cmtController	= 'form';
	public $cmtAction		= 'default';

	// Protected --------------

	protected $modelService;

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function init() {

		parent::init();

		$this->modelService = Yii::$app->factory->get( 'formService' );
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	public function run() {

		if( $this->loadAssets ) {

			FormAssets::register( $this->getView() );
		}

		return parent::run();
    }

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

    public function renderWidget( $config = [] ) {

		// Form and Fields
		if( !isset( $this->model ) && isset( $this->slug ) ) {

			$this->model = $this->modelService->getBySlugType( $this->slug, $this->type );
		}

		if( isset( $this->model ) && $this->model->isActive() ) {

			// fields and html
			$fieldsHtml		= FormUtil::getApixFieldsHtml( $this->model, $this->form, [ 'label' => $this->labels, 'modelName' => $this->formName ] );
			$captchaHtml	= null;

			// Views Path
			$formPath		= "$this->template/form";
			$captchaPath	= "$this->template/captcha";

			// submit url
			if( empty( $this->ajaxUrl ) ) {

				$formSlug		= $this->model->slug;
				$this->ajaxUrl	= "form/$formSlug";
			}

			if( $this->model->captcha ) {

				$captchaHtml = $this->render( $captchaPath );
			}

			$formHtml = $this->render( $formPath, [ 'widget' => $this, 'fieldsHtml' => $fieldsHtml, 'captchaHtml' => $captchaHtml ] );

			// Prepare Form Options
			$modelOptions = !empty( $this->model->htmlOptions ) ? json_decode( $this->model->htmlOptions, true ) : [];

			$this->options = \yii\helpers\ArrayHelper::merge( $this->options, $modelOptions );

			if( $this->wrap ) {

				return Html::tag( $this->wrapper, $formHtml, $this->options );
			}

			return $formHtml;
		}
		else {

			echo "<div class=\"warning\">Form not found or submission is disabled.</div>";
		}
	}

	// AjaxFormWidget ------------------------

}
