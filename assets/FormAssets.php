<?php
namespace cmsgears\widgets\aform\assets;

// Yii Imports
use yii\web\View;

class FormAssets extends \yii\web\AssetBundle {

	// Public variables --------------------------------------------

	// Path Configuration

    public $sourcePath = '@cmsgears/widget-form-ajax/resources';

	// Load CSS

	public $css     = [
		// specify styles
    ];

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
		'yii\web\JqueryAsset',
		'cmsgears\core\common\assets\CmgToolsJs'
    ];

	// Constructor and Initialisation ------------------------------

	public function __construct() {

		parent::__construct();
	}
}
