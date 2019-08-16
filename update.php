<?php

function send($post_string)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://oapi.dingtalk.com/robot/send?access_token=c163a1dd1140abfa92d82856752854a569324f9fd41e7142431a88ddfe8a21e1');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_string));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
    // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function WarningNotice($text, $title = '开发服务器git更新')
{
    $data = [
        "msgtype" => "markdown",
        "markdown" => [
            "title" => $title,
            "text" => "## " . $title . "
> " . $text,
        ],
        "isAtAll" => true,
    ];
    // echo json_encode($data);die;
    return send($data);
}

$json = file_get_contents("php://input");

$data = json_decode($json, true);
$dir = "/home/wwwlogs/webhook/";
$src = $dir . date('Y-m-d', time()) . ".txt";
if (!is_dir($dir)) {
    mkdir($dir, 0777);
}
if (isset($data['ref']) && $data['total_commits_count'] > 0) {
    $time = date('Y-m-d H:i:s');
    $res = "> pull start :" . $time . ">>>>>>>>>" . PHP_EOL;
    //$res .= shell_exec("cd /home/wwwroot/wdy.50it.top/ && git reset --hard && git pull");
    exec("cd /home/wwwroot/wdy.50it.top/ && git reset --hard && git pull", $temp);
    foreach ($temp as $key => $_temp) {
        $res .= $_temp . PHP_EOL;
    }
    $res .= $temp;
    $res_log = PHP_EOL . '> *****************' . $time . '*******************' . PHP_EOL;
    $res_log .= '#### ' . $data['user_name'] . ' 在' . date('Y-m-d H:i:s') . '向' . $data['repository']['name'] . '项目的' . $data['ref'] . '分支push了' . $data['total_commits_count'] . '个commit：' . $data['head_commit']['message'];
    $res = str_replace('\n', PHP_EOL, $res);
    $res_log .= PHP_EOL . $res . PHP_EOL;
    $res_log .= "> pull end :" . date('Y-m-d H:i:s') . '<<<<<<<<<' . PHP_EOL;
    WarningNotice($res_log);
    $res_log .= '********************************************************' . PHP_EOL;
    file_put_contents($src, $res_log, FILE_APPEND); //写入日志到log文件中
    echo 'success';exit();
}
echo 'no commit';exit();

// 1、项目目录所有者www
// 2、.git 权限是否够用
// 3、sudo -u www  git pull   测试哦
// 4、chown -R www:www ./*
