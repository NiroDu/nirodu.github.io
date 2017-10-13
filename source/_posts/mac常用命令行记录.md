---
title: 常用命令行记录
date: 2017-07-21 11:31:36
layout: post
comments: true
tags: [前端]
categories: [前端]
keywords: 前端
description:
summary: 
---

OSX上的一些常用命令。

<!-- more -->
### Mac端
#### 将系统隐藏文件显示出来：
```bash
$ defaults write com.apple.Finder AppleShowAllFiles YES 
$ killall Finder
```

#### 在Finder顶部看见完整的路径地址
```bash
$ defaults write com.apple.finder _FXShowPosixPathInTitle -bool YES
```
『复制路径可以用 Option+Command+C』 在终端中 Command+V 粘贴即可。

### Sass
#### 单个sass文件编译
```
$ sass style.scss style.css
```