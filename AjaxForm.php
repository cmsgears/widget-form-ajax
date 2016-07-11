<?php
namespace cmsgears\widgets\aform;

// Yii Imports
use \Yii;
use yii\helpers\Html;
use yii\helpers\Url;

// CMG Imports
use cmsgears\core\common\config\CoreGlobal;

use cmsgears\widgets\aform\assets\FormAssets;

use cmsgears\core\common\utilities\FormUtil;

class AjaxForm extends \cmsgears\widgets\form\BaseForm {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $slug;
	public $type			= CoreGlobal::TYPE_SITE;

	public $ajaxUrl;

	public $cmtController	= null;
	public $cmtAction		= null;

	// Protected --------------

	protected $formService;

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function init() {

		parent::init();

		$this->formService = Yii::$app->factory->get( 'formService' );
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
		if( !isset( $this->form ) && isset( $this->slug ) ) {

			$this->form		= $this->formService->getBySlugType( $this->slug, $this->type );
		}

		if( isset( $this->form ) && $this->form->active ) {

			// fields and html
			$fieldsHtml		= FormUtil::getApixFieldsHtml( $this->form, $this->model, [ 'label' => $this->showLabel, 'modelName' => $this->modelName ] );
			$captchaHtml	= null;

			// Views Path
			$formPath		= "$this->template/form";
			$captchaPath	= "$this->template/captcha";

			// submit url
			if( !isset( $this->ajaxUrl ) ) {

				$formSlug		= $this->form->slug;
				$this->ajaxUrl	= "form/$formSlug";
			}

			if( $this->form->captcha ) {

				$captchaHtml	= $this->render( $captchaPath );
			}

			$formHtml 		= $this->render( $formPath, [ 'fieldsHtml' => $fieldsHtml, 'captchaHtml' => $captchaHtml ] );

			$this->options[ 'action' ]			= $this->ajaxUrl;
			$this->options[ 'method' ]			= 'post';
			$this->options[ 'cmt-controller' ]	= 'form';
			$this->options[ 'cmt-action' ]		= 'generic';

			if( !isset( $this->options[ 'class' ] ) ) {

				$this->options[ 'class' ]	= 'cmt-form';
			}

			if( !isset( $this->options[ 'id' ] ) ) {

				$this->options[ 'id' ]	= "frm-$this->slug";
			}

			if( isset( $this->cmtController ) ) {

				$this->options[ 'cmt-controller' ]	= $this->cmtController;
			}

			if( isset( $this->cmtAction ) ) {

				$this->options[ 'cmt-action' ]	= $this->cmtAction;
			}

	        return Html::tag( 'form', $formHtml, $this->options );
		}
		else {

			echo "<div class='warning'>Form not found or submission is disabled by site admin.</div>";
		}
	}

	// AjaxForm ------------------------------
}

?>