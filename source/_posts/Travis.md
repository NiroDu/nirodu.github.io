---
title: ✡ Travis自动化构建+部署
date: 2017-06-11 09:38:00
layout: post
comments: true
tags: [Travis]
categories: [前端]
keywords: 前端
description:
---
使用Travis自动化构建+部署可让我们摆脱对Hexo本机环境的依赖，实现不管在哪台电脑上都可以实时更新自己的博客。

<!-- more -->

## **自动化构建+部署：**

Travis 会在你每一次提交之后生成一个虚拟机来执行我们编写的脚本任务，脚本执行的内容会写在`.travis.yml`文件中。

这样只要你使用 git 提交了更改，就可以让 Travis 在线上替你执行 `Hexo g`+`Hexo d` 的命令，如此一来，我们在不同的电脑上想要写博客，只需使用 Markdown 工具写好 `.md` 文件，使用git上传博客的源文件，其他的就交给 Travis ，过几分钟便会自动部署好你的博客内容，完成更新上线。

## **基础知识**

在操作前需要先熟悉三个方面的知识点。
### **1、HEXO命令**
可在此了解 <a href="/2017/03/10/hello-world/" target="_blank">Hexo 初入记载</a>

### **2、GIT命令**
可在此了解 <a href="http://www.ruanyifeng.com/blog/2014/06/git_remote.html" target="_blank">Git远程操作详解</a>

### **3、SSH Key**
可在此了解 <a href="/2017/06/03/SSH-key/" target="_blank">SSH Key浅析</a>

## **概述**
![Branch](/img/Travis/branch.png)

**以下配置都以 MAC OSX系统 为环境进行配置。** 

## **第一步、配置SSH密钥**

### (一) 生成SSH密钥

> 使用SSH Key可免去在Github上Hexo部署时得输入密码，但要注意的是，这个SSH key不应是github账号的全局SSH key，因为这样Travis CI就获得了你所有代码库的提交权限。


应该使用 **单独ssh密钥**，添加至`https://github.com/用户名/项目名/settings/keys`的Deploy keys，这样就控制了Travis CI的权限。

生成单独ssh密钥命令：
```BASH
$ cd ~/.ssh
$ ssh-keygen -t rsa -C "nirodu1219@outlook.com"
```
在执行生成密钥的过程中会提示如下：
```
Generating public/private rsa key pair.
Enter file in which to save the key (/Users/your_user_directory/.ssh/id_rsa):
Enter passphrase (empty for no passphrase):
Enter same passphrase again:
```
其中，<u>Enter file in which to save the key (/Users/your_user_directory/.ssh/id_rsa):</u>
假如直接按回车则会在默认的`.ssh/`目录下生成`id_rsa`和`id_rsa.pub`文件。

为了区别这是专为Travis生成的密钥，我们在这一步输入路径和文件名：`/Users/nirodu/.ssh/id_rsa_forTravic`

然后会在`.ssh/`目录下生成`id_rsa_forTravic`和`id_rsa_forTravic.pub`两个文件。
<br>

### (二)  添加SSH Key到项目的Deploy keys
登录到github中，点击进入到博客仓库。
点击右上方的Settings进入到设置页面，点击左边的Deploy keys项。

给 **Title** 取个名字，打开`id_rsa_forTravic.pub`文件，复制里面的内容到**Key文本框**，勾选 **Allow write access**，点击 **Add key** 确认添加。

![Deploy keys](/img/Travis/deploy_keys.png)

<br>

### (三) 新建配置文件
然后在 `.ssh/` 文件夹中创建一个名为 `config` 的配置文件。

> **config 配置的作用：**
为不同网站应用各自的 SSH KEY。

```BASH
$ cd ~/.ssh
$ touch config
```
用编辑器打开 `config` 文件，添加如下信息：

