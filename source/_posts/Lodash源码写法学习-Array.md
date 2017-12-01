---
title: Lodash源码写法学习-Array
date: 2017-11-02 20:32:24
tags:
comments:
categories: [Lodash,es6]
keywords:
description:
summary: Lodash源码写法学习 - Array部分
---

[TOC]

### _.slice(array, [start=0], [end=array.length])
> Creates a slice of array from start up to, but not including, end. (将旧数组按指定的 start 和 end 的位置截取成新数组)

```js
function slice(array, start, end) {
  // 假如length值默认为array.length。
  let length = array == null ? 0 : array.length
  if (!length) {
    return []
  }
  // 假如start值没声明，则默认为0。  
  start = start == null ? 0 : start
  // 假如end值没声明，则默认为array.length。  
  end = end === undefined ? length : end

  if (start < 0) {
    // start为负数，则start为(length + start)，从尾部开始数起点位置
    start = -start > length ? 0 : (length + start)
  }
  // end的值最大为数组的长度
  end = end > length ? length : end
  if (end < 0) {
    // end为负数，则end值为数组长度减去end值
    end += length
  }
  // start值大于end值则新数组长度为0，否则为 (end - start) >>> 0 保证长度为正值。
  length = start > end ? 0 : ((end - start) >>> 0)
  
  // 保证起点为正值
  start >>>= 0

  let index = -1
  const result = new Array(length)
  while (++index < length) {
    result[index] = array[index + start]
  }
  return result
}
```
运行：
```js
slice([1,2,3,4,5,6],2,6)
// [ 3, 4, 5, 6 ]
```

> 疑点 · 斩
`>>>` 无符号右移运算符。
`>>>=`无符号右移赋值运算符。
`-start` 将start的值变成负值。
`start >>>= 0` 避免出现NaN问题，start假如是字符串则返回0，可保证start定是正数。


### `_.chunk(array, [size=1])`
> Creates an array of elements split into groups the length of size. If array can't be split evenly, the final chunk will be the remaining elements. （指定一个size，将旧数组以该size为长度单位拆分为多个数组，并将其合并成一个新的大数组。若数组不能均匀分割，剩余的元素组成最后一个小数组）

```js
import slice from './slice.js'

function chunk(array, size) {
  size = Math.max(size, 0)
  const length = array == null ? 0 : array.length
  // 假如数组为空或指定的size小于1，则最终返回新的数组为空
  if (!length || size < 1) {
    return []
  }
  let index = 0
  let resIndex = 0
  //ceil() 方法可对一个数进行上舍入。 例: Math.ceil(7/3)  结果==> 3
  const result = new Array(Math.ceil(length / size))

  while (index < length) {
    result[resIndex++] = slice(array, index, (index += size))
  }
  return result
}
```
运行：
```js
chunk(['a', 'b', 'c', 'd'], 2);
// [ [ 'a', 'b' ], [ 'c', 'd' ] ]
chunk(['a', 'b', 'c', 'd',3,"haha","last chunk"], 3);
// [ [ 'a', 'b', 'c' ], [ 'd', 3, 'haha' ], [ 'last chunk' ] ]
```


### `_.compact(array)`
> Creates an array with all falsey values removed. The values false, null, 0, "", undefined, and NaN are falsey. (创建一个新数组，并移除旧数组中所有无效的值，如(false, null, 0, "", undefined, NaN))

```js
function compact(array) {
  let resIndex = 0
  const result = []

  if (array == null) {
    return result
  }
  // ES6 新增了 for..of 迭代器，它与 for..in 的区别是： 它返回的是值而不是 key
  for (const value of array) {
    if (value) {
      result[resIndex++] = value
    }
  }
  return result
}
```
运行：
```js
compact([0, 1, false, 2, '', 3]);
// [ 1, 2, 3 ]
```

### `_.difference(array, [values])` (保留)
> Creates an array of array values not included in the other given arrays using SameValueZero for equality comparisons. The order and references of result values are determined by the first array.

