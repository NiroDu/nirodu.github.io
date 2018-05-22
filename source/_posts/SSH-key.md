---
title: 一台电脑配置多个用户身份，多个SSH KEY
date: 2017-06-03 09:38:00
layout: post
comments: true
tags: [SSH,Travis]
categories: [前端]
keywords: 
description:
summary: 
---

关于SSH Key的一些配置操作。

<!-- more -->

## 生成 SSH KEY
```
$ ssh-keygen -t rsa -C "your_email@example.com"

Generating public/private rsa key pair.
Enter file in which to save the key (/Users/your_user_directory/.ssh/id_rsa):
Enter passphrase (empty for no passphrase):
Enter same passphrase again:
```

your_email@example.com 改成自己的邮箱。

输入文件名，如果直接按回车则会默认自动生成私钥和公钥：id_rsa、id_rsa.pub。

接着跟着的是输入密码和确认密码。
密码输入成功后出现如下提示，表示创建成功：
```
Your identification has been saved in /Users/your_user_directory/.ssh/id_rsa.
Your public key has been saved in /Users/your_user_directory/.ssh/id_rsa.pub.
The key fingerprint is:
fingerprint值 your_email@example.com
The key's randomart image is:
 +--[ RSA 2048]----+
 | .+ + |
 | =oO. |
 ...
```
**注意：
上方的命令执行多次则会生成多个 SSH KEY 文件。如下：**

## 生成多个SSH KEY的操作方式：
### 新建第一个 SSH key：
```
$ ssh-keygen -t rsa -C "user1@email.com"
```
一路回车即可，选择默认路径(~/.ssh)

### 新建第二个 SSH key
```
$ ssh-keygen -t rsa -C "user2@email.com"
# 设置名称为Enter file in which to save the key (/c/Users/Administrator/.ssh/id_rsa): /指定一个路径/id_rsa_user2名称
```

## 查看 SSH KEY
```
$ cat ~/.ssh/id_rsa.pub
ssh-rsa 公开密钥的内容 your_email@example.com
```
如果创建时输入了文件名，上方的`id_rsa`替换成文件名。

## 为不同网站应用各自的 SSH KEY
在 ~/.ssh 目录下创建 config 文件：
```
$ vim ~/.ssh/config
```

输入以下信息：
```
# 第一个host
Host github.com
    HostName github.com
    User git
    IdentityFile ~/.ssh/id_rsa_a

# 第二个host
Host git.xxxxxx.com
    HostName git.xxxxxx.net
    User git
    IdentityFile ~/.ssh/id_rsa_b
```

再把对应的公钥添加至对应的网站上面。
注解：未加入配置文件的网站会自动应用id_rsa。
至此，多个 SSH KEY 就可以同时使用了。



## GIT CONFIG
像 github 或者 gitlab 等网站都会要求验证身份。通常情况下配置一个全局信息就可以了，针对一些特殊情况，如果需要配置多个身份信息，可以为项目单独配置。

**配置全局信息**
```
$ git config --global user.name "Firstname Lastname"
$ git config --global user.email "your_email@example.com"
```
这个命令会在   ~/.gitconfig   填入以下信息：

[user]
  name = Firstname Lastname
  email = your_email@example.com

如果需要修改信息，直接修改这个文件即可。

**配置单独信息**
```
$ cd your_project
$ git config user.name "Firstname Lastname"
$ git config user.email "your_email@example.com"
```
这个命令会在项目目录下输出文件：/.git／config
这里设置的姓名和邮箱地址会用在 Git 的提交日志中。
