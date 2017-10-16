---
title: 张鑫旭CSS学习笔记摘录
date: 2017-07-23 23:00:00
layout: post
comments: true
tags: [css]
categories: [前端]
keywords: 
description:
summary: 
---

对张鑫旭文章的一些读书笔记。

<!-- more -->

- 浮动直接将元素的inline boxes破坏了，于是这些元素没有了高度。无inline box -> 无line box -> 无高度

- **绝对定位的元素脱离了文档流，而浮动元素依旧在文档流中。**这造成的显示上的差异就是：同处于文档流中的文字实体不会与浮动元素重叠，而会与绝对定位元素重叠。

- 浮动的本职工作是让匿名inline boxes性质的文字环绕图片显示，而其他所有用浮动实现的效果都不是浮动应该做的事情。

- 高度都是有两个CSS模型产生的，一个是box盒状模型，对应CSS为”height+padding+margin”，另外一个是line box模型，对应样式为”line-height”。

- display:inline-block将对象呈递为内联对象，但是对象的内容作为块对象呈递。所谓对象呈递为内敛对象就是元素呈递为inline box。

- 清除浮动其实就一个目的，就是解决高度塌陷的问题。塌陷原因是：元素含有浮动属性 – 破坏inline box – 破坏line box高度 – 没有高度 – 塌陷。

- 清除浮动最投机取巧的方法：<div style="clear:both;"></div>放到当作最后一个子标签放到父标签那儿。

[CSS float浮动的深入研究、详解及拓展(一) «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2010/01/css-float%E6%B5%AE%E5%8A%A8%E7%9A%84%E6%B7%B1%E5%85%A5%E7%A0%94%E7%A9%B6%E3%80%81%E8%AF%A6%E8%A7%A3%E5%8F%8A%E6%8B%93%E5%B1%95%E4%B8%80/)
[CSS float浮动的深入研究、详解及拓展(二) «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2010/01/css-float%E6%B5%AE%E5%8A%A8%E7%9A%84%E6%B7%B1%E5%85%A5%E7%A0%94%E7%A9%B6%E3%80%81%E8%AF%A6%E8%A7%A3%E5%8F%8A%E6%8B%93%E5%B1%95%E4%BA%8C/)
---

**position: static 和 position: relative 区别：**
static: 没有定位，元素出现在正常的流中（使用 top, bottom, left, right , z-index 无效）。
relative: 生成相对定位的元素，相对于其正常位置进行定位。(可使用 top, bottom, left, right , z-index )

---