```
# github
Host github.com
HostName github.com
PreferredAuthentications publickey
IdentityFile ~/.ssh/id_rsa

# github_blog
Host github.com
HostName github.com
PreferredAuthentications publickey
IdentityFile ~/.ssh/id_rsa_forTravic
```

提示：这里的密钥文件路径根据自己的做相应修改，再把对应的公钥添加至对应的网站上面。
未加入配置文件的网站会自动应用`id_rsa`。

## **第二步、配置Travis**

### (一) Travis CI 官网配置
打开[Travis CI](https://travis-ci.org/)，使用github账号登录。

跟着Travis官网的提示，添加一个Repositories，找到博客项目，开启travis支持。

![Add repositories](/img/Travis/add_repositories.png)

然后点击设置按钮，在项目的设置中开启 `Build only if .travis.yml is present`.

### (二) 用 Travis CI 加密 SSH

**（ 1 ）**首先打开终端，安装travis（要先安装好Ruby和gem环境）。

```BASH
$ gem install travis
```
<br>

**（ 2 ）**然后到博客项目文件夹，在**项目根目录**新建 `.travis.yml` 配置文件。

```BASH
$ cd 博客项目文件夹根目录
$ touch .travis.yml
```

> 有可能会提示：Names that begin with a dot “.” are reserved for the system.
  这是以 `.` 开头命名的文件在系统中是默认保留的，用这样的的命名方式的文件会自动隐藏。

将系统隐藏文件显示出来也很简单，只需要在终端输入以下命令：
```BASH
$ defaults write com.apple.Finder AppleShowAllFiles YES 
$ killall Finder
```
即可显示系统隐藏文件，若想继续隐藏则把 "YES" 改成 "NO" 就行。
<br>

**（ 3 ）**在博客项目文件夹，在**项目根目录**创建`.travis`文件夹。
```BASH
$ mkdir .travis
```

把刚才在 `.ssh` 目录下生成的 `id_rsa_forTravic` 私钥复制到 `.travis文件夹` 下：
```BASH
$ cp ~/.ssh/id_rsa_forTravic .travis/
```

然后新建SSH配置文件 `ssh_config` 到`.travis文件夹`：
```BASH
$ touch .travis/ssh_config
```
<div class="tip">
这个配置文件，是在线上Travis虚拟机构建过程中使用的，路径不是本地机的，是以Travis虚拟机为根目录的路径。所以路径和名字可大胆命名为  `~/.ssh/id_rsa`
</div>

编辑配置文件，添加如下内容：
```
Host github.com
User git
StrictHostKeyChecking no
IdentityFile ~/.ssh/id_rsa
IdentitiesOnly yes
```
<br>

**（ 4 ）**Travis 加密操作
> 要加密的原因很简单，Travis 需要取得足够的权限才能对 Github仓库 进行操作，我们在博客仓库里添加过一个公钥 `id_rsa_forTravic.pub`，Travis需要取得私钥 `id_rsa_forTravic` 才能通过认证，进行构建部署。而假如直接把私钥文件上传到开源的Github上，被别人下载到未加密的私钥文件，那这个仓库的控制权就是共享的了...

首先是用终端登录Travis账号，再使用命令对私钥进行加密。
```BASH
$ travis login --auto
```
然后会提示输入github的用户名和密码。
或者是弹框请求允许读取信息，都选同意。

**加密操作（这一步容易出现各种问题，请按如下命令操作。）**

打开终端，进到 `.travis 文件夹`目录下执行：
```BASH
$ travis encrypt-file id_rsa_forTravic --add -r NiroDu/nirodu.github.io
```
> `NiroDu/nirodu.github.io` 替换成你的 `账户名/博客仓库名`。

执行后会在当前目录`.travis 文件夹`下生成加密之后的私钥文件 `id_rsa_forTravic.enc`，然后删除 `id_rsa_forTravic` 私钥文件（私钥不泄露）。

同时，在`.travis.yml`文件中会插入这么一个语句：
```
openssl aes-256-cbc -K $encrypted_xxxxxxxxxxx_key -iv $encrypted_xxxxxxxxxxx_iv
```
这是线上用来给`id_rsa_forTravic.enc`解密的信息。

执行完加密后，在Travis系统的设置中，多了Environment Variables，即解密用的两串信息。

![travis_key](/img/Travis/travis_key.png)

### (三) 编辑`.travis.yml`配置文件
打开Travis配置文件 `.travis.yml`，添加执行脚本（虚拟机用）：

```yml
language: node_js
node_js:
- '6'  # nodejs的版本
branches:
  only:
  - dev # 设置博客源代码分支（检测这个分支有改动，则自动化部署到master分支）
before_install:
- export TZ='Asia/Shanghai' # 设置时区
- npm install -g hexo # 虚拟机安装hexo
- npm install -g hexo-cli # 虚拟机安装hexo命令行工具
- openssl aes-256-cbc -K $encrypted_dc70c6c06754_key -iv $encrypted_dc70c6c06754_iv -in .travis/id_rsa_forTravic.enc -out ~/.ssh/id_rsa -d # 修改Travis自动插入的解密指令，将解密后的私钥导出在虚拟机中，即 ~/.ssh/id_rsa
- chmod 600 ~/.ssh/id_rsa # 设置id_rsa文件权限
- eval $(ssh-agent)
- ssh-add ~/.ssh/id_rsa # 将密钥加入系统
- cp .travis/ssh_config ~/.ssh/config # 将之前创建的ssh_config复制到Travis的虚拟机中去
- git config --global user.name "NiroDu" # 设置github账户信息
- git config --global user.email nirodu1219@outlook.com
install: # 安装依赖组件
- npm install # 虚拟机安装依赖
- npm install hexo-deployer-git --save # 虚拟机安装hexo-deployer-git插件，以解决hexo+git上传时容易出现的问题
script: # 执行的命令
- hexo clean && hexo g -d # 虚拟机执行生成&部署命令
```

### **至此 Travis 配置完成。**

## **第三步、Git/Hexo 其余配置**

> **再强调一遍，也是网上教程令人困惑的地方。要实现Travis自动化构建，得在Github上创建两个分支:**
1、默认的master分支，用来存放hexo编译后的网页文件。
2、自定义命名的分支dev，用于存放hexo博客源码，并把它设置为xx.github.io博客仓库的默认分支，Github的push和pull都在这个分支进行。
并且 dev 分支由 Travis 检测，一旦有改动，Travis 会自动拉取 dev 中的代码进行自动化构建+部署。

所以，在博客根目录下的`_config.yml`文件中deploy配置的分支是master：
```yml
deploy:
  type: git
  repo: git@github.com:NiroDu/nirodu.github.io.git
  branch: master
```
在`.travis.yml`中配置的分支是dev：
```yml
branches:
  only:
  - dev
```
### （一） 构建博客目录
我是这样执行的：

**1、在Github创建好两个新的分支后。**

**2、拉取dev分支到本地:**
```BASH
$ git clone git@github.com:NiroDu/nirodu.github.io.git
```
该操作会产生一个`nirodu.github.io`文件夹。

**3、新建一个文件夹`temp`并把它初始化为Hexo文件夹**
```BASH
$ hexo init
```
**4、再把里面的内容拷贝到`nirodu.github.io`文件夹。**

这么做的原因是`hexo init`命令会把整个文件夹初始化，会删掉的.git文件夹和git配置，导致无法正常用git进行pull和push。
保持`nirodu.github.io`文件夹不动，拷贝hexo的文件过来即可顺利上传博客源码文件。


### （二） 上传到Github

进入到博客根目录，执行：

```BASH
$ git add .
$ git commit -m "travis upload"
$ git push -u origin dev
```

### （三） 到[Travis执行后台](https://travis-ci.org/)查看构建生成情况。

完。
