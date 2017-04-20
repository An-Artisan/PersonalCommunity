<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use org\util\pscws4;
use org\util\phpanalysis;
use org\util\xdb_r;
/**
 * 中文分词系统，获取一段文章标签
 * @Author   不敢为天下
 * @DateTime 2017-04-09T17:27:34+0800
 * @param    [string]                   $title [一段文本]
 * @return   [array]                           [返回标签组]
 */
function get_tags_arr($title)
{
        $pscws = new PSCWS4();
		$pscws->set_dict(EXTEND_PATH. 'org' . DS . 'util' . DS . 'scws' . DS .'dict.utf8.xdb');
		$pscws->set_rule(EXTEND_PATH. 'org' . DS . 'util' . DS . 'scws' . DS .'rules.utf8.ini');
		$pscws->set_ignore(true);
		$pscws->send_text($title);
		$words = $pscws->get_tops(5);
		$tags = array();
		foreach ($words as $val) {
		    $tags[] = $val['word'];
		}
		$pscws->close();
		return $tags;
}
/**
 * 中文分词系统，获取一段文章关键字
 * @Author   不敢为天下
 * @DateTime 2017-04-09T17:29:00+0800
 * @param    [string]                   $content [一段文本]
 * @return   [string]                            [返回关键字，逗号分隔]
 */
function get_keywords_str($content){
	//初始化类时不直接加载词典
    PhpAnalysis::$loadInit = false;
    //是否预载全部词条 否
    $pa = new PhpAnalysis('utf-8', 'utf-8', false);
    //载入词典
    $pa->LoadDict();
    //执行分词
    $pa->SetSource($content);
 	// 新词识别 是
    $pa->unitWord = true;
	// 开始执行分词操作 岐义处理 是
    $pa->StartAnalysis(true);
    // 获取出现频率最高的指定词条数 这里有个BUG 实际数量多1，如果是5 结果就是6
    return $pa->GetFinallyKeywords(4);
}
/**
 * 从一段文本中获取img标签以及src内容以及alt内容，如果有notString参数，表示不提取含有该参数的img标签
 * @Author   不敢为天下
 * @DateTime 2017-04-09T17:24:27+0800
 * @param    [string]                   $str       [一段文本]
 * @param    [string]                   $notString [不提取img标签中含有的字符]
 * @param    [int]                    	$flag 	   [标记，0代表处理array[1],1代表都处理，2不处理]
 * @return   [array]                               [返回一个三维数组 [0][x]代表获取img标签所有，[1][x]代表获取img标签中src中的内容，[2][x]代表获取alt的内容]
 */
function getContentImages($str,$notString = '',$flag = 0){
	/* 
		匹配img和src的正则表达式
		$preg = '/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i';
	*/
	// 内容匹配的正则表达式
	$preg = '/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?alt=[\"|\']?(.*?)[\"|\']?>/i';
	// 开始匹配
	preg_match_all($preg, $str, $imgArr);
	switch ($flag)
	{
	case 0:
		// 只返回第二个数组的img不含有notString的标签
	  	foreach($imgArr[1] as $key=>$value){
				if(strstr($value,$notString)){
					$key = array_search($value ,$imgArr[1]);
					array_splice($imgArr[1],$key,1);
				}
		}
	  	break;
	case 1:
	    // 返回整个数组的img不含有notString的标签
		foreach($imgArr as $key=>$value){
			foreach($value as $key2=>$value2){
				if(strstr($value2,$notString)){
					$key = array_search($value2 ,$value);
					array_splice($value,$key,1);
				}
			}
		}
	  	break;
	case 3:
		break;
	}
	return $imgArr;
}

/**
 * 删除字符串最后一个字符
 * @Author   不敢为天下
 * @DateTime 2017-04-09T23:08:57+0800
 * @param    [string]                   $str [字符串]
 * @return   [string]                        [返回处理后的字符串]
 */
function deleteStringLastChar($str){
	$str = substr($str,0,strlen($str)-1); 
	return $str;
}
/**
 * 删除字符串中图片img标签
 * @Author   不敢为天下
 * @DateTime 2017-04-11T19:47:49+0800
 * @param    [array]                   $arr      [要删除的img标签，是一个数组]
 * @param    [string]                  $content  [要进行删除img标签的文本内容]
 * @return   [string]                            [返回删除后的文本内容]
 */
function deleteDesignateString($arr,$content){
	// 循环替换img标签为空
	foreach ($arr as $key => $value) {
		$content = str_replace($value,'',$content);
	}
	// 返回字符串
	return $content;
}
/**
 * 截取一段包含有html标签的前n个内容，去除html标签
 * @Author   不敢为天下
 * @DateTime 2017-04-11T19:50:20+0800
 * @param    string                   $string   [要处理的字符串]
 * @param    integer                  $length   [截取多少个汉字内容,0表示截取全部]
 * @param    string                   $ellipsis [最后用...替换]
 * @return   string                             [返回处理后的字符串]
 */
function cutstr_html($string,$length=0,$ellipsis='…'){
    $string=strip_tags($string);
    $string=preg_replace('/\n/is','',$string);
    $string=preg_replace('/ |　/is','',$string);
    $string=preg_replace('/&nbsp;/is','',$string);
    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",$string,$string);
    if(is_array($string)&&!empty($string[0])){
        if(is_numeric($length)&&$length){
            $string=join('',array_slice($string[0],0,$length)).$ellipsis;
        }else{
            $string=implode('',$string[0]);
        }
    }else{
        $string='';
    }
    return $string;
}
/**
 * 递归查找文件并删除不存在数组中的文件
 * @Author   不敢为天下
 * @DateTime 2017-04-17T19:28:36+0800
 * @param    [array]                   $images [数组，里面装的图片名]
 * @param    [String]                   $path   [要查找文件的路径]
 * @return   [Boolean]                           [始终为true]
 */
function recursionSeekFiles($images,$path = '.') {
	// opendir()返回一个目录句柄,失败返回false
    $current_dir = opendir($path);  
    // readdir()返回打开目录句柄中的一个条目，返回文件目录名或文件名
    while(($file = readdir($current_dir)) !== false) {    
    	// 构建子目录路径
        $sub_dir = $path . DIRECTORY_SEPARATOR . $file;    
        if($file == '.' || $file == '..') {
            continue;
        }
        //如果是目录,进行递归 
        else if(is_dir($sub_dir)) {    
            recursionSeekFiles($images,$sub_dir);
        }
        //如果是文件,检测该文件是否存在数组中
        else {   
        	// 不存在就删除该文件
            if(!in_array($file,$images)){
            	unlink($path.DIRECTORY_SEPARATOR.$file);
            }
        }
    }
    return true;
}
