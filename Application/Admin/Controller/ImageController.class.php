<?php
/**
 *图片上传处理类
 */
namespace Admin\Controller;

use \Think\Controller;
use Think\Upload;

class ImageController extends CommonController
{
    private $_uploadObj;

    public function __construct()
    {

    }

    public function ajaxuploadimage()
    {
        $upload = D('UploadImage');
        $rs = $upload->imageUpload();
        if ($rs === false) {
            return show(0, '上传失败', '');
        } else {
            return show(1, '上传成功', $rs);
        }
    }

    public function kindupload()
    {
        $upload = D('UploadImage');
        $rs = $upload->upload();
        if ($rs === false) {
            return showKind(1, '上传失败');
        } else {
            return showKind(0, $rs);
        }
    }
}