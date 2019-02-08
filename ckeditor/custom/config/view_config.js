

CKEDITOR.editorConfig = function( config ) {
	config.allowedContent = true;

	config.plugins = 'wysiwygarea,enterkey';
	
	config.height= 500;

	config.enterMode = CKEDITOR.ENTER_BR;
	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';
	config.startupShowBorders= false;

};
