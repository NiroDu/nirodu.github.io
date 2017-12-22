---
title: ES6学习笔记
tags:
  - ES6
  - Javascript
categories:
  - 前端
date: 2017-08-30 19:27:57
summary: 关于ES6的常用语法参考。
---

关于ES6的常用语法参考。

<!-- more -->

[Babel官网](https://babeljs.io/)
Babel是一个广泛使用的ES6转码器，可以将ES6代码转为ES5代码，从而在现有环境执行。
## let, const
`let`命令，用来声明变量。它的用法类似于`var`，但是所声明的变量，只在`let`命令所在的代码块内有效。

`const`声明一个只读的常量。一旦声明，常量的值就不能改变。

## class, extends, super
ES6提供了更接近传统语言的写法，引入了Class（类）这个概念。

```js
class Animal {
    constructor(){
        this.type = 'animal'
    }
    says(say){
        console.log(this.type + ' says ' + say)
    }
}

let animal = new Animal()
animal.says('hello') //animal says hello

class Cat extends Animal {
    constructor(){
        super()
        this.type = 'cat'
    }
}

let cat = new Cat()
cat.says('hello') //cat says hello
```
上面代码首先用class定义了一个“类”，可以看到里面有一个constructor方法，这就是构造方法。

constructor内定义的方法和属性是实例对象自己的，而constructor外定义的方法和属性则是所有实例对象可以共享的。


Class之间可以通过extends关键字实现继承。上面定义了一个Cat类，该类通过extends关键字，继承了Animal类的所有属性和方法。

**super关键字，它指代父类的实例（即父类的this对象）。**
子类必须在constructor方法中调用super方法，否则新建实例时会报错。
**这是因为子类没有自己的this对象，而是继承父类的this对象，然后对其进行加工。如果不调用super方法，子类就得不到this对象。**

## arrow function

ES5和ES6写法对比：
```js
//ES5
function(i){ return i + 1; } 

//ES6
(i) => i + 1 
```
```js
 //ES5
function(x, y) { 
    x++;
    y--;
    return x + y;
}

 //ES6
(x, y) => {x++; y--; return x+y}
```

**当我们使用箭头函数时，函数体内的this对象，就是定义时所在的对象，而不是使用时所在的对象。**

并不是因为箭头函数内部有绑定this的机制，实际原因是箭头函数根本没有自己的this，它的this是继承外面的，因此内部的this就是外层代码块的this。

```js
class Animal {
    constructor(){
        this.type = 'animal'
    }
    says(say){
        setTimeout( () => {
            console.log(this.type + ' says ' + say)
        }, 1000)
    }
}
 var animal = new Animal()
 animal.says('hi')  //animal says hi
```
内部等同于：
```js
    says(say){
       setTimeout(function(){
           console.log(this.type + ' says ' + say)
       }.bind(this), 1000)
    }
```

## template string
当我们要插入大段的html内容到文档中时，传统的写法非常麻烦：

```js
$("#result").append(
  "There are <b>" + basket.count + "</b> " +
  "items in your basket, " +
  "<em>" + basket.onSale +
  "</em> are on sale!"
);
```
而使用ES6的新特性模板字符串``后，我们可以直接这么来写：

```js
$("#result").append(`
  There are <b>${basket.count}</b> items
   in your basket, <em>${basket.onSale}</em>
  are on sale!
`);
```

`${}` 引用变量
`用来标识起始

## destructuring
ES6允许按照一定模式，从数组和对象中提取值，对变量进行赋值，这被称为解构（Destructuring）。

```js
//ES5写法
let cat = 'ken'
let dog = 'lili'
let zoo = {cat: cat, dog: dog}
console.log(zoo)  //Object {cat: "ken", dog: "lili"}
```

```js
//ES6写法
let cat = 'ken'
let dog = 'lili'
let zoo = {cat, dog}
console.log(zoo)  //Object {cat: "ken", dog: "lili"}
```
反过来可以这么写：
```js
//ES6写法
let dog = {type: 'animal', many: 2}
let { type, many} = dog
console.log(type, many)   //animal 2
```

## default, rest
default很简单，意思就是默认值。
例如调用`animal()方法`时忘了传参数，传统的做法就是加上这一句`type = type || 'cat' `来指定默认值。
```js
//ES5
function animal(type){
    type = type || 'cat'  
    console.log(type)
}
animal()
```
如果用ES6我们而已直接这么写：
```js
function animal(type = 'cat'){
    console.log(type)
}
animal()
```


## 参考资料
- [30分钟掌握ES6/ES2015核心内容](https://segmentfault.com/a/1190000004365693#articleHeader5)
- [ECMAScript 6 入门](https://es6.ruanyifeng.com/)
