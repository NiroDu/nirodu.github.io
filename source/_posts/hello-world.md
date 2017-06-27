---
title: Hexo 初入记载
---

[Hexo文档链接](https://hexo.io/zh-cn/docs/index.html) 

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



