# tools
工具仓库

## DoRedis redis操作类
依赖phpredis扩展

## Excel excel封装类
依赖 phpoffice/phpspreadsheet

## Qiniu 七牛上传类
依赖 qiniu/php-sdk

## Image 二维码生成
依赖 endroid/qr-code 

## ImageMer 图片合成
依赖 Grafika

	(new \tools\Image)
	->setSource(__PUBLIC__ . '/miniqrcode/source/bg.png')
	->blend(__PUBLIC__ . '/miniqrcode/source/goods.png', 0, 240)
	->blend(__PUBLIC__ . '/miniqrcode/source/qr.png', 0, 1404, 356)
	->blend(__PUBLIC__ . '/miniqrcode/source/ms.png', 40, 1280)
	->text('透气舒爽舒爽的舒亚麻3件套 ...', 32, 60, 1200)
	->text('¥10999.90', 50, 640, 1284, '#FD6981')
	->text('¥10269.90', 36, 220, 1300, '#868686')
	->save();

## webhook 二维码生成
 码云gitee php webhook文件