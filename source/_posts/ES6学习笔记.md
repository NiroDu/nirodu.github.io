---
title: ES6学习笔记
date: 2017-08-30 19:27:57
layout: post
tags: [ES6,Javascript]
categories: [前端]
keywords: [ES6]
description:
---

关于ES6的常用语法参考。

<!-- more -->

[Babel官网](https://babeljs.io/)
Babel是一个广泛使用的ES6转码器，可以将ES6代码转为ES5代码，从而在现有环境执行。
## let, const
`let`命令，用来声明变量。它的用法类似于`var`，但是所声明的变量，只在`let`命令所在的代码块内有效。

`const`声明一个只读的常量。一旦声明，常量的值就不能改变。

```js
var name = 'zach'

while (true) {
    var name = 'obama'
    console.log(name)  //obama
    break
}

console.log(name)  //obama
```


## class, extends, super
## arrow function
## template string
## destructuring
## default, rest

## 参考资料
- [30分钟掌握ES6/ES2015核心内容](https://segmentfault.com/a/1190000004365693#articleHeader5)
- [ECMAScript 6 入门](https://es6.ruanyifeng.com/)
