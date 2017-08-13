---
title: 微信表情 → 头像
date: 2017-07-16 23:04:23
layout: post
comments: true
tags: [Travis]
categories: [前端]
keywords: 前端
description:
---

简单记录下，操作微信表情解决头像荒。

<!-- more -->

<div class="tip">此乃花小微大王需求！！</div>

花花和我打电话时突发奇想，换了个头像，出自赞赏作者界面的表情。
![wechatSticker1](/img/wechatSticker/1.jpg)

> 好，开始吧。微信客户端表情导出使用。（Mac版）

## 1、进入微信客户端缓存文件夹
mac上按下`command+shift+g`前往文件夹，输入以下目录：
```
~/Library/Containers/com.tencent.xinWeChat/Data/Library/Application Support/
```
![wechatSticker2](/img/wechatSticker/2.png)

其中的`com.tencent.xinWeChat`就是微信客户端的所有信息文件保存位置了。

> **进入里面`2.0b4.0.9`(当前版本)→`Stickers`→`File`文件夹。**

可见`File`文件夹下有特别多的无后缀名文件：

![wechatSticker4](/img/wechatSticker/4.png)

**这些便是微信表情的文件了，将它们全部拷贝出来做处理。**

## 2、对这些微信表情文件批量重命名

打开终端，在命令行输入cd命令，进入拷贝的微信表情所在的文件夹目录。(可直接将目录拖到终端里，直接得到文件夹目录地址。)

再输入批量追加后缀名命令。

```bash
for i in *; do mv "$i" "$i.gif"; done
```

以上命令是对该目录下的所有文件重命名为`.gif`文件。

这样无后缀名文件就显示出来了。
![wechatSticker3](/img/wechatSticker/3.png)

双击打开gif图片，选取其中喜欢的一张静态图片就可以啦。
