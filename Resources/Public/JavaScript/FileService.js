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
			}
		}
	}];
});