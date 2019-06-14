<?php

// +----------------------------------------------------------------------
// | duolaibei V2
// +----------------------------------------------------------------------
// | Copyright (c) 2019 http://www.duolaibei.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( https://www.gnu.org/licenses/lgpl.html )
// +----------------------------------------------------------------------
// | Author: chenjf <i@1890.tv>
// +----------------------------------------------------------------------
namespace tool;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Qiniu
{

    public static function qiniuUpload($filePath)
    {

        $accessKey       = "6LVwzFTtJxc7e5wmN1__imadWWZ1PYiFydJwoVqq";
        $secretKey       = "DZExm73QtcSIOToRt7UvPjTP6_qgxjTJvHbqi717";
        $bucket          = "dlb";
        $auth            = new Auth($accessKey, $secretKey);
        $token           = $auth->uploadToken($bucket);
        $key             = basename($filePath);
        $uploadMgr       = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            return $err;
        } else {
            return $ret;
        }
    }
}
