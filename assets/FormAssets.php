<?php
namespace cmsgears\widgets\aform\assets;

// Yii Imports
use yii\web\View;

class FormAssets extends \yii\web\AssetBundle {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $sourcePath = '@cmsgears/widget-form-ajax/resources';

	// Load Javascript
    public $js      = [
		'scripts/apps/form.js'
    ];

	// Define the Position to load Assets
    public $jsOptions = [
        'position' => View::POS_END
    ];

	// Define dependent Asset Loaders
    public $depends = [
		'cmsgears\core\common\assets\Jquery',
		'cmsgears\core\common\assets\CmgToolsJs'
    ];

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function init()  {

		parent::init();

		// Override assets
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// FormAssets ----------------------------

}
