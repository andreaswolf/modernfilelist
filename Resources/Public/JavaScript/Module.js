'use strict';
define(['TYPO3/CMS/Modernfilelist/FileService', 'TYPO3/CMS/Modernfilelist/FileListController'],
	function(FileService, FileListController) {
		// Angular must be loaded at this point already
		var mod = angular.module('filelistApp', ['angularUtils.directives.dirPagination']);

		mod.controller('FileListController', FileListController)
			.factory('FileService', FileService)
			// https://gist.github.com/thomseddon/3511330
			.filter('bytes', function() {
				return function(bytes, precision) {
					if (isNaN(parseFloat(bytes)) || !isFinite(bytes)) {
						return '-';
					}
					if (typeof precision === 'undefined') {
						precision = 1;
					}
					if (bytes === 0) {
						return '0 B';
					}
					var units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'],
						number = Math.floor(Math.log(bytes) / Math.log(1024));
					return (bytes / Math.pow(1024, Math.floor(number))).toFixed(precision) +  ' ' + units[number];
				}
			});

		return mod;
	});