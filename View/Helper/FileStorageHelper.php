<?php
/**
 * FileStorageHelper
 *
 */
class FileStorageHelper extends AppHelper {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array(
		'Html'
	);

/**
 * Generates an image url based on the image record data and the used Gaufrette adapter to store it
 *
 * @param array $image FileStorage array record or whatever else table that matches this helpers needs without the model, we just want the record fields
 * @param string $version Image version string
 * @param array $options HtmlHelper::image(), 2nd arg options array
 * @return string
 */
	public function display($file, $options = array()) {
		$url = $this->url($file, $options);
		if ($url !== false) {
			if ($file['mime_type'] === 'application/pdf') {
				return $this->Html->image('/file_manager/img/pdf-icon.png', $options);
			}
			return $this->Html->image('/file_manager/img/doc-icon.png', $options);
		}
		
		return $this->fallbackImage($options, $file, $version);
	}

/**
 * Url method
 * 
 */	
	public function url($file = null, $options = array()) {
		if (!empty($file)) {
			return $this->settings['prefix'] . $file['path'] . $file['filename'];
		} else {
			return $this->fallbackUrl($options);
		}
	}

/**
 * Provides a fallback image url if the image record is empty
 *
 * @param array $options
 * @param array $image
 * @param string $version
 * @return string
 */
	public function fallbackUrl($options = array()) {
		if (isset($options['fallback'])) {
			return $options['fallback'];
		}
		return 'http://placehold.it/100x100/ffffff';
	}

/**
 * Turns the windows \ into / so that the path can be used in an url
 *
 * @param string $path
 * @return string
 */
	// public function normalizePath($path) {
		// $path = str_replace("//", "/", $path);
		// $path = str_replace("\\", "/", $path);
		// $path = str_replace("http:/", "http://", $path);
		// return $path;
	// }
// 	
	// public function isImage($data) {
		// if($model = FileStorageUtils::detectModelByFileType($data['mime_type'])) {
			// if($model == "ImageStorage") {
				// return true;
			// }
		// }
		// return false;
	// }
	

}