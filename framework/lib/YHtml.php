<?php

/**
 * HTML处理类
 * 
 * @author ShuangYa
 * @package SYFramework
 * @category Library
 * @link http://www.sylingd.com/
 * @copyright Copyright (c) 2015 ShuangYa
 * @license http://lab.sylingd.com/go.php?name=framework&type=license
 */

namespace sy\lib;
use Sy;

class YHtml {
	/**
	 * 输出meta标签
	 * @param array $set 自设定标签，为空则不输出
	 * @return string
	 */
	public static function meta($set = NULL) {
		$set = (array )$set;
		$out = ['http-equiv|content-type' => 'text/html; charset=' . Sy::$app['charset'], 'http-equiv|X-UA-Compatible' => 'IE=edge'];
		$out = array_merge($out, $set);
		$r = '';
		foreach ($out as $k => $v) {
			if (empty($v)) {
				continue;
			}
			list($name, $value) = explode('|', $k);
			$r .= '<meta ' . $name . '="' . $value . '" content="' . static::encode($v) . '">';
		}
		return $r;
	}
	/**
	 * 经过封装的htmlspecialchars
	 * @access public
	 * @param string $str
	 * @return string
	 */
	public static function encode($str) {
		return htmlspecialchars($str, ENT_QUOTES, Sy::$app['charset']);
	}
	/**
	 * 经过封装的htmlspecialchars_decode
	 * @access public
	 * @param string $str
	 * @return string
	 */
	public static function decode($str) {
		return htmlspecialchars_decode($str, ENT_QUOTES, Sy::$app['charset']);
	}
	/**
	 * 获取绝对路径
	 * @access public
	 * @param string $url 地址
	 * @return string
	 */
	public static function getWebPath($url) {
		$url = str_replace('@root/', Sy::$siteDir, $url);
		// TODO: 增加@app支持
		$url = str_replace('@app/', Sy::$siteDir, $url);
		return $url;
	}
	/**
	 * 输出CSS
	 * @access public
	 * @param string $url CSS地址
	 * @return string
	 */
	public static function css($url) {
		if (strpos($url, '://') === FALSE) {
			$url = static::getWebPath($url);
		}
		return '<link rel="stylesheet" href="' . $url . '"/>';
	}
	/**
	 * 输出JS
	 * @access public
	 * @param string $url JS地址
	 * @return string
	 */
	public static function js($url) {
		if (strpos($url, '://') === FALSE) {
			$url = static::getWebPath($url);
		}
		return '<script type="text/javascript" src="' . $url . '"></script>';
	}
}
