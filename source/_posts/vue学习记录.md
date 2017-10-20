---
title: vue学习记录
date: 2017-10-19 17:07:32
tags:
comments:
categories:
keywords:
description:
summary:
---

### 安装vue脚手架

```bash
$ npm install -g vue-cli
$ vue init webpack learn_project
$ cd learn_project
$ npm install
$ npm run dev
```

#### 目录结构

```bash
.
├── build/                      # webpack config files
│   └── ...
├── config/
│   ├── index.js                # main project config
│   └── ...
├── src/
│   ├── main.js                 # app entry file
│   ├── App.vue                 # main app component
│   ├── components/             # ui components
│   │   └── ...
│   └── assets/                 # module assets (processed by webpack)
│       └── ...
├── static/                     # pure static assets (directly copied)
├── test/
│   └── unit/                   # unit tests
│   │   ├── specs/              # test spec files
│   │   ├── index.js            # test build entry file
│   │   └── karma.conf.js       # test runner config file
│   └── e2e/                    # e2e tests
│   │   ├── specs/              # test spec files
│   │   ├── custom-assertions/  # custom assertions for e2e tests
│   │   ├── runner.js           # test runner script
│   │   └── nightwatch.conf.js  # test runner config file
├── .babelrc                    # babel config
├── .postcssrc.js               # postcss config
├── .eslintrc.js                # eslint config
├── .editorconfig               # editor config
├── index.html                  # index.html template
└── package.json                # build scripts and dependencies

```

```json
  "scripts": {
    "dev": "node build/dev-server.js",  // Starts a Node.js local development server.
    "start": "npm run dev",
    "build": "node build/build.js"     // Build assets for production.
    /*    
    JavaScript minified with UglifyJS.
    HTML minified with html-minifier.
    CSS across all components extracted into a single file and minified with cssnano.
    All static assets compiled with version hashes for efficient long-term caching, and a production index.html is auto-generated with proper URLs to these generated assets.
    */
    "unit": "cross-env BABEL_ENV=test karma start test/unit/karma.conf.js --single-run",
    "e2e": "node test/e2e/runner.js",
    "test": "npm run unit && npm run e2e",
    "lint": "eslint --ext .js,.vue src test/unit/specs test/e2e/specs"
  }
```

> PS:
This boilerplate has pre-configured CSS extraction for most popular CSS pre-processors including LESS, SASS, Stylus, and PostCSS. To use a pre-processor, all you need to do is installing the appropriate webpack loader for it. For example, to use SASS:
```bash
npm install sass-loader node-sass --save-dev
```
> Note you also need to install node-sass because sass-loader depends on it as a peer dependency.




[learn_project Demo](/source/unrender/vue_project/learn_project)
[vue-cli 文档介绍](http://vuejs-templates.github.io/webpack/)

[TODO Demo](https://codesandbox.io/s/o29j95wx9)
[ECMAScript 2015 Features](https://babeljs.io/learn-es2015/#ecmascript-2015-features)
[vue-loader 中文文档](https://vue-loader.vuejs.org/zh-cn/)
[vuex 中文文档](https://vuex.vuejs.org/zh-cn/)
[vue-router 中文文档](https://router.vuejs.org/zh-cn/)