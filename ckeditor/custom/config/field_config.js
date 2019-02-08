

CKEDITOR.editorConfig = function( config ) {

	config.allowedContent = true;
	config.plugins = 'basicstyles,clipboard,colorbutton,copyformatting,elementspath,enterkey,listblock,font,format,wysiwygarea,indent,indentblock,indentlist,justify,list,liststyle,pastetext,removeformat,selectall,stylescombo,undo';

	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', '-', 'undo' ] },
		{ name: 'editing',     groups: [ 'selection'] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'colors' },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'align'] }
	];

	config.enterMode = CKEDITOR.ENTER_BR;
	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	config.removeButtons = 'PasteFromWord';

	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';
};
