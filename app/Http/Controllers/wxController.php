<?php
/**
 * Created by PhpStorm.
 * User: zz-med
 * Date: 2018/12/26
 * Time: 下午4:06
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;

class wxController extends Controller
{
    public function index()
    {
        $timestamp = $_GET['timestamp'];//timestamp其实就是一个时间戳
        $nonce = $_GET['nonce'];//nonce是一个随机参数
        $token = "weixin";//这个token填写你在微信公众平台上写的那个值
        $signature = $_GET['signature'];//这个signature其实就是在微信公众平台已经加密好的字符串
        $echostr = $_GET['echostr'];
        $array = array($timestamp, $nonce, $token);
        sort($array);

        $tmpstr = implode('', $array);
        $tmpstr = sha1($tmpstr);

        if ($tmpstr == $signature && $echostr) {

            echo $echostr;
            exit;
        } else {
            $this->reponseMsg();
        }
    }

    public function reponseMsg()
    {
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        $postObj = simplexml_load_string($postArr);
        if (strtolower($postObj->MsgType) == 'event') {
            //如果是关注事件(subscribe)
            if (strtolower($postObj->Event == 'subscribe')) {
                //回复用户消息
                $toUser = $postObj->FromUserName;
                $fromUser = $postObj->ToUserName;
                $time = time();
                $msgType = 'text';
                $content = '欢迎关注 个人分享 微信公众账号' . $postObj->FromUserName . '-' . $postObj->ToUserName;
                $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
                $info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
                echo $info;
            }
        }
        Log::info('参数--'.$postObj->Content);
        //回复纯文本或单图文消息
        if (($postObj->MsgType) == 'text' && trim($postObj->Content) == '夏目友人帐') {
            $toUser = $postObj->FromUserName;
            $fromUser = $postObj->ToUserName;
            $arr = array(
                array(
                    'title' => '夏目友人帐',
                    'description' => "此生无悔入夏目",
                    'picUrl' => 'http://img4.duitang.com/uploads/item/201508/16/20150816015528_X8dKY.jpeg',
                    'url' => 'http://www.shulvchen.cn',
                ),
            );
            $template = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>" . count($arr) . "</ArticleCount>
						<Articles>";
            foreach ($arr as $k => $v) {
                $template .= "<item>
							<Title><![CDATA[" . $v['title'] . "]]></Title> 
							<Description><![CDATA[" . $v['description'] . "]]></Description>
							<PicUrl><![CDATA[" . $v['picUrl'] . "]]></PicUrl>
							<Url><![CDATA[" . $v['url'] . "]]></Url>
							</item>";
            }
            $template .= "</Articles>
						</xml> ";
            echo sprintf($template, $toUser, $fromUser, time(), 'news');
        } else {
            switch (trim($postObj->Content)) {
                case 'bb':
                    $content = '我喜欢你';
                    break;
                case '良玉':
                    $content = '我喜欢你';
                    break;
                case '书旅':
                    $content = '加油';
                    break;
                case 'dsdf':
                    $content = '不愿错过他';
                    break;
                case '垒哥':
                    $content = '垒哥已死，有事儿烧纸';
                    break;
                case '书旅and良玉':
                    $content = 'Forever with you';
                    break;
                case '学弟':
                    $content = '书旅是你学长';
                    break;
                default:
                    $content = "<a href='http://www.baidu.com'>百度一下，你就知道(点击文字，进入百度)</a>";

            }
            $template1 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
            $fromUser = $postObj->ToUserName;//消息从哪里来
            $toUser = $postObj->FromUserName;//发送给谁
            $time = time();
            //$content  = '我喜欢你';
            $msgType = 'text';
            echo sprintf($template1, $toUser, $fromUser, $time, $msgType, $content);
        }
    }
}