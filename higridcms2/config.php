<?php
$higridcms = new \Slim\Slim(array(
        'posts.path' => HiGrid_PATH.'higridcms2/posts/',//使用markdown渲染的文件路径
         'templates.path' => HiGrid_PATH.'higridcms2/templates/',//模板路径
         'md' => new dflydev\markdown\MarkdownParser(),
         'pagination' => 4//blog首页的文章数量
        
        ));

// about page
$higridcms -> get('/aboutus', function () use ($higridcms){
        $higridcms -> render('aboutus.html');
        }
    );

// projects page
$higridcms -> get('/somepages', function () use ($higridcms){
        $higridcms -> render('somepages.html');
        }
    );

// blog index
$higridcms -> get('/', function() use ($higridcms){
         $higridcms -> redirect('/blog');
        }
    );
