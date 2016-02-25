'use strict';
define(function () {
	return ['$attrs', '$scope', 'FileService', function($attrs, $scope, FileService) {

		$scope.showOnlyWithoutReferences = false;
		$scope.nameFilter = "";

		var that = this;
		FileService.getFiles($attrs['storage'], $attrs['path']).success(function(data) {
			that.files = data['files'];
		});

		$scope.filterFileList = function() {
			return function (file) {
				return (!$scope.showOnlyWithoutReferences || file['_referenceCount'] == 0) &&
					($scope.nameFilter == "" || file['name'].toLowerCase().indexOf($scope.nameFilter.toLowerCase()) != -1);
			};
		}

	}];
});