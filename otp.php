<?php
const OTP_PWD = 'bjzhush';
//检查是否为特定表单提交
//此两处if需要收敛到最小且能满足功能，如不够收敛则可能干扰别的功能
if (!empty($_POST) && isset($_POST['otp'])) {
    $postOtp = $_POST['otp'];
    $serverOtp = file_get_contents('http://otp.shuaizhu.com/');
    if ($postOtp == $serverOtp) {
        setcookie('otp', OTP_PWD, time()+24*3600*365);
        header('location: /');
    } else  {
        exit('bad Otp');
    }
}
//检查是否有otp且值为bjzhush,没有则展示auth表单
if (!isset($_COOKIE['otp']) || $_COOKIE['otp'] !== OTP_PWD) {
    include('otp.html');
    exit;
} 
