---
title: CSS - 浮动和清除浮动
date: 2017-03-26 17:30:26
layout: post
comments: true
tags: [css]
categories: [前端]
keywords:
description:
summary: 
---

彻底解决浮动相关的疑惑。

<!-- more -->

[先入为主式先阅读：张鑫旭的一篇关于浮动的文章](http://www.zhangxinxu.com/wordpress/2010/01/css-float%E6%B5%AE%E5%8A%A8%E7%9A%84%E6%B7%B1%E5%85%A5%E7%A0%94%E7%A9%B6%E3%80%81%E8%AF%A6%E8%A7%A3%E5%8F%8A%E6%8B%93%E5%B1%95%E4%B8%80/)

# 浮动的基本理解
## 浮动定义
> 浮动可以理解为让某个div元素脱离标准流，漂浮在标准流之上，和标准流不是一个层次。

div是块级元素，在页面中独占一行，自上而下排列。
![](/img/cssFloat/float-1.png)
即使div1的宽度很小，页面中一行可以容下div1和div2，div2也不会排在div1后边，因为div元素是独占一行的。

下面我们把div2和div3都加上左浮动
![](/img/cssFloat/float-2.png)
由于div2、div3浮动，它们不再属于标准流，因此div4会自动上移，与div1组成一个“新”标准流，而浮动是漂浮在标准流之上，因此div2又挡住了div4。

> **重点结论：假如某个div元素A是浮动的，如果A元素上一个元素也是浮动的，那么A元素会跟随在上一个元素的后边(如果一行放不下这两个元素，那么A元素会被挤到下一行)；
如果A元素上一个元素是标准流中的元素，那么A的相对垂直位置不会改变，也就是说A的顶部总是和上一个元素的底部对齐。**

上个例子就是，div2在例子中是浮动的，但并没有跟随到div1之后。

再举个例子，我们把div2、div3、div4都设置成左浮动，如下图：

![](/img/cssFloat/float-3.png)

- （先从div4开始分析，它发现上边的元素div3是浮动的，所以div4会跟随在div3之后；div3发现上边的元素div2也是浮动的，所以div3会跟随在div2之后；而div2发现上边的元素div1是标准流中的元素，因此div2的相对垂直位置不变，顶部仍然和div1元素的底部对齐。）

假如把div2、div3、div4都设置成右浮动，效果如下：
![](/img/cssFloat/float-5.png)
- 道理和左浮动基本一样，只不过需要注意一下前后对应关系。由于是右浮动，因此右边靠近页面边缘，所以右边是前，因此div2在最右边。

即靠近页面边缘的一端是前，远离页面边缘的一端是后。
![](/img/cssFloat/float-4.jpg)


# 清除浮动
## 不清除浮动会怎样
如图所示：
![](/img/cssFloat/float-8.jpg)

## 清除浮动定义
> 元素浮动之前，也就是在标准流中，是竖向排列的，而浮动之后可以理解为横向排列。
清除浮动可以理解为打破横向排列。

`clear:both`  :  不允许两边有浮动对象。

**`clear:both` 只能影响使用清除的元素本身，不能影响其他元素。**

如何理解上句话，例如有如下布局：(div1和div2都是浮动元素)

![](/img/cssFloat/float-9.png)

想让div2移动到div1下方，
如果在div1元素的CSS样式中使用了清除浮动，试图通过清除div1右边的浮动元素(clear:right;)来强迫div2下移，这是不可行的，因为这个清除浮动是在div1中调用的，它只能影响div1，不能影响div2。

所以，要想让div2下移，就得在div2的CSS样式中使用浮动。

div2的左边有浮动元素div1，因此只要在div2的CSS样式中使用 `clear:left;` 来指定div2元素左边不允许出现浮动元素，这样div2就被迫下移一行。

![](/img/cssFloat/float-10.png)

## 深度理解开始！

> 1、**清除浮动**：清除对应的单词是 clear，对应CSS中的属性是 clear：left | right | both | none；
2、**闭合浮动**：更确切的含义是使浮动元素闭合，从而减少浮动带来的影响。

我们想要达到的效果更确切地说是 `闭合浮动`，而不是单纯的清除浮动。

例如在footer上设置clear：both清除浮动并不能解决wrap高度塌陷的问题。

[【看此DEMO,打开控制台看CSS】](http://www.iyunlu.com/demo/enclosing-float-and-clearing-float/index.html)

用闭合浮动比清除浮动更加严谨。

> 清除浮动其实就一个目的，就是解决高度塌陷的问题。为什么会高度塌陷？什么时候会高度塌陷？塌陷原因是：元素含有浮动属性 – 破坏inline box – 破坏line box高度 – 没有高度 – 塌陷。什么时候会塌陷：当标签里面的元素只要样子没有实际高度时会塌陷。

### 清理浮动的五种方法，（推荐使用最后一种)：

- **清除浮动方法一：添加额外标签**

通过在浮动元素末尾添加一个空的标签例如 `<div style=”clear:both”></div>`。

优点：通俗易懂，容易掌握。
缺点：可以想象通过此方法，会添加多少无意义的空标签，有违结构与表现的分离，在后期维护中将是噩梦。

- **清除浮动方法二：使用 br标签和其自身的html属性**

`<br>` 有 clear=“all | left | right | none” 属性。

在浮动元素末尾添加 `<br clear="all" />`。

优点：比空标签方式语义稍强，代码量较少。
缺点：同样有违结构与表现的分离，不推荐使用。

- **清除浮动方法三：父元素设置 `overflow：hidden`**

通过设置父元素overflow值设置为hidden；在IE6中还需要触发 hasLayout ，例如 `zoom：1；`

优点：不存在结构和语义化问题，代码量极少
缺点：内容增多时候容易造成不会自动换行导致内容被隐藏掉，无法显示需要溢出的元素。

- **清除浮动方法四：父元素设置 `display:table`**

优点：结构语义化完全正确，代码量极少。
缺点：盒模型属性已经改变，由此造成的一系列问题，得不偿失，不推荐使用。

- **清除浮动方法五：使用 :after 伪元素**

由于IE6-7不支持:after，使用 zoom:1触发 hasLayout。

```CSS
.fix {
    zoom:1;
}
.fix:after {
    display:block; 
    content:'clear'; 
    clear:both; 
    line-height:0; 
    visibility:hidden;
}
```

content里面的内容貌似随便写什么东西都没有问题，line-height:0 写成 height:0 也是可以的。

# 参考资料
- [CSS浮动(float,clear)通俗讲解](http://www.cnblogs.com/iyangyuan/archive/2013/03/27/2983813.html)
- [那些年我们一起清除过的浮动](http://www.iyunlu.com/view/css-xhtml/55.html)