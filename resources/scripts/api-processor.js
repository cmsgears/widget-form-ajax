// Forms ------------------------------

function postFormProcessorSuccess( formId, controllerId, actionId, data ) {

	switch( controllerId ) {

		case 'form': {

			switch( actionId ) {

				case 'generic': {

					window.location.replace( loginUrl );

					break;
				}
			}

			break;
		}
	}
}

postCmtApiProcessor.addSuccessListener( postFormProcessorSuccess );