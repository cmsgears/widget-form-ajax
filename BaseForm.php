<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\form;

// CMG Imports
use cmsgears\core\common\base\Widget;

/**
 * BaseForm is the base class for dynamic forms.
 *
 * @since 1.0.0
 */
abstract class BaseForm extends Widget {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	/**
	 * Form model for which form has to be submitted.
	 *
	 * @var \cmsgears\core\common\models\resources\Form
	 */
    public $model;

	/**
	 * The form model to be submitted for the form.
	 *
	 * @var \cmsgears\core\common\models\forms\GenericForm
	 */
	public $form;

	/**
	 * Model name used to collect form fields.
	 *
	 * @var string
	 */
	public $formName;

	/**
	 * Flag to check whether form labels are displayed.
	 *
	 * @var boolean
	 */
	public $labels = true;

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// BaseForm ------------------------------

}
