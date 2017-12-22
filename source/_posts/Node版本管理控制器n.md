---
title: Node版本管理控制器n
date: 2017-10-24 15:41:59
tags:
comments:
categories:
keywords:
description:
summary: 可以通过n来管理Node不同的版本。
password: Nirooo
abstract: 
message: 
---

简介：

Node 可以通过n来管理不同的版本。类似Python中的pyenv进行python多版本管理。

安装 n:
```bash
$ npm install -g n
```

查看帮助：
```bash
$ n --help
```
 
查看可用的Node版本
```bash
$ n ls
```

查看已安装的版本
```bash
$ n
```

安装最新的版本
```bash
$ n latest
```

安装稳定版本
```bash
$ n stable
```

删除某个版本
```bash
$ n rm 0.10.1
```

以指定的版本来执行脚本
```bash
$ n use 0.10.21 **.js
```