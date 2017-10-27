# tutorabc-h5

# https://lp.tutorabc.com.cn/h5/...


## Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for stage
npm run build:stage

# build for pre
npm run build:pre

# build for prod
npm run build:prod

```


## 使用说明

> start

> /src/目录下新建项目文件夹new-demo

> /project-list.js修改项目配置文件
```
module.exports = {
  active: 'new-demo', //需要build的项目list，支持数组['demo','new-demo']，多人多项目请及时update此文件
  list: ['demo','new-demo'], //所有项目list
};
```

> npm run dev

> ...

> end
