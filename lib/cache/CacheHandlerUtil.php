<?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 * 
 * Multi-licensed: BSD 3-Clause | Apache 2.0 | GNU LGPL v3 | HLNC License (http://bloxtor.com/LICENSE_HLNC.md)
 * Choose one license that best fits your needs.
 *
 * Original PHP Cache Lib Repo: https://github.com/a19836/phpcachelib/
 * Original Bloxtor Repo: https://github.com/a19836/bloxtor
 *
 * YOU ARE NOT AUTHORIZED TO MODIFY OR REMOVE ANY PART OF THIS NOTICE!
 */

include_once get_lib("util.HashCode");

class CacheHandlerUtil {
	/*private*/ const CACHE_FILE_EXTENSION = "cache";
	
	public static function getCacheFilePath($file_path) {
		if ($file_path)
			$file_path = $file_path . "." . self::CACHE_FILE_EXTENSION;
		
		return $file_path;
	}
	
	public static function getFilePathKey($file_name) {
		return HashCode::getHashCodePositive($file_name);
	}
	
	public static function configureFolderPath(&$dir_path) {
		$dir_path .= $dir_path && substr($dir_path, -1) != "/" ? "/" : "";
	}
	
	public static function preparePath($dir_path) {
		/*$dir_path_aux = $dir_path;
		$folders_to_create = array();
		do {
			if(file_exists($dir_path_aux))
				break;
			
			$folders_to_create[] = $dir_path_aux;
			$dir_path_aux = dirname($dir_path_aux);
		} while($dir_path_aux && $dir_path_aux != "/" && $dir_path_aux != "." && $dir_path_aux != "..");
	
		for($i = count($folders_to_create) - 1; $i >= 0; --$i) {
			$folder_to_create = $folders_to_create[$i];
			$base_name = basename($folder_to_create);
			
			if($base_name != ".." && $base_name != ".") {
				//echo "$folder_to_create\n";
				if(!mkdir($folder_to_create, 0777))
					return false;
			}
		}
		return true;*/
		
		return !empty($dir_path) && !file_exists($dir_path) ? @mkdir($dir_path, 0755, true) : true;//before it was 0777. It the framework starts giving errors, it could be because of this.
	}
	
	public static function serializeContent($content) {
		return serialize($content);
	}
	
	public static function unserializeContent($content) {
		return !empty($content) ? unserialize($content) : false;
	}
}
?>
