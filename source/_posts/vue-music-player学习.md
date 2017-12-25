---
title: vue-music-player学习
date: 2017-11-28 10:49:55
tags:
comments:
categories: 
keywords:
description:  
summary: 关于vue-music的学习过程...
password: Nirooo
abstract: 
message: 
---
**1.  `class` 规范，要首字母大写。如：**
```js
import MHeader from 'components/m-header/m-header'
```
中的 `MHeader`，它是一个类的形式。

**2. `this.slider` 是在vue对象里声明new了一个 BScroll 变量**
```js
this.slider = new BScroll(this.$refs.slider, {
          scrollX: true,
          scrollY: false,
          momentum: false,
          snap: true,
          snapLoop: this.loop,
          snapThreshold: 0.3,
          snapSpeed: 400
})
```

**3. 在vue将元素挂载到dom上之后, 浏览器要去将元素渲染出来, 那个20ms就是给浏览器20ms的渲染时。**
```js
mounted() {
    setTimeout(() => {
    this._setSliderWidth()
    this._initDots()
    this._initSlider()
    }, 20)
}
```

官方文档说的很明白使用 `this.$nextTick` 就是为了解决dom渲染的问题，因此推荐使用代替:

```js
mounted(){
    this.$nextTick(() => {
        //这里的代码会在dom渲染完毕运行
        this._setSliderWidth()
        this._initDots()
        this._initSlider()
     })
}
```