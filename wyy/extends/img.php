<?php
/*
 *  图片处理类.
 *  weiyeying 
 * 2015-7-24
 */

class Img {

    public function test(){
        echo 1111;die;
    }
    //上传图片
    public function uploadimg($img, $savepath, $savempath, $thumwidth, $thumheight) {
        $type = explode(".", $img['name']);
        $file = time() . rand(0, 1000) . '.' . $type[1];
        $this->mkFolder($savepath);
        $this->mkFolder($savempath);
        $r = move_uploaded_file($img['tmp_name'], $savepath . $file);
        if ($r) {
            $big_img = $savepath . '/' . $file;
            $small_img = $savempath . '/' . $file;
            $this->img_create_small($big_img, $thumwidth, $thumheight, $small_img);
        }
        return date('ymd', time()) . "/" . $file;
    }

    //创建文件
    private function mkFolder($path) {
        if (!is_readable($path)) {
            is_file($path) or mkdir($path, 0700, true);
        }
    }

    //缩略图
    private function img_create_small($big_img, $width, $height, $small_img) {//原始大图地址，缩略图宽度，高度，缩略图地址
        $imgage = getimagesize($big_img); //得到原始大图片
        switch ($imgage[2]) { // 图像类型判断
            case 1:
                $im = imagecreatefromgif($big_img);
                break;
            case 2:
                $im = imagecreatefromjpeg($big_img);
                break;
            case 3:
                $im = imagecreatefrompng($big_img);
                break;
        }
        $src_W = $imgage[0]; //获取大图片宽度
        $src_H = $imgage[1]; //获取大图片高度
        $tn = imagecreatetruecolor($width, $height); //创建缩略图
        imagecopyresampled($tn, $im, 0, 0, 0, 0, $width, $height, $src_W, $src_H); //复制图像并改变大小
        imagejpeg($tn, $small_img); //输出图像
    }

}
?>

