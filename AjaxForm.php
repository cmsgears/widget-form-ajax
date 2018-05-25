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

use cmsgears\widgets\form\BaseForm;

use cmsgears\core\common\utilities\FormUtil;

/**
 * AjaxForm submits dynamic form using ajax.
 *
 * @since 1.0.0
 */
class AjaxForm extends BaseForm {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $wrap	= true;
	public $wrapper = 'form';

	public $slug;

	public $type = CoreGlobal::TYPE_SITE;

	public $ajaxUrl;

	public $cmtApp			= null;
	public $cmtController	= null;
	public $cmtAction		= null;

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
			$fieldsHtml		= FormUtil::getApixFieldsHtml( $this->model, $this->form, [ 'label' => $this->label, 'modelName' => $this->formName ] );
			$captchaHtml	= null;

			// Views Path
			$formPath		= "$this->template/form";
			$captchaPath	= "$this->template/captcha";

			// submit url
			if( !isset( $this->ajaxUrl ) ) {

				$formSlug		= $this->model->slug;
				$this->ajaxUrl	= "form/$formSlug";
			}

			if( $this->model->captcha ) {

				$captchaHtml = $this->render( $captchaPath );
			}

			$formHtml = $this->render( $formPath, [ 'fieldsHtml' => $fieldsHtml, 'captchaHtml' => $captchaHtml ] );

			// Prepare Form Options
			$modelOptions	= json_decode( $this->model->htmlOptions, true );
			$this->options	= \yii\helpers\ArrayHelper::merge( $this->options, $modelOptions );

			$this->options[ 'action' ]			= $this->ajaxUrl;
			$this->options[ 'method' ]			= 'post';
			$this->options[ 'cmt-app' ]			= 'form';
			$this->options[ 'cmt-controller' ]	= 'form';
			$this->options[ 'cmt-action' ]		= 'default';

			if( !isset( $this->options[ 'class' ] ) ) {

				$this->options[ 'class' ] = 'cmg-form';
			}

			if( !isset( $this->options[ 'id' ] ) ) {

				$this->options[ 'id' ] = "frm-$this->slug";
			}

			if( isset( $this->cmtApp ) ) {

				$this->options[ 'cmt-app' ]	= $this->cmtApp;
			}

			if( isset( $this->cmtController ) ) {

				$this->options[ 'cmt-controller' ] = $this->cmtController;
			}

			if( isset( $this->cmtAction ) ) {

				$this->options[ 'cmt-action' ] = $this->cmtAction;
			}

			if( $this->wrap ) {

				return Html::tag( $this->wrapper, $formHtml, $this->options );
			}

			return $formHtml;
		}
		else {

			echo "<div class=\"warning\">Form not found or submission is disabled.</div>";
		}
	}

	// AjaxForm ------------------------------

}
