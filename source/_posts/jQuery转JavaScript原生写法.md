---
title: jQuery转JavaScript原生写法
date: 2017-10-19 15:38:07
tags:
comments: true
categories:
keywords:
description:
summary:
---

### 选择器
```js
document.getElementById
document.getElementsByClass
document.getElementsByName
document.getElementsByTagName
document.querySelector //找到一个后就返回节点对象。
document.querySelectorAll //找出所有匹配的节点并返回数组。
```
封装一下:
```js
var $ = document.querySelectorAll.bind(document);
```
**`querySelectorAll` 所需的执行上下文必需是 document，假如不加`.bind(document)`， $ 调用后上下文会变成全局 window。**
**会报错 *Uncaught TypeError: Illegal invocation***

```bash
console.debug($('body'));
```

**需要注意的地方是，这些方法返回的要么是单个 Node 节点，要么是 NodeList 而 NodeLis 是类数组的对象，但并不是真正的数组，所以拿到之后不能直接使用 map,forEach 等方法。**
正确的操作姿势应该是：
```js
Array.prototype.map.call(document.querySelectorAll('button'),function(element,index){
    element.onclick = function(){
    }
})
```
> 参考资料： 
[Making a short alias for document.querySelectorAll](https://stackoverflow.com/questions/13383886/making-a-short-alias-for-document-queryselectorall)
[YOU MIGHT NOT NEED JQUERY](http://youmightnotneedjquery.com/)
[jQuery设计思想 阮一峰](http://www.ruanyifeng.com/blog/2011/07/jquery_fundamentals.html)
[jQuery最佳实践 阮一峰](http://www.ruanyifeng.com/blog/2011/08/jquery_best_practices.html)

