---
title: JS - 代码封装集
layout: post
date: 2017-07-20 22:13:56
comments: true
tags: [前端]
categories: [前端]
keywords: 前端
description:
---

(正在整理中..

<!-- more -->

## jquery如何判断滚动条滚到页面底部并执行事件


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


## js结合rem控制字体随着分辨率变化而变化
```js
        function fontSize() {
            var deviceWidth = $(document).width();
            if (deviceWidth > 640) {
                deviceWidth = 640;
                console.log(deviceWidth);
            }

            var fontSize = deviceWidth / 6.4;
            $("html").css("fontSize", fontSize);
            console.log(fontSize)
        }

        fontSize();

        $(window).resize(function() {
            fontSize();
        });
```
**或者rem是通过css控制**
```css
html{-webkit-text-size-adjust:none; /*解决chrome浏览器下字体不能小于12px*/}

html {
	font-size:62.5%
}
@media only screen and (min-width:321px) { /*iphone5*/
    html {
    font-size:62.5%!important
    }
}
@media only screen and (min-width:361px) { /*三星note*/
    html {
    font-size:70.31%!important
    }
}
@media only screen and (min-width:376px) { /*iphone6*/
    html {
    font-size:73.24%!important
    }
}
@media only screen and (min-width:481px) {
    html {
    font-size:94%!important
    }
}
@media only screen and (min-width:561px) {
    html {
    font-size:109%!important
    }
}
@media only screen and (min-width:641px) {
    html {
    font-size:125%!important
    }
}
```
[demo](http://www.qietu.com/html/f2/ntv2rem/)


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


## 回调函数应用

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