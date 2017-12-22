---
title: Hexo初入记载
date: 2017-03-10 17:17:18
layout: post
comments: true
tags: [Hexo]
categories: [前端]
keywords: 前端
description:
summary: Hexo预备式。
---

Hexo预备式。

<!-- more -->

[Hexo文档链接](https://hexo.io/zh-cn/docs/index.html) 

## 常用命令

### Create a new post

``` bash
$ hexo new "My New Post"
```

More info: [Writing](https://hexo.io/zh-cn/docs/writing.html)

### Run server

``` bash
$ hexo server
```

More info: [Server](https://hexo.io/zh-cn/docs/server.html)

### Generate static files

``` bash
$ hexo generate

$ hexo g -w   //简写并watching
```

More info: [Generating](https://hexo.io/zh-cn/docs/generating.html)

### Deploy to remote sites

``` bash
$ hexo deploy
$ hexo d    //简写
```

More info: [Deployment](https://hexo.io/zh-cn/docs/deployment.html)

### Clean
清除缓存文件 (db.json) 和已生成的静态文件 (public)。

在某些情况（尤其是更换主题后），发现对站点的更改无论如何也不生效，可能需要运行该命令。

``` bash
$ hexo clean
```


### publish
将草稿(_drafts)里的文章发布到_posts中，显示出来。
``` bash
$ hexo publish post <filename>
```

## 使用技巧/问题解决

### skip_render
> **跳过指定文件的渲染，可使用 [glob](https://github.com/isaacs/node-glob) 表达式来匹配路径。**
> **可以实现在hexo中添加自己定制的页面文件。**

在博客根目录的`_config.yml`下配置。

1. 要跳过 `source` 目录下的 `单个文件skip.html`
千万不要加上个 / 写成 /skip.html，这里只能填相对于source文件夹的相对路径。
``` yml
skip_render: skip.html
```

2. 要忽略 `source` 下的 `skip文件夹下所有文件`
``` yml
skip_render: skip/*
```

3. 要忽略`source`下的`skip文件夹下所有文件和目录`，可以这样配置：
```yml
skip_render: skip/**
```

4. 要忽略 `多个路径的文件或目录`，可以这样配置：
```yml
skip_render:
    - skip.html
    - skip/*
    - test/*
```

#### 问题:本地server运行时文章尾部中文乱码

在`_config.yml`设置启用压缩可以避免这个问题。

``` yml
server:
  compress: true
```

## 插件

### [hexo-admin](https://github.com/jaredly/hexo-admin) (一个本地可视化的markdown编辑器)
进入hexo根目录执行:
```bash
$ npm install --save hexo-admin
$ hexo server -d
$ open http://localhost:4000/admin/
```

## 如何写一个Hexo主题
[Create an Hexo Theme](http://www.codeblocq.com/2016/03/Create-an-Hexo-Theme-Part-1-Index/)