<?php
header("Content-Type:text/html; charset=utf-8");
define('APP_ROOT', str_replace('\\', '/', dirname(__FILE__)));

$con = '真怕有一天我们再次成为交叉线，我想那时就再也不可能回归了，快乐永远是拿痛苦做代价，你现在多幸福，多快乐，你以后就会越伤心越难过，不想发生!';

function get_tags_arr($title)
    {
		require(APP_ROOT.'/pscws4.class.php');
        $pscws = new PSCWS4();
		$pscws->set_dict(APP_ROOT.'/scws/dict.utf8.xdb');
		$pscws->set_rule(APP_ROOT.'/scws/rules.utf8.ini');
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

print_r(get_tags_arr($con));

function get_keywords_str($content){
	require(APP_ROOT.'/phpanalysis.class.php');
	PhpAnalysis::$loadInit = false;
	$pa = new PhpAnalysis('utf-8', 'utf-8', false);
	$pa->LoadDict();
	$pa->SetSource($content);
	$pa->StartAnalysis( false );
	$tags = $pa->GetFinallyResult();
	return $tags;
}

echo (get_keywords_str($con));