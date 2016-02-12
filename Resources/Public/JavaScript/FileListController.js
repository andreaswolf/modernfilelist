'use strict';
define(function () {
	return ['$attrs', 'FileService', function($attrs, FileService) {
		var that = this;
		FileService.getFiles($attrs['storage'], $attrs['path']).success(function(data) {
			console.debug(data);
			that.files = data['files'];
		});

	}];
});