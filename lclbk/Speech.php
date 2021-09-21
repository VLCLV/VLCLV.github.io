<?php


namespace app\index\controller;

/**引入类库*/
require_once './extend/speech/AipSpeech.php';

// 你的 APPID AK SK
const APP_ID = '自己的APP_ID';
const API_KEY = '自己的API_KEY';
const SECRET_KEY = '自己的SECRET_KEY';

class Speech
{
    public function toSpeech($content,$vol,$per)
    {


        $client = new \AipSpeech(APP_ID, API_KEY, SECRET_KEY);
        $result = $client->synthesis($content, 'zh', 1, array(
            'vol' => $vol,
            'per' => $per
        ));
// 识别正确返回语音二进制 错误则返回json 参照下面错误码
        $mp3Name = time() . '.mp3';
        if(!is_array($result)){
            file_put_contents('./mp3/'.$mp3Name, $result);
        }
        return './mp3/'.$mp3Name;
    }



}

$content = $_POST['content'];
$vol = $_POST['vol'];
$per = $_POST['per'];
$obj = new Speech();
$url = $obj->toSpeech($content,$vol,$per);
echo json_encode(['msg'=>'成功','code'=>1,'url'=>$url]);