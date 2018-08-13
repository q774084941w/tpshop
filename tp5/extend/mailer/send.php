<?php
	require "./phpmailer/src/PHPMailer.php";
    require "./phpmailer/src/Exception.php";
    require "./phpmailer/src/SMTP.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // 是否开启调试
        $mail->isSMTP();                                      // 是否使用smtp协议
        $mail->Host = 'smtp.163.com';  // 邮件发送服务器的地址
        $mail->SMTPAuth = true;                               // smtp 认证
        $mail->Username = '18381302081@163.com';                 // SMTP username
        $mail->Password = 'hm123465';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('18381302081@163.com', 'Mailer');//发送者邮件
        $mail->addAddress('2789468295@qq.com', 'Joe User');     // 收件人地址
//        $mail->addReplyTo('info@example.com', 'Information');
//        $mail->addCC('cc@example.com');//抄送
//        $mail->addBCC('bcc@example.com');//密送

        //Attachments
//        $mail->addAttachment('/var/tmp/file.tar.gz');         // 添加附件
//        $mail->addAttachment('./spacer1e9c5d.gif', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // 发送的邮件 是否是html的格式
        $mail->Subject = 'Here is the subject'; //邮件主题
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>'; //正文
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }