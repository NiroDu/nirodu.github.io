---
title: WebVR
date: 2017-05-25 17:17:18
layout: post
comments: true
tags: [Travis]
categories: [前端]
keywords: 前端
description:
---
> WebVR 是早期和实验性的 JavaScript API，它提供了访问如 Oculus Rift 和 Google Cardboard 等 VR 设备功能的 API。

<!-- more -->

## 前言

VR 应用需要高精度、低延迟的接口，才能传递一个可接受的体验。而对于类似 Device Orientation Event 接口，虽然能获取浅层的 VR 输入，但这并不能为高品质的 VR 提供必要的精度要求。WebVR 提供了专门访问 VR 硬件的接口，让开发者能构建舒适的 VR 体验。

WebVR API 目前可用于安装了 Firefox nightly 的 Oculus Rift、Chrome 的实验性版本和 Samsung Gear VR 的浏览器。当然，如果你现在就想在你的移动端浏览器体验 WebVR，可以使用 [WebVR Polyfill](https://github.com/googlevr/webvr-polyfill) 





## WebVR 开发
在 Web 上开发 VR 应用，有下面三种（潜在）方式：
- JavaScript, Three.js 与 监听设备方向（Device Orientation）
- JavaScript, Three.js 与 WebVR
- CSS 与 WebVR（仍处于非常早期阶段）

#### A-Frame
A-Frame 是一个通过 HTML 创建 VR 体验的开源 WebVR 框架。通过该框架构建的 VR 场景能兼容智能手机、PC、 Oculus Rift 和 HTC Vive。

A-Frame 让代码结构化。Three.js 的代码通常是松散的，A-Frame 在 Three.js 之上构建了一个声明式的实体组件系统（entity-component-system）。另外，组件能发布并分享出去，其它开发者能以 HTML 的形式进行使用。

A-Frame 的实例 [DEMO](http://codepen.io/mozvr/pen/BjygdO/)
![aframe](/img/webvr/aframe.gif)
实例：
```html
// 引入aframe框架
<script src="./aframe.min.js"></script>
<a-scene>
  <!-- 球体 -->
  <a-sphere position="0 1 -1" radius="1" color="#EF2D5E"></a-sphere>
  <!-- 盒（此处是立方体） -->
  <a-box width="1" height="1" rotation="0 45 0" depth="1" color="#4CC3D9" position="-1 0.5 1"></a-box>	
  <!-- 圆柱 -->
  <a-cylinder position="1 0.75 1" radius="0.5" height="1.5" color="#FFC65D"></a-cylinder>
  <!-- 平面 -->
  <a-plane rotation="-90 0 0" width="4" height="4" color="#7BC8A4"></a-plane>
  <!-- sky元用于为场景添加背景图或显示360度的全景图 -->
  <a-sky color="#ECECEC"></a-sky>
  <!-- 用于指定摄像机的位置 -->
  <a-entity position="0 0 4">
    <a-camera></a-camera>
  </a-entity>
</a-scene>
```

#### 基本概念（以 Aframe v0.3 版本为参考）：
![右手坐标系](/img/webvr/coordinate.jpg)
- 该框架的三维坐标轴遵循`右手坐标系`，如上图。
- 场景的原点默认在视口底边的中点
- `position` 相当于 CSS3 中的 translate3d
- 以米为单位长度
- `height` 与 `width` 是正面的长和宽，depth表示深度（厚度）
- `rotation=”x y z”` 单位角度（°），拇指指向坐标轴的正方向，其余手指卷起来的方向就是该轴的旋转正方向。
- `color` 是材质颜色，默认是白色（#FFF）
- 在 PC 中，可通过鼠标与键盘 WSAD 进行交互

A-Frame 官网：https://aframe.io/
A-Frame Blog：https://aframe.io/blog/
Awesome A-Frame：https://github.com/aframevr/awesome-aframe

## 收集
[Beloola](https://www.beloola.com/)：Beloola 是一个基于 WebVR 的社交平台，它允许人们在同一个虚拟的空间上实时进行情感交流。
[Sketchfab](https://sketchfab.com/)：Sketchfab 是一个不需任何插件即可在 Web 页面里嵌入交互式 3D 模型的服务网站。
[Vizor](https://vizor.io/)：该网站提供了可视化编辑器，让任何人都能在浏览器上创建和分享他们的 VR 内容。
[Chrome Experiments for Virtual Reality](http://vr.chromeexperiments.com/)：Chrome 团队提供的 6 个 VR 案例。