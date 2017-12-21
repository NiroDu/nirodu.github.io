---
title: The principle of object-oriented JavaScript
date: 2017-11-04 11:10:31
tags:
comments:
categories:
keywords:
description:
summary: 《The principle of object-oriented JavaScript》读书笔记
password: Nirooo
abstract: 
message: 
---

# 原始类型和引用类型
## 原始类型
五种原始类型：
`boolean``number``string``null``undefined`

> 原始类型的变量直接保存原始值(而不是一个指向对象的指针)。
> 即 每个含有原始值的变量使用自己的存储空间，一个变量的改变不会影响到其他变量。

`typeof` 操作符用来鉴别原始类型：

```js
console.log(typeof "this is string")
console.log(typeof 10)
console.log(typeof true)
console.log(typeof undefined)
```


`console.log(typeof null)`

## 对象（引用类型的实例）
使用对象前，必须先创建它们。
