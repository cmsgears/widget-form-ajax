// == Application =========================

jQuery( document ).ready( function() {

	var formApp	= cmt.api.root.registerApplication( 'form', 'cmt.api.Application', { basePath: ajaxUrl } );

	formApp.mapController( 'form', 'cmg.controllers.FormController' );

	cmt.api.utils.request.register( formApp, jQuery( '[cmt-app=form]' ) );
});

// == Controller Namespace ================

var cmg = cmg || {};

cmg.controllers = cmg.controllers || {};

// == Form Controller =====================

cmg.controllers.FormController	= function() { };

cmg.controllers.FormController.inherits( cmt.api.controllers.RequestController );

cmg.controllers.FormController.prototype.defaultActionSuccess = function( requestElement, response ) {

	console.log( 'form processed successfully.' );
};

cmg.controllers.FormController.prototype.defaultActionFailure = function( requestElement, response ) {

	console.log( 'form processing failed.' );
};

// == Direct Calls ========================

// == Additional Methods ==================
