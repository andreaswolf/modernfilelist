'use strict';
define(function () {
	return ['$attrs', '$scope', 'FileService', function($attrs, $scope, FileService) {

		/**
		 * Polyfill for the TYPO3 notification system; needs to be replaced with a real adapter to the core
		 * notification system.
		 */
		var Notification = {
			success: function(title, text) {
				// TODO implement
				console.info("Success: " + text)
			},
			error: function(title, text) {
				// TODO implement
				console.error("Error: " + text)
			}
		};

		$scope.showOnlyWithoutReferences = false;
		$scope.nameFilter = "";

		$scope.actions = {
			/**
			 * Deletes the given file.
			 *
			 * @param file
			 */
			deleteFile: function(file) {
				if (confirm("Datei '" + file.name + "' wirklich löschen?") == true) {
					FileService.deleteFile(file)
						.success(function (data, status) {
							Notification.success('Operation succeeded', 'File deleted successfully');
							that.files = that.files.filter(function(item) {
								return item.name != file.name;
							})
						})
						.error(function(data, status) {
							Notification.error('Deleting failed', 'File could not be deleted: ' + data['error']);
						});
				}
			}
		};

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