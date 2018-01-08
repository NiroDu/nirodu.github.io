---
title: JS - 代码封装集
layout: post
date: 2017-07-20 22:13:56
comments: true
tags: [js]
categories: [前端]
keywords: 
description:
summary: 一些常用的JS片段。
---

(正在整理中..

<!-- more -->
#### 微信JS-SDK调用方式

[在线微信JS-SDK Demo](http://203.195.235.76/jssdk/)

[备用地址：在线微信JS-SDK Demo](http://demo.open.weixin.qq.com/jssdk/)

#### jquery如何判断滚动条滚到页面底部并执行事件


首先理解三个dom元素，分别是：`clientHeight`、`offsetHeight`、`scrollTop`。

**举例，如果一个DIV高度是400px（即clientHeight为400），而里面的内容是一个很长的列表，内容的高度是1000px（即offsetHeight为1000）。那么，可见部分我们看到400px，1000px的内容中还有600px不可见。而这不可见的部分呢，正是我们通过拉动滚动条才能把这一部分显示出来。你如果滚动条不拉动，此时scrollTop为0，如果你把滚动条拉到底，显示出列表最下面的部分，此时，scrollTop为600。**
**所以scrollTop的取值区间为[0, 600]。　所以这个600可以理解为滚动条可以滚动的长度。**

首先，我们拉动滚动条，从最上面拉到最下面，变化的是scrollTop的值，而这个值是有一个区间的。

这个区间是：**[0, (offsetHeight - clientHeight)]**

即，滚动条拉动的整个过程的变化在 0 到 (offsetHeight – clientHeight) 范围之内。

1、判断滚动条滚动到最底端：scrollTop == (offsetHeight – clientHeight)

2、在滚动条距离底端50px以内：(offsetHeight – clientHeight) – scrollTop <= 50

3、在滚动条距离底端5%以内：scrollTop / (offsetHeight – clientHeight) >= 0.95

```js
scrollBottomTest =function(){  
     $("#contain").scroll(function(){  
         var $this =$(this),  
         viewH = $(this).height(),//可见高度  
         contentH = $(this).get(0).scrollHeight,//内容高度  
         scrollTop = $(this).scrollTop();//滚动高度  
        //if(contentH - viewH - scrollTop <= 100) { //到达底部100px时,加载新内容  
        if(scrollTop/(contentH -viewH)>=0.95){ //到达底部5%以内,加载新内容  
        // 这里加载数据..  
        }  
     });  
}  
```
[附DEMO-导航火箭](/demo/rocket/index.html)


#### js结合rem控制字体随着分辨率变化而变化
```js
        function fontSize() {
            var deviceWidth = $(document).width();
            if (deviceWidth > 640) {
                deviceWidth = 640;
            }

            var fontSize = deviceWidth / 6.4;
            $("html").css("fontSize", fontSize);
        }

        fontSize();

        $(window).resize(function() {
            fontSize();
        });
```
[demo](http://www.qietu.com/html/f2/ntv2rem/)

```js
$(function(){
	$(window).resize(infinite);
	function infinite() {
		var htmlWidth = $('html').width();
		if (htmlWidth >= 750) {
			$("html").css({
				"font-size" : "40px"
			});
		} else {
			$("html").css({
				"font-size" :  40 / 750 * htmlWidth + "px"
			});
		}
	}
    infinite();
});
```


```html
<video
  id="videoALL"
  src="video/01.mp4"
  poster="images/1.jpg" /*视频封面*/
  preload="auto"
  webkit-playsinline="true" /*这个属性是ios 10中设置可以
                     让视频在小窗内播放，也就是不是全屏播放*/ 
  playsinline="true"  /*IOS微信浏览器支持小窗内播放*/
  x-webkit-airplay="allow"
  x5-video-player-type="h5"  /*启用H5播放器,是wechat安卓版特性*/
  x5-video-player-fullscreen="true" /*全屏设置，
                     设置为 true 是防止横屏*/>
  x5-video-orientation="portraint" /*播放器支付的方向，
                     landscape横屏，portraint竖屏，默认值为竖屏*/
  style="object-fit:fill">
</video>
```
[HTML5实现微信播放全屏的方法详解](http://www.php.cn/html5-tutorial-362962.html)


#### 回调函数应用

```js
function main(go,callback){
    console.log(go);
    callback("hahaha");
}

function called(value){
    console.log("回调函数已经调用");
    console.log(value);
}

// 调用主方法并使用回调函数
main("goValue",called);

```


#### 多行文本溢出显示省略号(...)的方法

除了各个浏览器私有的属性，有没有跨浏览器的解决方法呢？当然是通过js实现啦！（通过从后向前逐个删除末尾字符，直至元素的高度小于父元素高度）

兼容性最好的方式：

```html
<div class="figcaption"><p>作为微软的游戏平台，Xbox已经出现在了Windows Phone和Windows 8中，就在最近，微软宣布将旗下的Zune消费品牌也一并整合至Xbox品牌下，Xbox Live服务影响力越来越大，渗透面也越来越广。</p></div>
<div class="figcaption"><p>You probably can't do it (currently?) without a fixed-width font like Courier. With a fixed-width font every letter occupies the same horizontal space, so you could probably count the letters and multiply the result with the current font size in ems or exs. Then you would just have to test how many letters fit on one line, and then break it up.</p></div>
```

```js
$(".figcaption").each(function(i){
    var divH = $(this).height();
    var $p = $("p", $(this)).eq(0);
    // $("p", $(this)) 相当于 $(this).find("p") 
    while ($p.outerHeight() > divH) {
        $p.text($p.text().replace(/(\s)*([a-zA-Z0-9]+|\W)(\.\.\.)?$/, "..."));
    };
});
```

```css
.figcaption {
    background: #EEE;
    width: 410px;
    height: 3em;
    margin: 1em;
}
.figcaption p {
    margin: 0;
    line-height: 1.5em;
}
```

#### 三种阻止事件执行的方式
```js
event.preventDefault()
event.stopPropagation()
return false
```

event.preventDefault() 阻止特定事件的默认行为（只有 cancelable 设置为 true 的事件才可以使用），比如：点击 type="submit" 的 input 标签提交表单，你在 onclick 事件处理中调用 event.preventDefault() 那么点击 submit 标签就不会提交表单了。不会阻止事件冒泡。

event.stopPropagation() 立即停止事件在 DOM 层次中的传播。不会阻止默认行为。

return false 之后的所有相关的触发事件和动作都不会被执行。
阻止事件继续传播，事件冒泡和默认行为都被阻止。


#### 获取屏幕高度宽度

屏幕分辨率的高： `window.screen.height`
屏幕分辨率的宽：`window.screen.width`

网页可见区域宽：`document.body.clientWidth`
网页可见区域高：`document.body.clientHeight`


#### 封装Ajax

```js
/* 封装ajax函数
 * @param {string}opt.type http连接的方式，包括POST和GET两种方式
 * @param {string}opt.url 发送请求的url
 * @param {boolean}opt.async 是否为异步请求，true为异步的，false为同步的
 * @param {object}opt.data 发送的参数，格式为对象类型
 * @param {function}opt.success ajax发送并接收成功调用的回调函数
 */
    function ajax(opt) {
        opt = opt || {};
        opt.method = opt.method.toUpperCase() || 'POST';
        opt.url = opt.url || '';
        opt.async = opt.async || true;
        opt.data = opt.data || null;
        opt.success = opt.success || function () {};
        var xmlHttp = null;
        if (XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        }
        else {
            xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
        }var params = [];
        for (var key in opt.data){
            params.push(key + '=' + opt.data[key]);
        }
        var postData = params.join('&');
        if (opt.method.toUpperCase() === 'POST') {
            xmlHttp.open(opt.method, opt.url, opt.async);
            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=utf-8');
            xmlHttp.send(postData);
        }
        else if (opt.method.toUpperCase() === 'GET') {
            xmlHttp.open(opt.method, opt.url + '?' + postData, opt.async);
            xmlHttp.send(null);
        } 
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                opt.success(xmlHttp.responseText);
            }
        };
    }

    // 调用方式
    ajax({
        method: 'POST',
        url: 'test.php',
        data: {
            name1: 'value1',
            name2: 'value2'
        },
        success: function (response) {
        console.log(response)；
        }
    });

```