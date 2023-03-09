<?php
include 'QC.class.php';
include 'QC.conf.php';
$return_url = empty($_GET['return_url']) ? exit('回调地址不可为空！') : $_GET['return_url'];
$token = empty($_GET['token']) ? exit('Token不可为空！') : $_GET['token'];
$QC_config["callback"] = 'http://www.koock.cn/qqlogin/return.php?return_url=' . $return_url . '&token=' . $token;
$QC = new QC($QC_config);
$access_token = $QC->qq_callback();
$openid = $QC->get_openid($access_token);
$url = $return_url . '?openid=' . $openid . '&token=' . $token;
header("Location:$url");