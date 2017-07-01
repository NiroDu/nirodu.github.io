---
title: CSS-position定位详解
date: 2017-03-26 15:49:25
tags:
desc:
---

彻底解决position疑惑。

<!-- more -->

- #### absolute
生成绝对定位的元素，<u>相对于 static 定位以外的第一个父元素进行定位</u>。
- #### fixed 
生成绝对定位的元素，<u>相对于浏览器窗口进行定位</u>。
- #### relative 
生成相对定位的元素，<u>相对于其正常位置进行定位</u>。
- #### static 
默认值。<u>没有定位，元素出现在正常的流中</u>（忽略 top, bottom, left, right 或者 z-index 声明）。 
- #### inherit 
规定应该从父元素继承 position 属性的值。


## 文档流布局的概念：
> 将窗体自上而下分成一行行， 并在每行中按从左至右的顺序排放元素，即为 **文档流**。 
每个非浮动块级元素都独占一行， 浮动元素则按规定浮在行的一端。若当前行容不下， 则另起新行再浮动。
内联元素不会独占一行。
几乎所有元素(包括块级，内联和列表元素）均可生成子行， 用于摆放子元素。  
有三种情况将使得元素脱离文档流而存在，分别是 `浮动(float)`，`绝对定位(absolute)`， `固定定位(fixed)`。 
但是在IE6中浮动元素也存在于文档流中。
position 元素的位置通过 “left”, “top”, “right” 以及 “bottom” 属性进行规定。 
参数主要有以下：

## static 文档流
这是正常的文档流布局。每行中按从左至右的顺序排放元素，到头了另起一行，接着排布。
![](/img/cssPosition/position-static.jpg)

## relative 文档流
相对自己文档流中的原始位置定位。它的特点是——不会脱离文档流。
使用 `position:relative` 定位，其元素依旧在文档流中，他的位置可以使用 left、right、top、bottom、z-index等定位参数，但是它的存在，还是会影响文档中紧跟在它周围的元素。

```CSS
position: relative;
left: -20px;
top: 20px;
```
![](/img/cssPosition/position-relative.jpg)

它的位移并没有对周围的元素有任何的影响！！它依然存在于文档流中。它的位移是根据它在文档流中的原始位置发生的！！这一点非常非常重要。


## fixed 文档流
这个参数是最好理解的。它相对于浏览器的窗口进行定位。同时——它会脱离文档流。

```css
position: fixed;
right:20px;
top: 20px;
```
![](/img/cssPosition/position-fixed1.jpg)

1. 它脱离了文档流，原来文档流中不存在它的位置，test4好像test3不存在一样的紧贴在了test2的后面。 
2. 它的 `right:20px;top: 20px;` 参数是相对浏览器窗口定位的。

我们再来看一下，当页面发生滚动的效果图。
![](/img/cssPosition/position-fixed2.jpg)
当页面发生了滚动，我们可以看到，页面的内容已经根据滚动条的位置发生了位移。但是我们的test3 依旧是在相对于浏览器的位置。

## absolute 文档流

**“生成绝对定位的元素，相对于 static 定位以外的第一个父元素进行定位。”**——脱离文档流。

也就是说，它可以相对于各种各样的东西进行定位。除了 static 其他都可以！！！

第一种情况，它的所有父元素的属性都是 `position:static`
第二种情况，它的父元素的属性是 `position:relative`
第三种情况，它的父元素的属性是 `position:fixed`
第四种情况，它的父元素的属性是 `position:absolute`

```html
    <div class="test1">
        test1
        <div class="test2">
            test2
            <div class="test3">test3</div>
        </div>
    </div>
```

**一、这个元素的所有上级元素，你都没有使用过定位方式。它会相对于文档定位。**
> ```css
        .test1 {width: 500px;height: 500px;background: #123;}
        .test2 {width: 400px;height: 400px;background: #234;}
        .test3 {width: 300px;height: 300px;background: #345;position: absolute;right: 20px;top: 20px;}
```

> ![](/img/cssPosition/position-absolute1.jpg)
看一下浏览器发生滚动之后的效果：

> ![](/img/cssPosition/position-absolute2.jpg)

**二、父元素是 `position:relative`**

> ```css
        .test1 {width: 500px;height: 500px;background: #123;}
        .test2 {width: 400px;height: 400px;background: #234;position: relative;left: 50px;top: 50px;}
        .test3 {width: 300px;height: 300px;background: #345;position: absolute;right: -20px;top: -20px;}
```
> 
![](/img/cssPosition/position-absolute3.jpg)
**test2如我们所愿的，相对于自身的位置发生了偏移，而test3则相对于test2发生了偏移。**
当一个元素设置了position:absolute属性之后，而它的父元素的属性为position:relative，则它不再是相对于文档定位，而是相对于父元素定位。

**三、父元素是 `position:fixed`**
> 同上，父元素相对浏览器定位，子元素相对父元素绝对定位。

**四、父元素是 `position:absolute`**
> 假如父元素的父元素是static，父元素相对于文档定位，子元素相对父元素绝对定位。

>**总结：**
若它的父级元素和爷爷级元素都是position:static 属性，它会相对于文档定位。
若它的父级元素和爷爷级元素都是非position:static属性，它会选择距离最近的父元素绝对定位。


#### 参考资料
- http://blog.csdn.net/fungleo/article/details/50056111