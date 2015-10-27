<?php
namespace cmsgears\widgets\aform;

// Yii Imports
use yii\web\AssetBundle;
use yii\web\View;

class FormAssetBundle extends AssetBundle {

	// Public variables --------------------------------------------

	// Path Configuration

    public $sourcePath = '@cmsgears/widget-form-ajax/resources';

	// Load CSS

	public $css     = [
		// specify styles
    ];

	// Load Javascript

    public $js      = [
		'scripts/api-processor.js'
    ];

	// Define the Position to load Assets
    public $jsOptions = [
        'position' => View::POS_END
    ];

	// Define dependent Asset Loaders
    public $depends = [
		'yii\web\JqueryAsset'
    ];

	// Constructor and Initialisation ------------------------------

	public function __construct() {

		parent::__construct();
	}
}

?>