<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx588493814e7e9a12", "2bbbf16c0adc7f8c67236a5b549e37f5");
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <!-- 避免转码 -->
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <!-- <link rel="shortcut icon" type="image/ico" href="/favicon.ico"/> -->
        <!-- 禁止缓存 -->
        <!-- <meta http-equiv="Pragma" content="no-cache"> -->
        <!-- viewport：能优化移动浏览器的显示。如果不是响应式网站，不要使用initial-scale或者禁用缩放。
        大部分4.7-5寸设备的viewport宽设为360px；5.5寸设备设为400px；iphone6设为375px；ipone6 plus设为414px。-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no,minimal-ui"/>
        <!-- `width=device-width` 会导致 iPhone 5 添加到主屏后以 WebApp 全屏模式打开页面时出现黑边  -->
        <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- 启用 WebApp 全屏模式 -->
        <!-- 忽略数字自动识别为电话号码 -->
        <!-- <meta content="telephone=no" name="format-detection" />  -->
        <!-- 忽略识别邮箱 -->
        <!-- <meta content="email=no" name="format-detection" /> -->
        <!-- 添加智能 App 广告条 Smart App Banner：告诉浏览器这个网站对应的app -->
        <!-- <meta name="apple-itunes-app" content="app-id=myAppStoreID, affiliate-data=myAffiliateData, app-argument=myURL">  -->
        <!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
        <meta name="HandheldFriendly" content="true">
        <!-- windows phone 点击无高光 -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- Windows 8 磁贴颜色 -->
        <!-- <meta name="msapplication-TileColor" content="#000"/>  -->
        <!-- Windows 8 磁贴图标 -->
        <!-- <meta name="msapplication-TileImage" content="icon.png"/>  -->
        
        <link rel="stylesheet" href="css/main.css">

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?962f231b1d30ca5afcce72b4c2e2e9a1";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>


        
    </head>
    <body>
   	<div id="Label">
   		<div class="page1" >
   			<input class="input_text" type="text" placeholder="请输入你的姓名">
   			<div class="input_upload">开始测试</div>
   		</div>
   		<div class="page2_labe"style="display: none">
   		<div class="page2">
   			<p class="label1">互联网房产中介头目</p>
   			<p class="label2">女神都喜欢的那个范</p>
   			<p class="label3">爬楼高手</p>
   			<p class="label4">师奶杀手</p>
   			<p class="label5">秒成交</p>
<!--    			<p class="label6">神业绩</p>
 -->   			<p class="label7">电动车神车手</p>
   			<p class="label8">销冠</p>
<!--    			<p class="label9">话术终结者</p>
 -->   		</div>
   			
   			<div class="input_index">我也要测</div>
   			<div class="input_share">分享给大家</div>
			<a class="appdown" href="http://dwz.cn/Ty52H"></a>
   		</div>
		<div class='mc'></div>
   	</div>
        <script src="js/lib/zepto.min.js"></script>
        <script src="js/lib/touch.js"></script>
        <!-- // <script src="js/lib/jquery.min.js"></script> -->
        <script src="js/main.js"></script>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
$('.input_upload').on('tap', function() {
    var val = $('.input_text').val().length;
    if (val > 0) {
	var exname = $('.input_text').val();
	  window.shareData = {
  "imgUrl": "http://wx.qfang.com/Label/images/share1.png",
  "timeLineLink": "http://wx.qfang.com/Label/index.php?id=1"+"&name="+encodeURI(encodeURI(exname)),
  "tTitle":  decodeURI(exname)+"从事房产的关键词",
  "tContent": ""
};
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      'onMenuShareTimeline',
        'onMenuShareAppMessage'
    ]
  });
  wx.ready(function () {
    wx.onMenuShareAppMessage({
      title: window.shareData.tTitle,
      desc: window.shareData.tContent,
      link: window.shareData.timeLineLink,
      imgUrl: window.shareData.imgUrl,
     success: function () { 
    },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });

wx.onMenuShareTimeline({
    title:window.shareData.tTitle, // 分享标题
    link: window.shareData.timeLineLink, // 分享链接
    imgUrl:window.shareData.imgUrl, // 分享图标
    //desc: window.shareData.tContent,
    success: function () { 
    },
    cancel: function () { 
        // 用户取消分享后执行的回调函数
    }
});
  });
        $('.page1').css('display', 'none');
        $('.page2_labe').css('display', 'block');
    } else {
        alert("请输入名字")
    }

})

function getUrl(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return "Please input keywords here";
}
var name=getUrl("name")
console.log(decodeURI(name))
  window.shareData = {
  "imgUrl": "http://wx.qfang.com/Label/images/share1.png",
  "timeLineLink": "http://wx.qfang.com/Label/index.php?id=1"+"&name="+encodeURI(encodeURI(name)),
  "tTitle": decodeURI(name)+"从事房产的关键词",
  "tContent": ""
};
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      'onMenuShareTimeline',
        'onMenuShareAppMessage'
    ]
  });
  wx.ready(function () {
    wx.onMenuShareAppMessage({
      title: window.shareData.tTitle,
      desc: window.shareData.tContent,
      link: window.shareData.timeLineLink,
      imgUrl: window.shareData.imgUrl,
     success: function () { 
      window.location.href="http://m.qfang.com/shanghai/broker/register"; 
    },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });

wx.onMenuShareTimeline({
    title:window.shareData.tTitle, // 分享标题
    link: window.shareData.timeLineLink, // 分享链接
    imgUrl:window.shareData.imgUrl, // 分享图标
    //desc: window.shareData.tContent,
    success: function () { 
      window.location.href="http://m.qfang.com/shanghai/broker/register"; 
    },
    cancel: function () { 
        // 用户取消分享后执行的回调函数
    }
});
  });
</script>
<div style="display:none">
	<script language="javascript" type="text/javascript" src="http://js.users.51.la/18693476.js"></script>
</div>
    </body>
</html>
