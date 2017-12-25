---
title: Git常用命令
date: 2017-12-22 15:11:21
tags:
comments:
categories:
keywords:
description:
summary: 关于Git的常用命令记载。
---

## **基本命令**
```shell
$ git init  #创建新的 $ git 仓库

$ git clone /path/to/repository  #创建一个本地仓库的克隆版本

$ git clone username@host:/path/to/repository  #克隆远端服务器上的仓库

$ git status  #查看状态

$ git add <file>  #把新文件或修改添加到缓存区(index)

$ git add .  #添加全部

$ git commit -m "代码提交信息"  #把改动提交到 HEAD，但还没提交到到的远端仓库

$ git pull  #从远程获取最新版本并merge到本地

$ git push  #将改动提交到远端仓库

$ git log  #查看记录
```

## **分支操作**
```bash
$ git checkout -b <branch>  #新建分支

$ git checkout <branch>  #切换到某个分支

$ git checkout <tagname>  #切换到某个版本

$ git diff <nowbranch> <otherbranch>  #查看两个分支的异同

$ git merge <otherbranch>  #合并当前分支和branch分支

$ git branch -d <branch>  #删除分支

$ git branch -D <branch>  # 强制删除分支

$ git push origin --delete <branch>  # 删除一个远程分支
```

## **撒销操作**
```bash
$ git revert HEAD  #撤销最近一次提交

$ git rever HEAD^  #撤销“上上次”提交

$ git rever HEAD <hash>  #撤销指定的提交

# reset命令把当前分支指向另一个位置，并且有选择的变动工作目录和索引。
# 也用来在从历史仓库中复制文件到索引，而不动工作目录。

$ git reset HEAD  #回到上次提交的状态(last commited state)

$ git reset HEAD^($ git reset --hard HEAD~1)  #回到上上次（倒数第二次）提交的状态

$ git reset HEAD~2  #回退两个commit

$ git reset HEAD~3  #回退三个commit

$ git reset hard <hash>  #回滚到指定的版本
#如果用--hard选项，那么工作目录也更新。

$ git reset --hard HEAD  #回到上次提交的状态(last commited state)

$ git reset --hard HEAD^($ git reset --hard HEAD~1)  #回到上上次（倒数第二次）提交的状态

$ git reset --hard HEAD~2  #回退两个commit

$ git reset --hard HEAD~3  #回退三个commit

$ git reset --hard <hash>  #回滚到指定的版本

$ git commit --amend # 修改最后一次提交
```

## **删除操作**
```bash
$ git rm [-f | --force] [-n] [-r] [--cached] [--ignore-unmatch] [--quiet] [--] <file>

$ git rm <file>  #把文件从 Git仓库中删除

$ git rm --cached  <file> #移除跟踪但不删除文件
```

## **其他**
```bash
$ gitk  #内建的图形化$ git

$ git config color.ui true  #彩色的$ git输出

$ git config format.pretty oneline  #显示历史记录时，只显示一行信息

$ git add -i  #交互地添加文件至缓存区

$ git config --add core.filemode false #忽略文件权限检查
```

### stash的使用
当你正在进行项目中某一部分的工作，里面的东西处于一个比较杂乱的状态，而你想转到其他分支上进行一些工作。问题是，你不想提交进行了一半的工作，否则以后你无法回到这个工作点。解决这个问题的办法就是$ git stash命令。
“‘储藏”“可以获取你工作目录的中间状态——也就是你修改过的被追踪的文件和暂存的变更——并将它保存到一个未完结变更的堆栈中，随时可以重新应用。

```bash
$ git stash  #暂存临时代码

$ git stash list  #查看所有的搁置版本

$ git stash aplly  #找回之前搁置的改动

$ git stash apply stash@{1}  #就可以将你指定版本号为stash@{1}的工作取出来

$ git stash pop  #从Git栈中读取最近一次保存的内容，恢复工作区的相关内容

$ git stash clear #删除所有stash
```


![](/img/git/Git常用命令表.jpg)


## **一些比较清晰明了的参考资料**

[Git远程操作详解 - 阮一峰](http://www.ruanyifeng.com/blog/2014/06/git_remote.html)

[git - 简易指南](http://rogerdudler.github.io/git-guide/index.zh.html)

[图解Git](http://marklodato.github.io/visual-git-guide/index-zh-cn.html)