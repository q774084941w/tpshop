<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/4
 * Time: 11:11
 * 模拟发送短信 邮箱信息
 */

namespace app\index\controller;

use PHPMailer\PHPMailer\PHPMailer;
use think\Controller;
use think\Loader;
use think\Request;
use think\Session;

class Begin extends Controller
{

    /**
     * @return int
     * 生成验证码
     */
    public function Code(){
        $code =  mt_rand(1000,9999);
        Session::set('code',$code);
        return $code;
    }

    /**
     * 接收请求，发送短信
     */
    public function index(){
        $phone = Request::instance()->param('phone');
        $code  = $this->Code();
        Loader::import('sms.SDK.CCPRestSDK',EXTEND_PATH);
        $this->sendTemplateSMS("$phone",array($code,3),1);
    }

    /**
     * @param $to
     * @param $datas
     * @param $tempId
     * @return bool|string
     * 发送短信的方法
     */
    private function sendTemplateSMS($to,$datas,$tempId)
    {
        //主帐号
            $accountSid= '8a216da860bad76d0160bef7c2cb0191';
        //主帐号Token
            $accountToken= 'af5cf9e7c1844741b4c65e1d875d1695';
        //应用Id
            $appId='8a216da860bad76d0160bef7c3230197';
        //请求地址，格式如下，不需要写https://
            $serverIP='app.cloopen.com';
        //请求端口
            $serverPort='8883';
        //REST版本号
            $softVersion='2013-12-26';
        // 初始化REST SDK
        //global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
        $rest = new \REST($serverIP,$serverPort,$softVersion);
        $rest->setAccount($accountSid,$accountToken);
        $rest->setAppId($appId);

        // 发送模板短信
        echo "Sending TemplateSMS to $to <br/>";
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);
        if($result == NULL ) {
            echo "result error!";
            return false;
        }
        if($result->statusCode!=0) {
            return "error code :" . $result->statusCode . "<br> error msg :" . $result->statusMsg . "<br>";
            //TODO 添加错误处理逻辑
        }else{
            // 获取返回信息
            $smsmessage = $result->TemplateSMS;
            return "dateCreated:".$smsmessage->dateCreated."<br/> smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
            //TODO 添加成功处理逻辑
        }
    }

    /**
     * @param string $myMail 客户邮箱地址
     * @param int $id 激活的账号id
     * 发送邮件
     */
    public function mail($myMail,$id){
        Loader::import('mailer.src.PHPMailer',EXTEND_PATH);
        Loader::import('mailer.src.Exception',EXTEND_PATH);
        Loader::import('mailer.src.SMTP',EXTEND_PATH);
        $mail = new PHPMailer();
        $mid  = 'fji923urtjhfg789we45'.md5($id).'f2i309jrjf9';
        //echo $mid;exit;
        try {
            //服务器设置
            $mail->SMTPDebug = 0;                                       // 是否开启调试
            $mail->isSMTP();                                            // 是否使用smtp协议
            $mail->Host = 'smtp.163.com';                               // 邮件发送服务器的地址
            $mail->SMTPAuth = true;                                     // smtp 认证
            $mail->Username = '18380425296@163.com';                    // SMTP 用户名
            $mail->Password = 'q697194w';                               // SMTP 密码
            $mail->SMTPSecure = 'tls';                                  // 启用TLS加密，“SSL”也被接受
            $mail->Port = 25;                                           // 连接到的TCP端口

            //收件人
            $mail->setFrom('18380425296@163.com');                       //发送者邮件
            $mail->addAddress($myMail);                                 // 收件人地址
            // $mail->addAddress('ellen@example.com');                   // 多个
            //$mail->addReplyTo('18380425296@163.com', 'Information');     //回复地址(可填可不填)
            // $mail->addCC('cc@example.com');                           //抄送
            //$mail->addBCC('bcc@example.com');                         //密送

            //附件
            //$mail->addAttachment('/var/tmp/file.tar.gz');             //  添加附件
           // $mail->addAttachment('./static/imgs/2017102518254606.jpeg', 'new.jpg');        // 可选的名字

            //内容
            $mail->isHTML(true);                                        // 发送的邮件 是否是html的格式
            $mail->Subject = '激活信息';                                    //邮件主题
            $mail->Body    = 'http://'.$_SERVER['HTTP_HOST'].'/index/user/takemaile/id/'.$mid;               //正文
            $mail->AltBody = '没有发任何东西';                          //没有正文显示

            $mail->send();                                              //发送
            //echo '发送成功';
            return true;
        } catch (Exception $e) {
           /* echo '无法发送消息。';
            echo '邮件错误： ' . $mail->ErrorInfo;*/
            return implode(',',$mail->ErrorInfo);
        }
    }
}