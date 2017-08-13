---
title: CSS - 代码封装集
date: 2017-07-20 22:13:46
layout: post
comments: true
tags: [前端]
categories: [前端]
keywords: 前端
description:
---

(正在整理中..

<!-- more -->


#### **一、CSS 哪些属性默认会继承, 哪些不会继承?**

1、不可继承的：display、margin、border、padding、background、height、min-height、max-height、width、min-width、max-width、overflow、position、left、right、top、bottom、z-index、float、clear、table-layout、vertical-align、page-break-after、page-bread-before和unicode-bidi。 

2、所有元素可继承：visibility和cursor。

3、内联元素可继承：letter-spacing、word-spacing、white-space、line-height、color、font、font-family、font-size、font-style、font-variant、font-weight、text-decoration、text-transform、direction。 

4、终端块状元素可继承：text-indent和text-align。 

5、列表元素可继承：list-style、list-style-type、list-style-position、list-style-image。


#### **二、不定高垂直居中(灵活的不限定子元素高度)**

1、表格方式
```css
.父 {
    display: table;
    position: relative;
    height: 100%;
    width: 100%;
}
.子 {
    display: table-cell;
    vertical-align: middle;
}
```

2、after伪元素 + vertical-align方式

```css
.父{
    position: relative;
    height: 100%;
}
.父::after {
    height: 100%;
    content: "";
    width: 0;
    display: inline-block;
    vertical-align: middle;
}
.子 {
    vertical-align: middle;
    display: inline-block;
}
```


#### 文字省略号...
{
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    display: inline-block;
    
}