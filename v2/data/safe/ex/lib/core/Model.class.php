<?php
/**
 * 模型抽象类
 * 一个关于各种模型的基本行为类，每个模型都必须继承这个类的方法
 */

abstract class Model {
	var $db = null;
	var $in;
	var $config;

	/**
	 * 构造函数
	 * @return Null 
	 */
	function __construct(){
		global $g_config, $in;
		$this -> in = $in;
		$this -> config = $config;
	}
}