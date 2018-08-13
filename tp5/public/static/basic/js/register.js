/**
 * Created by Administrator on 2018/1/5.
 */
$(document).ready(function(){
    $('#doc-my-tabs').tabs();
    var InterValObj; //timer变量，控制时间
    var curCount;
    $('#sendMobileCode').click(function () {
        sendMobileCode();
    });
    function sendMobileCode() {
        var phone = $('#phone').val();
        //console.log(typeof (phone));
        if(phone != ''){
            curCount = 60;
            //设置button效果，开始计时
            $("#btnSendCode").attr("disabled", "true");
            $("#btnSendCode").empty();
            $("#btnSendCode").append(curCount );
            InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
            //向后台发送处理数据
            $.ajax({
                type: "POST", //用POST方 式传输
                dataType: "text", //数据格式:JSON
                url: 'http://www.tpshop.com/index/begin', //目标地址
                data: {
                    'phone':phone
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) { },
                success: function (msg){ }
            });
        }

    }
    //timer处理函数
    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $("#btnSendCode").removeAttr("disabled");//启用按钮
            $("#btnSendCode").empty();
            $("#btnSendCode").append('获取');
            code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
        }
        else {
            curCount--;
            $("#btnSendCode").empty();
            $("#btnSendCode").append(curCount);
        }
    }
    //处理邮件注册
    $('#email_sub').click(function(){
        var pass     = $('input[placeholder="设置密码"]').eq(0).val();
        var pass2    = $('input[placeholder="确认密码"]').eq(0).val();
        if(pass==pass2){
            var formDate = new FormData($('#email_form')[0]);
            $.ajax({
                type : "POST", //用POST方 式传输
                dataType: "text", //数据格式:JSON
                url  : 'email', //目标地址
                data : formDate,
                contentType : false,
                processData : false,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.alert('出错啦!'+errorThrown,{
                        title: '提示框',
                        icon:0
                    });
                },
                success: function (msg){
                    if(msg==1100){
                        layer.alert('请前往邮箱激活!',{
                            title: '提示框',
                            icon:1
                        });
                        setInterval(function(){
                            window.history.back();
                        },2000);
                    }else {
                        layer.alert('失败了!'+msg,{
                            title: '提示框',
                            icon:0
                        });
                    }
                }
            });
        }else {
            layer.alert('密码不一致!',{
                title: '提示框',
                icon:0
            });
        }

    });
    //处理手机号
    $('#phone_sub').click(function(){
        var pass     = $('input[placeholder="设置密码"]').eq(1).val();
        var pass2    = $('input[placeholder="确认密码"]').eq(1).val();
        if(pass==pass2){
            var formDate = new FormData($('#phone_form')[0]);
            $.ajax({
                type : "POST", //用POST方 式传输
                dataType: "text", //数据格式:JSON
                url  : 'phone', //目标地址
                data : formDate,
                contentType : false,
                processData : false,
                error       : function (errorThrown) {
                    layer.alert('出错啦!'+errorThrown,{
                        title : '提示框',
                        icon  :0
                    });
                },
                success     : function (msg){
                    if(msg==1100){
                        layer.alert('注册成功!',{
                            title : '提示框',
                            icon  :1
                        });setInterval(function(){
                            window.history.back();
                        },2000);
                    }else {
                        layer.alert('失败了!'+msg,{
                            title : '提示框',
                            icon  :0
                        });
                    }
                }
            });
        }else {
            layer.alert('密码不一致!',{
                title : '提示框',
                icon  :0
            });
        }

    });
});