**height:100%和height:inherit的异同：**
height:100% IE6+ 
height:inherit IE8+ 
[height:100%和height:inherit的异同DEMO](http://www.zhangxinxu.com/study/201502/height-100-height-inherit.html)
当子元素为绝对定位元素，同时，父容器的position值为static的时候，height:100%和height:inherit的差异才明显体现出来。

---

Media Queries可以针对不同设备的一些Media属性设定不同的CSS属性或者是不同的CSS文件调用。例如：
```html
<link rel="stylesheet" type="text/css" href="widthScreen.css" media="screen and (min-width: 1024px)" />
```

---

[image:6F0D7E3F-A08A-4253-BA5C-D782B2A55368-53149-000175CB0D30589B/box-area.png]

```css
.box1 { box-sizing: content-box; } /* 默认值 */
.box2 { box-sizing: padding-box; } /* FireFox曾经支持 */
.box3 { box-sizing: border-box; }  /* 全线支持 */
.box4 { box-sizing: margin-box; }  /* 从未支持过 */
```

[聊聊CSS世界中的margin-box «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2016/09/talking-about-css-margin-box/)
---

- absolute定位与margin定位其实是没有什么冲突的，无论absolute元素时候设置了left/top值，其margin属性值都是可以起作用的。

- **position为absolute的元素如果没有设置left, top等值与left:0;top:0;的的效果为何不一样？**
例如一个div中有个absolute属性元素，其没有left或是top值，其会像个普通的  Q	213342-block属性元素一样静静地呆在这个div里面，但是一旦设置了left:0;top:0;对不起，这个absolute元素立马变身，直接从DOM tree里面脱离，独立于文档流，结果相对于最近的relative属性的祖先标签定位（如果没有，就body定位）

---

去除inline-block元素间间距(推荐)：

```css
.父元素 {
    font-size: 0;
    -webkit-text-size-adjust:none; //慎用
}
.父元素 子元素 {
    font-size: 12px;
}
```

 `-webkit-text-size-adjust:none;` ： 禁用Webkit内核浏览器的文字大小调整功能。针对解决chrome最小字体12px限制。

---

**margin:auto实现绝对定位元素的居中**

```css
.element {
    width: 600px; height: 400px;
    position: absolute; left: 0; top: 0; right: 0; bottom: 0;
    margin: auto;    /* 有了这个就自动居中了 */
}
```

代码两个关键点：
**上下左右均0位置定位；**
**margin: auto**

原理：

当一个绝对定位元素，其对立定位方向属性同时有具体定位数值的时候，流体特性就发生了，例如：
```css
<div class="box"></div>
.box {
  position: absolute;
  left: 0; right: 0;
}
```

**如果只有left属性或者只有right属性，则由于包裹性此时.box宽度是0。但是，在本例中，因为left/right同时存在，因此宽度就不是0，而是自适应于.box包含块的padding box宽度，也就是随着包含块padding box的宽度变化，.box的宽度也会跟着一起变。**

具有流体特性绝对定位元素的margin:auto的填充规则和普通流体元素一模一样：
**如果一侧定值，一侧auto，auto为剩余空间大小；**
**如果两侧均是auto, 则平分剩余空间；**

例如，下面的CSS代码：
```css
.father {
    width: 300px; height:150px;
    position: relative;
}
.son { 
    position: absolute; 
    top: 0; right: 0; bottom: 0; left: 0;
}
```
此时，**.son这个元素的尺寸表现为“格式化宽度和格式化高度”**，和<div>的“正常流宽度”一样，同属于外部尺寸，也就是尺寸自动填充父级元素的可用尺寸的，然后，此时我们给.son设置尺寸，例如：
```css
.son { 
    position: absolute; 
    top: 0; right: 0; bottom: 0; left: 0;
    width: 200px; height: 100px;
}
```
此时宽高被限制，原本应该填充的空间就被多余了出来，这多余的空间就是margin:auto计算的空间，因此，如果这时候，我们再设置一个margin:auto，那么：
```css
.son { 
    position: absolute; 
    top: 0; right: 0; bottom: 0; left: 0;
    width: 200px; height: 100px;
    margin: auto;
}
```
我们这个.son元素就水平和垂直方向同时居中了。因为，auto正好把上下左右剩余空间全部等分了，自然就居中啦！

[小tip: margin:auto实现绝对定位元素的水平垂直居中 «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2013/11/margin-auto-absolute-%E7%BB%9D%E5%AF%B9%E5%AE%9A%E4%BD%8D-%E6%B0%B4%E5%B9%B3%E5%9E%82%E7%9B%B4%E5%B1%85%E4%B8%AD/)
---

- 有float:left/position:absolute撑腰的情况下，display属性就是多余的，可以直接回家喝茶了。


常见absolute布局的替代实现方案:

**使用margin实现扩展性容错性更强的布局**
首先HTML部分需要添加一层block水平的标签（其实可以不用加，只要让img外面的a标签block水平显示即可），**让标价与图片不会在一个line box中显示**，同时将标价外面的div标签改为inline水平元素的标签方便inline-block化 。

```css
.father {
    margin: -28px 0 0 74px;
}
.son {
    display: inline-block;
    ......
}
``` 

[margin代替absolute布局](http://www.zhangxinxu.com/study/201012/position-absolute-replace-method-2.html##)


absolute属性相关的隐藏方法，我知道的有三种，分别如下：
```css
.hidden{
    position:absolute;
    top:-9999em;
}
.hidden{
    position:absolute;
    visibility:hidden;
}
.hidden{
    position:absolute;
    clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px, 1px, 1px, 1px);
}
```


- 在默认情况下，元素应用了非static的position属性后，其就会有一个隐晦的层级，会居于普通元素之上，无需额外设置z-index属性值。


### **z-index的1, 2, 3规则**
有时候，面对复杂的交互，我们还是需要z-index值的，此时，如何避免z-index层级的混乱呢？

我是如何处理的：

1. 归门别类。将z-index分为两派，分为“地面派”和“天空派”。“天空派”就是指遮罩弹框，类似boxy这种，或是其他一些交互组件等；其余的就算是“地面派”了。

2. 应用1, 2 ,3规则。地面派元素的z-index没有，或为1，或是2，或是3。根据我的经验，“地面派元素”，很少需要使用z-index为2，至于z-index:3我记忆中还没有碰到过，因为一个页面交互再怎么复杂，也不可能正好是前面一个元素比后面元素层级高，而且有3~4个元素。也就是说，对于“地面”元素，我们只要使用[null, 1, 2, 3]之间的层级就能应付所有的情况。于是乎，我们想要出线层级混乱的情况都比较难了。

都是聪明人，都懂的，就不啰嗦了。

[CSS 相对|绝对(relative/absolute)定位系列（一） «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2010/12/css-%E7%9B%B8%E5%AF%B9%E7%BB%9D%E5%AF%B9%E5%AE%9A%E4%BD%8D%E7%B3%BB%E5%88%97%EF%BC%88%E4%B8%80%EF%BC%89/)
[CSS 相对/绝对(relative/absolute)定位系列（二） «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2010/12/css-%E7%9B%B8%E5%AF%B9%E7%BB%9D%E5%AF%B9relativeabsolute%E5%AE%9A%E4%BD%8D%E7%B3%BB%E5%88%97%EF%BC%88%E4%BA%8C%EF%BC%89/)
[CSS 相对/绝对(relative/absolute)定位系列（三） «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2011/03/css-%E7%9B%B8%E5%AF%B9%E7%BB%9D%E5%AF%B9relativeabsolute%E5%AE%9A%E4%BD%8D%E7%B3%BB%E5%88%97%EF%BC%88%E4%B8%89%EF%BC%89/)
[CSS 相对/绝对(relative/absolute)定位系列（四） «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2011/08/css%E7%9B%B8%E5%AF%B9%E5%AE%9A%E4%BD%8Drelative%E7%BB%9D%E5%AF%B9%E5%AE%9A%E4%BD%8Dabsolute%E7%B3%BB%E5%88%97%EF%BC%88%E5%9B%9B%EF%BC%89/)
[CSS相对定位|绝对定位(五)之z-index篇 «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2011/08/css%E7%9B%B8%E5%AF%B9%E5%AE%9A%E4%BD%8D%E7%BB%9D%E5%AF%B9%E5%AE%9A%E4%BD%8D%E4%BA%94%E4%B9%8Bz-index%E7%AF%87/)

---

一、什么是视区相对单位？
就是相对于浏览器viewport尺寸的单位，具体包括下面4个：

vw – 视区宽度百分值
vh – 视区高度百分值
vmin – vw或vh，取小的那个
vmax – vw或vh，取大的那个

经过大型项目实践，下面这段CSS是最好的基于rem和vm和calc实践代码：
```css
html {
    font-size: 16px;
}

@media screen and (min-width: 375px) {
    html {
        /* iPhone6的375px尺寸作为16px基准，414px正好18px大小, 600 20px */
        font-size: calc(100% + 2 * (100vw - 375px) / 39);
        font-size: calc(16px + 2 * (100vw - 375px) / 39);
    }
}
@media screen and (min-width: 414px) {
    html {
        /* 414px-1000px每100像素宽字体增加1px(18px-22px) */
        font-size: calc(112.5% + 4 * (100vw - 414px) / 586);
        font-size: calc(18px + 4 * (100vw - 414px) / 586);
    }
}
@media screen and (min-width: 600px) {
    html {
        /* 600px-1000px每100像素宽字体增加1px(20px-24px) */
        font-size: calc(125% + 4 * (100vw - 600px) / 400);
        font-size: calc(20px + 4 * (100vw - 600px) / 400);
    }
}
@media screen and (min-width: 1000px) {
    html {
        /* 1000px往后是每100像素0.5px增加 */
        font-size: calc(137.5% + 6 * (100vw - 1000px) / 1000);
        font-size: calc(22px + 6 * (100vw - 1000px) / 1000);
    }
}
```

然后，就可以愉快地使用rem单位用来排版和布局啦！


[基于vw等viewport视区单位配合rem响应式排版和布局 «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2016/08/vw-viewport-responsive-layout-typography/)
---

[深入理解CSS中的层叠上下文和层叠顺序 «  张鑫旭-鑫空间-鑫生活](http://www.zhangxinxu.com/wordpress/2016/01/understand-css-stacking-context-order-z-index/)