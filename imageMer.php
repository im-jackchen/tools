<?php
namespace tools;

use Grafika\Color;
use Grafika\Grafika;

/**
 ** @author:      chenjf
 ** @mailto:      i@1890.tv
 ** @create time: 2019-08-15 13:50:05
 ** @descr:       图片处理类
 **/
class Image
{
    private $font = __DIR__ . '/../../public/miniqrcode/source/font/msyh.ttc';
    private $editor = [];
    private $image = [];

    public function __construct()
    {
        $this->editor = Grafika::createEditor();
    }
    public function setSource($input1)
    {
        $this->image = Grafika::createImage($input1);
        return $this;
    }
    public function blend($input2, $offset_x = 10, $offset_y = 10, $size = 0)
    {

        $image2 = Grafika::createImage($input2);
        if ($size) {
            $this->editor->resizeExactWidth($image2, $size);
        }
        $this->editor->blend($this->image, $image2, 'normal', 1, 'top-center', $offset_x, $offset_y);
        return $this;
    }
    public function text($text, $size = '28', $offset_x = '0', $offset_y = '0', $color = '#000000')
    {
        $this->editor->text($this->image, $text, $size, $offset_x, $offset_y, new Color($color), $this->font);
        return $this;
    }
    public function save()
    {
        $src = './miniqrcode/temp/' . time() . uniqid() . '.png';
        $this->editor->save($this->image, $src);
        return $src;
    }

}
