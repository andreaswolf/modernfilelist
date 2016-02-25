'use strict';
define(function () {
	return ['$http', function ($http) {
		return {
			/**
			 * Loads files from a storage.
			 *
			 * @param storage The storage to fetch files from
			 * @param path The path to fetch files from
			 */
			getFiles: function (storage, path) {
				return $http.get(TYPO3.settings.ajaxUrls['modernfilelist::getFiles'], {
					"params": {
						"tx_modernfilelist[storage]": storage,
						"tx_modernfilelist[path]": path
					}
				});
			},

			/**
			 * Removes a file from the server.
			 *
			 * @param file
			 */
			deleteFile: function (file) {
				return $http.delete(TYPO3.settings.ajaxUrls['modernfilelist::deleteFile'], {
					"params": {
						"tx_modernfilelist[file]": file.identifier
					}
				});
			},

			/**
			 * Renames a file on the server.
			 *
			 * @param file
			 * @param newName
			 */
			renameFile: function (file, newName) {
				// PUT does not work here, as TYPO3/PHP don’t handle the body properly
				return $http.post(TYPO3.settings.ajaxUrls['modernfilelist::renameFile'], {
					"tx_modernfilelist[file]": file.identifier,
					"tx_modernfilelist[newName]": newName
				}, {
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					transformRequest: function (obj) {
						var str = [];
						for (var p in obj)
							str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
						return str.join("&");
					}
				});
			}
		}
	}];
});