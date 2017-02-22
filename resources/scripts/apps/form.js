var formApp	= null;

jQuery( document ).ready( function() {

	// App
	formApp	= new cmt.api.Application( { basePath: ajaxUrl } );

	// Controllers
	var controllers			= [];
	controllers[ 'form' ]	= 'FormController';

	// Init App
	jQuery( '[cmt-app=form]' ).cmtRequestProcessor({
		app: formApp,
		controllers: controllers
	});
});

// == Form App Controllers ===================================

// == Form Controller =====================

FormController	= function() {

};

FormController.inherits( cmt.api.controllers.BaseController );

FormController.prototype.defaultActionPost = function( success, parentElement, message, response ) {

	if( success ) {

		console.log( "form processed successfully." );
	}
};