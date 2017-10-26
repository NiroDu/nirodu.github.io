---
title: Chrome调试技巧
date: 2017-04-22 09:38:00
layout: post
comments: true
tags: [chrome]
categories: [前端]
keywords:
description:
summary: 
---

记录一些比较实用的点。
<!-- more -->

- 在Source选项，`Cmd + o` 可以搜索文件，`Cmd + Shift + o` 
搜索文件中的对应函数/特定选择器的一个选择框。

- 要打开抽屉式控制台，你需要在键盘上按下 Esc 键或者点击开发者工具窗口右上角的 Show Drawer 按钮。（大屏幕适用）

- 直接在网页上编辑元素，console输入：`document.body.contentEditable = "true"`

- 全局搜索：`Alt+Command+F`

- 快速打开上一个被关闭的选项卡: `Command+Shift+T`

- 进入谷歌浏览器密码保存页面: `chrome://settings/passwords`

- 不同的console颜色输出:
console.log：普通信息
console.info：提示类信息
console.error：错误信息
console.warn：警示信息

## JS调试部分

<img src="/img/chromeTips/1.gif" alt="">
从左到右，各个图标表示的功能分别为：

- Pause/Resume script execution：暂停/恢复脚本执行（程序执行到下一断点停止）。
- Step over next function call：执行到下一步的函数调用（跳到下一行）。
- Step into next function call：进入当前函数。
- Step out of current function：跳出当前执行函数。
- Deactive/Active all breakpoints：关闭/开启所有断点（不会取消）。
- Pause on exceptions：异常情况自动断点设置。

<img src="/img/chromeTips/2.gif" alt="">

## 快捷键
`⌘+⌥+j`，唤出浏览器控制台。