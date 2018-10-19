<?php
namespace app\webman\controller;

use app\common\controller\WebmanBase;
use think\facade\Env;


/**
 * 附件上传控制器
 * Class Asset
 * @package app\asset\controller
 */
class Asset extends WebmanBase
{
    /**
     * webuploader 上传
     * type 0 为图片 1为视频 2为压缩包
     */
    public function webuploader()
    {

        if ($this->request->isAjax()) {
            $file = request()->file('file');
            // 根据文件hash值判断文件是否上传过
            $hash = $file->hash();
            $fileModel = model('File');
            $info = $fileModel->exist($hash);
            if ($info) {
                return $this->showCode(1001,'上传成功!',[
                    'hash'=>$hash,
                    'path'=>$info->path
                ]);
            }
            $type = $this->request->param('type',0,'intval');

            switch ($type) {
                case 1: $ext = 'avi,mp4';break;
                case 2: $ext = 'rar,pdf';break;
                case 3: $ext = 'xlsx';break;
                default:
                    $ext = 'jpg,jpeg,png,gif';
            }
            $ds = '/';

            // 移动到框架应用根目录/public/uploads/ 目录下 'jpg,jpeg,png,gif,pdf'
            $file_path = Env::get("root_path") . 'public' .$ds  . 'uploads';
            $info = $file->validate(['size'=>1024*1024*1000,'ext'=>$ext])->move($file_path);

            if ($info === false) {
                return $this->showCode('1041',$file->getError());
            } else {

               $fullPath = $info->getPath().$ds.$info->getFilename();
               $relativePath = str_replace($file_path,'/uploads',$fullPath);
               $res = $fileModel->insertNewFile($relativePath,$hash);
               if ($res) {
                   return $this->showCode(1001,'',['hash'=>$hash,'path'=>$relativePath]);
               }
            }
        }
    }


}
