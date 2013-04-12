---
layout: post
title: 	JS修改数据或者DOM结构致使ie6样式错误的方法
description:  JS修改数据或者DOM结构致使ie6或ie7样式错误的解决方法。
keywords: ie6样式错误
category :  网络技术
date :  2013-04-09
tags : [教程, 前端]
---

网站前端设计在调试IE6包括IE7的时候，经常可以遇到 **ie6样式错误**的bug，好像是`reflow`造成的。

##ie6样式错误症状

发现ie6样式错误症状常常发生在 **JS修改数据或者DOM结构** 的部分，**样式会出现错乱**，包括CSS定位错误、CSS宽高错误、CSS文字居中等问题；而且仅在 @js@ 修改后才出现问题，一般页面载入时是好的。


##ie6样式错误描述
利用调试工具在JS修改结构的容器上修改任意属性为任意值，甚至空白均可修复此bug；

甚至有时候一打开调试工具的瞬间问题就解决了，无法定位到出问题的元素。

目前还没有找到这个问题的根源，大致应该是一个浏览器渲染顺序的问题，JS修改数据的DOM部分的样式可能是它的父级容器或者祖先容器的几个样式叠加的结果。而IE6/IE7并没能重新计算改变的部分的样式与其祖先的关系，所以导致错误。

##解决办法

如果有精力的话，最好从样式本身入手，一般都会是一堆float和position相互作用的结果，但没有找到规律。

另外一种快速的解决方案是在JS修改DOM结构，或者填充数据之后加上这样一句代码：

    document.body.className = document.body.className;

这句代码可以强制reflow整个body部分，当然其中的body可以换成其他容器，但一定要包含被修改的部分。这个操作会对页面性能有一点影响，但是可以快速解决这个奇怪的bug。