---
title: jquery插件模式学习
layout: post
date: 2017-08-23 16:47:22
tags: [Jquery]
categories: [前端]
keywords: 
description:
summary: 
---

（学习编写Jquery插件 = =

<!-- more -->

## 自执行匿名函数：

常见格式：
```JS
(function() { /* code */ })();
```
**解释**：包围函数 `（function(){})` 的第一对括号向脚本返回未命名的函数，随后一对空括号立即执行返回的未命名函数，括号内为匿名函数的参数。

**作用**：
- 解释一、 可以用它创建命名空间，只要把自己所有的代码都写在这个特殊的函数包装内，那么外部就不能访问，除非你允许(变量前加上window，这样该函数或变量就成为全局)。
- 解释二、 用(function(){xxx})()是利用匿名函数和闭包用来执行xxx里面的代码，同时所有的定义比如变量的作用域都在闭包里，不会污染到外部命名空间。


其他写法：
```JS
(function () { /* code */ } ()); 
!function () { /* code */ } ();
~function () { /* code */ } ();
-function () { /* code */ } ();
+function () { /* code */ } ();
```

```JS
// 这么写会报错，因为这是一个函数定义：
function() {}()

// 常见的（多了一对括号），调用匿名函数：
(function() {})()

// 但在前面加上一个布尔运算符（只多了一个感叹号），就是表达式了，将执行后面的代码，也就合法实现调用
!function() {}()
```


## 参考资料
- [How to write jQuery plugin?](https://github.com/i5ting/How-to-write-jQuery-plugin)