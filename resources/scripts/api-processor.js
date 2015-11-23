FormController	= function() {

};

FormController.inherits( cmt.api.controllers.BaseController );

FormController.prototype.genericActionPost = function( success, parentElement, message, response ) {
	
	if( success ) {

		console.log( "form processed successfully." );
	}
};