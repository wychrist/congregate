<?php

use App\Cms\Page;


$post = new Page();

$post->title = "When Good is not Good Enough";
$post->subtitle = 'Worship Lesson Sunday 09-01-2022';
$post->slug = '2';
$post->intro = 'Worship Lesson "When Good is not Good Enough" presenter Jibao Mansaray Lesson from Sunday 09-01-2022';
$post->image = '/assets/paper_theme_v2/img/post/Post2.jpg';
$post->video = '<iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fwyreemadcoc%2Fvideos%2F407809451094934%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>';

// content
$post->content = '
<h2>When Good is not Good Enough</h2>
<p>Worship Lesson "When Good is not Good Enough" presenter Jibao Mansaray Lesson from Sunday 09-01-2022</p>';

// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;