### `_.differenceBy(array, [values], [iteratee=_.identity])` (保留)
> This method is like _.difference except that it accepts iteratee which is invoked for each element of array and values to generate the criterion by which they're compared. The order and references of result values are determined by the first array. The iteratee is invoked with one argument:
### `_.differenceWith(array, [values], [comparator])` (保留)
> This method is like _.difference except that it accepts comparator which is invoked to compare elements of array to values. The order and references of result values are determined by the first array. The comparator is invoked with two arguments: (arrVal, othVal).

### `_.drop(array, [n=1])`
> Creates a slice of array with n elements dropped from the beginning. (创建一个从头开始丢弃n个元素的新数组)

```js
import slice from './slice.js'
// 不加参数n则默认为1
function drop(array, n=1) {
  const length = array == null ? 0 : array.length
  // 用了slice(array, n, array.length)进行裁剪
  return length
    ? slice(array, n < 0 ? 0 : n, length)
    : []
}
```

运行：
```js
drop([1, 2, 3], 2);
// [ 3 ]
```

### `_.dropRight(array, [n=1])`
> Creates a slice of array with n elements dropped from the end. (创建一个从尾部开始丢弃n个元素的新数组)

```js
import slice from './slice.js'

function dropRight(array, n=1) {
  const length = array == null ? 0 : array.length
  // slice(array, 0, -n)进行裁剪
  return length ? slice(array, 0, n < 0 ? 0 : -n) : []
}
```

运行：
```js
dropRight([1, 2, 3], 2);
// [ 3 ]
```
### `_.dropRightWhile(array, [predicate=_.identity])` (保留)
> Creates a slice of array excluding elements dropped from the end. Elements are dropped until predicate returns falsey. The predicate is invoked with three arguments: (value, index, array). ()

### `_.dropWhile(array, [predicate=_.identity])` (保留)
> Creates a slice of array excluding elements dropped from the beginning. Elements are dropped until predicate returns falsey. The predicate is invoked with three arguments: (value, index, array).

### `_.fill(array, value, [start=0], [end=array.length])`
> Fills elements of array with value from start up to, but not including, end. (用指定的值填充数组，从 start 到 end 的位置，但不包括 end 本身的位置。 )


`concat()`	连接两个或更多的数组，并返回结果。
`copyWithin()`	从数组的指定位置拷贝元素到数组的另一个指定位置中。
`every()`	检测数值元素的每个元素是否都符合条件。
`fill()` 使用一个固定值来填充数组。
`filter()`	检测数值元素，并返回符合条件所有元素的数组。
`find()`	返回符合传入测试（函数）条件的数组元素。
`findIndex()`	返回符合传入测试（函数）条件的数组元素索引。
`forEach()`	数组每个元素都执行一次回调函数。
`indexOf()`	搜索数组中的元素，并返回它所在的位置。
`join()`	把数组的所有元素放入一个字符串。
`lastIndexOf()` 返回一个指定的字符串值最后出现的位置，在一个字符串中的指定位置从后向前搜索。
`map()`	通过指定函数处理数组的每个元素，并返回处理后的数组。
`pop()`	删除数组的最后一个元素并返回删除的元素。
`push()`	向数组的末尾添加一个或更多元素，并返回新的长度。
`reduce()`将数组元素计算为一个值（从左到右）。
`reduceRight()`	将数组元素计算为一个值（从右到左）。
`reverse()`	 反转数组的元素顺序。
`shift()`	删除并返回数组的第一个元素。
`slice()`	选取数组的的一部分，并返回一个新数组。
`some()`	检测数组元素中是否有元素符合指定条件。
`sort()`	对数组的元素进行排序。
`splice()`	从数组中添加或删除元素。
`toString()`	把数组转换为字符串，并返回结果。
`unshift()`	向数组的开头添加一个或更多元素，并返回新的长度。
`valueOf()`	返回数组对象的原始值。
