---
title: Chrome调试技巧
date: 2017-04-22 09:38:00
layout: post
comments: true
tags: [chrome]
categories: [前端]
keywords:
description:
summary: 记录一些比较实用的点。
---

记录一些比较实用的点。
<!-- more -->

## 小技巧

- 在Source选项，`Cmd + o` 可以搜索文件，`Cmd + Shift + o` 
搜索文件中的对应函数/特定选择器的一个选择框。

- 要打开抽屉式控制台，你需要在键盘上按下 Esc 键或者点击开发者工具窗口右上角的 Show Drawer 按钮。（大屏幕适用）

- 直接在网页上编辑元素，console输入：`document.body.contentEditable = "true"`

- 全局搜索：`Alt+Command+F`

- `⌘+⌥+j`，唤出浏览器控制台。
 
- 快速打开上一个被关闭的选项卡: `Command+Shift+T`

- 进入谷歌浏览器密码保存页面: `chrome://settings/passwords`

- 不同的console颜色输出:
`console.log`：普通信息
`console.info`：提示类信息
`console.error`：错误信息
`console.warn`：警示信息

- 加样式：`%c`
```bash
console.log('%chello world','font-size:25px;color:red;');
```

- 加动图...
```bash
console.log("%c", "padding:50px 300px;line-height:120px;background:url('http://wayou.github.io/2014/09/10/chrome-console-tips-and-tricks/rabbit.gif') no-repeat;");
```

- 输出表格：
`console.table`
```js
var data = [{'名字': '阿勒路亚', '武器': "单手斧"}, {'名字': '桐谷和人', '武器': "双手剑"}];
console.table(data);
```

- 只有表达式为假时才输出相应信息到控制台：
`console.assert`
```js
var isDebug=false;
console.assert(isDebug,'错啦错啦错啦错啦');
```

- 想统计某段代码执行了多少次时，计数：
`console.count`
```js
function foo(){
    //其他函数逻辑blah blah。。。
    console.count('foo 被执行的次数：');
}
foo(); //foo 被执行的次数：: 1
foo(); //foo 被执行的次数：: 2
```

- 将DOM结点以JavaScript对象的形式输出：
`console.dir`
```bash
console.dir(document.body);
```


- `$_`命令返回最近一次表达式执行的结果
```bash
2+2 //回车，再
$_+1 //回车得5
```

- $0~$4则代表了最近5个你选择过的DOM节点


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
