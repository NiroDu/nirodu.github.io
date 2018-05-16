---
title: defer/async 和 DOMContentLoaded/load小记
date: 2017-11-03 14:55:47
tags:
comments:
categories:
keywords:
description:
summary: 记录一下关于Script脚本异步加载相关的问题。
---

## defer和async的区别

![1](/img/deferAsync/1.jpg)
*蓝色线代表网络读取，红色线代表执行时间，这俩都是针对脚本的；绿色线代表 HTML 解析。*

`<script src="script.js"></script>`
没有 defer 或 async，浏览器会立即加载并执行指定的脚本，“立即”指的是在渲染该 script 标签之下的文档元素之前，也就是说不等待后续载入的文档元素，读到就加载并执行。

`<script async src="script.js"></script>`
有 async，加载和渲染后续文档元素的过程将和 script.js 的加载与执行并行进行（异步）。

`<script defer src="myscript.js"></script>`
有 defer，加载后续文档元素的过程将和 script.js 的加载并行进行（异步），但是 script.js 的执行要在所有元素解析完成之后，DOMContentLoaded 事件触发之前完成。


## 事件DOMContentLoaded和load的区别

**DOM文档加载的步骤为:**
1.解析HTML结构。
2.加载外部脚本和样式表文件。
3.解析并执行脚本代码。
4.DOM树构建完成。//DOMContentLoaded
5.加载图片等外部文件。
6.页面加载完毕。//load

在第4步，会触发DOMContentLoaded事件。在第6步，触发load事件。

> 当初始HTML文档被完全加载和解析完成之后，DOMContentLoaded 事件被触发，而无需等待样式表、图像和子框架完成加载。另一个不同的事件 load 应该仅用于检测一个完全加载的页面。 在使用 DOMContentLoaded 更加合适的情况下使用 load 是一个非常流行的错误，所以要谨慎。  ——MDN

用原生js可以这么写：
```js
// 不兼容老的浏览器，兼容写法见 [jQuery中ready与load事件](http://www.imooc.com/code/3253) ，或用jQuery

document.addEventListener("DOMContentLoaded", function(event) {
    console.log("DOM fully loaded and parsed");
});
```
```js
window.addEventListener("load", function(event) {
    console.log("All resources finished loading!");
});
```
JQ这么写：
```js
// DOMContentLoaded
$(document).ready(function() {
    // ...代码...
});
```

```js
//load
$(document).load(function() {
    // ...代码...
});
```

## 参考资料
- [script的defer和async – 携程设计委员会](http://ued.ctrip.com/blog/script-defer-and-async.html#)
- [defer和async的区别](https://segmentfault.com/q/1010000000640869)
