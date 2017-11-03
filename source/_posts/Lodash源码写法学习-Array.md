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

### _.slice(array, [start=0], [end=array.length])
> Creates a slice of array from start up to, but not including, end. (将旧数组按指定的 start 和 end 的位置截取成新数组)

```js
function slice(array, start, end) {
  let length = array == null ? 0 : array.length
  if (!length) {
    return []
  }
  start = start == null ? 0 : start
  end = end === undefined ? length : end

  if (start < 0) {
    start = -start > length ? 0 : (length + start)
  }
  end = end > length ? length : end
  if (end < 0) {
    end += length
  }
  length = start > end ? 0 : ((end - start) >>> 0)
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

### `_.chunk(array, [size=1])`
> Creates an array of elements split into groups the length of size. If array can't be split evenly, the final chunk will be the remaining elements. （指定一个size，将旧数组以该size为长度单位拆分为多个数组，并将其合并成一个新的大数组。若数组不能均匀分割，剩余的元素组成最后一个小数组）

```js
function slice(array, start, end) {
  let length = array == null ? 0 : array.length
  if (!length) {
    return []
  }
  start = start == null ? 0 : start
  end = end === undefined ? length : end

  if (start < 0) {
    start = -start > length ? 0 : (length + start)
  }
  end = end > length ? length : end
  if (end < 0) {
    end += length
  }
  length = start > end ? 0 : ((end - start) >>> 0)
  start >>>= 0

  let index = -1
  const result = new Array(length)
  while (++index < length) {
    result[index] = array[index + start]
  }
  return result
}

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