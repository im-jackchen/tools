<?php
//web hook   文件
$json = file_get_contents("php://input");

$data = json_decode($json, true);
$dir = "/home/wwwlogs/webhook/";
$src = $dir . date('Y-m-d', time()) . ".txt";
if (!is_dir($dir)) {
    mkdir($dir, 0777);
}
if (isset($data['ref']) && $data['total_commits_count'] > 0) {
    $time = date('Y-m-d H:i:s');
    $res = "pull start :" . $time . ">>>>>>>>>" . PHP_EOL;
    $res .= shell_exec("cd /home/wwwroot/dir/ &&  git pull");
    $res_log = PHP_EOL . '*****************' . $time . '*******************' . PHP_EOL;
    $res_log .= $data['user_name'] . ' 在' . date('Y-m-d H:i:s') . '向' . $data['repository']['name'] . '项目的' . $data['ref'] . '分支push了' . $data['total_commits_count'] . '个commit：' . $data['head_commit']['message'];
    $res_log .= PHP_EOL . $res;
    $res_log .= "pull end :" . date('Y-m-d H:i:s') . PHP_EOL;
    $res_log .= '********************************************************' . PHP_EOL;
    file_put_contents($src, $res_log, FILE_APPEND); //写入日志到log文件中
    echo 'success';exit();
}
echo 'no commit';exit();

// 1、项目目录所有者www
// 2、.git 权限是否够用
// 3、sudo -u www  git pull   测试哦
// 4、chown -R www:www ./*
