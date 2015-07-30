<?php
// 过滤XSS
function clearXSS($string)
{
	require_once './htmlpurifier/HTMLPurifier.auto.php';
	// 生成配置对象
	$_clean_xss_config = HTMLPurifier_Config::createDefault();
	// 以下就是配置：
	$_clean_xss_config->set('Core.Encoding', 'UTF-8');
	// 设置允许使用的HTML标签
	$_clean_xss_config->set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]');
	// 设置允许出现的CSS样式属性
	$_clean_xss_config->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
	// 设置a标签上是否允许使用target="_blank"
	$_clean_xss_config->set('HTML.TargetBlank', TRUE);
	// 使用配置生成过滤用的对象
	$_clean_xss_obj = new HTMLPurifier($_clean_xss_config);
	// 过滤字符串
	return $_clean_xss_obj->purify($string);
}





// function showImage($image, $width='', $height='')
// {
	// if(!$image)
		// return ;
	// // 无论showImage调用多少次，C函数只调用了一次
	// static $prefix = null;
	// if($prefix === null)
		// $prefix = C('IMAGE_PREFIX');
	// if($width)
		// $width = " width='$width'";
	// if($height)
		// $height = " height='$height'";
	// echo "<img $width $height src='{$prefix}{$image}' />";
// }




/**
 * 删除一个数组中所有的图片
 *
 * @param unknown_type $image
 */
 
 
 
// function deleteImage($image = array())
// {
	// $savePath = C('IMAGE_SAVE_PATH');
	// foreach ($image as $v)
	// {
		// unlink($savePath . $v);
	// }
// }
















