---
layout: post
title: 	Jekyll变量 和 Jekyll模板语法教程
description:  Jekyll变量和Jekyll模板语法，包括全局变量、Site变量、Page变量和需要注意的内容，其中变量解释内容翻译自官方wiki。
keywords: Jekyll变量, Jekyll模板语法
category :  网络技术
date :  2013-04-01
tags : [github, jekyll, 教程, 技巧]
---
官方对 @jekyll@ 变量 和 Jekyll模板语法教程有详细的说明， @hi@ 整理并进行了翻译，更详细介绍见[静态网站生成器jekyll详解教程](/c-art-blog_jekyll.htm)。Jekyll会遍历你的站点，来寻找需要处理的文件。任何具有 `YAML` 前置数据的文件都将会被处理，每一个这样的文件，**Jekyll**都会通过Liquid模板系统使用许多可用的页面变量。下面是一个可用变量的列表。

## Jekyll 目录及一些说明

_Jekyll 标准目录树_

	_config.yml   Jekyll的配置文件
	_includes     include 文件所在的文件夹
	_layouts      模版文件夹
	_posts        自己要发布的内容
	_sites        预览时产生的文件都放在该文件夹中

##Jekyll的安装及配置

- `_includes`文件夹中所放的文件是最终要放到模版中的一些代码片段。  
- `_layouts`中放的一些模版，模版是用包含page或post内容的。Jekyll的模版使用HTML语法来写，并包含YAML Front Matter。所有的模版都可用Liquid来与网站进行交互。所的的模版都可以使用全局变量`site`和`page`，`site`变量包含该网站所有可以接触得到的内容和元数据(meta-data)，`page`变量包含的是当前渲染的page或post的所有可以接触得到的数据。  
- `_post`文件夹中放的是自己要发布的post文章。post文件的命名规则为`YEAR-MONTH-DATE-title.MARKUP`，使用`rake post`会自动将post文件命名合适。而对于page，所有放在根目录下或不以下划线开头的文件夹中有格式的文件都会被Jekyll处理成page。这里说的有格式是指文件含有YAML Front Matter。所有的post和page都要用`markdown`或者`texile`或者HTML语法来写，并可以包含`Liquid`模版的语法。还要有 YAML Front Matter (Jekyll只处理具有YAML Front Matter的文件)。YAML Front Matter必须放在文件的开头，一对`---`之间，用户可在这一对`---`间设置预先定义的变量或用户自己的数据：

	----
	变量或用户自己的数据
	----
	
##Jekyll模板全局变量
<table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th style="text-align: left"><strong>变量</strong></th>
      <th style="text-align: left"><strong>描述</strong></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: left"><code>site</code></td>
      <td style="text-align: left">全站的信息+<code>_config.yml</code>文件中的配置选项</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page</code></td>
      <td style="text-align: left">这个变量中包含YAML前置数据,另外加上两个额外的变量值:<code>url</code>和<code>content</code>。</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>content</code></td>
      <td style="text-align: left">在布局模板文件中，这里变量包含了页面的子视图。这个变量将会把渲染后的内容插入到模板文件中。这个变量不能在文章和页面文件中使用。</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>paginator</code></td>
      <td style="text-align: left">一旦<code>paginate</code>配置选项被设置了，这个变量才能被使用。</td>
    </tr>
  </tbody>
</table>

##Jekyll模板Site变量

<table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th style="text-align: left"><strong>变量</strong></th>
      <th style="text-align: left"><strong>描述</strong></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: left"><code>site.time</code></td>
      <td style="text-align: left">当前的时间(当你运行Jekyll时的时间)</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>site.posts</code></td>
      <td style="text-align: left">一个按时间逆序的文章列表。</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>site.related_posts</code></td>
      <td style="text-align: left">如果当前被处理的页面是一个文章文件，那这个变量是一个包含了最多10篇相关文章的列表。默认来说，这些相关文章是低质量但计算快的。为了得到高质量但计算慢的结果，运行Jekyll命令时可以加上<code>--lsi</code>选项。(潜在语意索引)</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>site.categories.CATEGORY</code></td>
      <td style="text-align: left">所有在<code>CATEGORY</code>分类中的文章列表</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>site.tags.TAG</code></td>
      <td style="text-align: left">所有拥有<code>TAG</code>标签的文章的列表</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>site.[CONFIGURATION_DATA]</code></td>
      <td style="text-align: left">截止<strong>0.5.2</strong>版本，所有在<code>_config.yml</code>中的数据都能够通过<code>site</code>变量调用。举例来说，如果你有一个这样的选项在你的配置文件中:<code>url: http://higrid.net</code>，那在文章和页面文件中可以这样调用<code>{ { site.url } }</code>。Jekyll并不会自动解析修改过的<code>_config.yml</code>文件，你想要启用新的设置选项，你需要重启Jekyll</td>
    </tr>
  </tbody>
</table>


##Jekyll模板Page变量

<table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th style="text-align: left"><strong>变量</strong></th>
      <th style="text-align: left"><strong>描述</strong></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: left"><code>page.content</code></td>
      <td style="text-align: left">页面中未渲染的内容</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page.title</code></td>
      <td style="text-align: left">文章的标题</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page.url</code></td>
      <td style="text-align: left">除去域名以外的URL，例子:<code>/2013/12/14/higrid-net.html</code></td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page.date</code></td>
      <td style="text-align: left">指定每一篇文章的时间，这个选项能够覆盖一篇文章中前置数据设置的时间，它的格式是这样的:<code>YYYY-MM-DD HH:MM:SS</code></td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page.id</code></td>
      <td style="text-align: left">每一篇文章的唯一标示符(在RSS中非常有用) 例子：/2008/12/14/higrid-net</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page.categories</code></td>
      <td style="text-align: left">这篇文章隶属的分类的一个列表，分类是通过在<code>_post</code>目录中的目录结构推导而来的。举例来说，在路径<code>/work/code/_posts/2008-12-24-closures.textile</code>下的文件，这个变量将会是<code>[work,code]</code>。这个变量也能在YAML前置数据中被指定。</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page.tags</code></td>
      <td style="text-align: left">这篇文章的标签的列表。这些数据能够在YAML前置数据中指定</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page.next</code></td>
      <td style="text-align: left">按时间序的下一篇文章</td>
    </tr>
    <tr>
      <td style="text-align: left"><code>page.content</code></td>
      <td style="text-align: left">按时间序的上一篇文章</td>
    </tr>
  </tbody>
</table>

**注意**:任何你自己指定的自定义前置数据都能够通过`page`调用。举例来说，如果你在页面的前置数据中设置了`custom_css: true`，那这个值可以在模板可以这样调用:`page.custom_css`





