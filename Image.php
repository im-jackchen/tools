<?php

namespace tool;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;

// use Endroid\QrCode\Response\QrCodeResponse;

// +----------------------------------------------------------------------
/**
 ** @author: chenjf
 ** mailto: i@1890.tv
 ** create time: 2019-05-15 13:59:00
 ** descr:  图片操作类
 **/
class Image
{
    /**
     ** @author: chenjf
     ** mailto: i@1890.tv
     ** create time: 2019-05-15 13:59:50
     ** descr:  二维码生成    //str 二维码参数   title   下方标题    src  logo路径
     **/
    public static function generateQrCodeBystr($str, $title = '', $src = '', $imgSrc = '')
    {

        // Create a basic QR code
        $qrCode = new QrCode($str);
        $qrCode->setSize(270);
        // Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setMargin(10);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH));
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        if ($title != '') {
            $qrCode->setLabel($title, 16, __DIR__ . '/../../vendor/endroid/qr-code/assets/fonts/noto_sans.otf', LabelAlignment::CENTER);
        }
        if ($src != '') {
            $qrCode->setLogoPath($src);
            $qrCode->setLogoSize(70, 70);
        }
        $qrCode->setRoundBlockSize(true);
        $qrCode->setValidateResult(false);
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);

        $qrCode->writeFile($imgSrc);
        // Directly output the QR code
        header('Content-Type: ' . $qrCode->getContentType());

        echo $qrCode->writeString();exit();
    }
}
