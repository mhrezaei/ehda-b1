tinymce.init({
	selector: '.tinyEditor' ,
	menubar: false ,
//                  theme: 'modern',
	content_css: assets()+'/css/tinyMCE.min.css',
	directionality : 'rtl',
	language: 'fa',
	plugins: "link,table,textcolor",
	toolbar: ['undo redo | bold italic underline strikethrough | copy cut paste removeformat | link unlink inserttable ',
		    'alignleft aligncenter alignright | bullist numlist | outdent indent | forecolor backcolor forecolorpicker backcolorpicker'
	],
	theme_advanced_buttons1 : "link,unlink"
});
//            $(this).removeClass('tinyEditor');
