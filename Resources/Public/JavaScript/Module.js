'use strict';
define(['TYPO3/CMS/Modernfilelist/FileService', 'TYPO3/CMS/Modernfilelist/FileListController'],
	function(FileService, FileListController) {
		// Angular must be loaded at this point already
		var mod = angular.module('filelistApp', ['angularUtils.directives.dirPagination']);

		mod.controller('FileListController', FileListController)
			.factory('FileService', FileService);

		return mod;
	});