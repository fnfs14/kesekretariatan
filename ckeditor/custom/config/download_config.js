

CKEDITOR.editorConfig = function( config ) {
	config.allowedContent = true;

	config.plugins = 'print,wysiwygarea,pastetext';
	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbar = [
		{ name: 'document',	 items: ['Print']},
	];

	config.height= 500;

	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	config.removeButtons = 'Anchor,Save';

	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';
};
