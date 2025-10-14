<?php

use App\Cms\Page;

$page = new Page();

$page->template = 'theme::templates/privacy';
$page->title = "Sunday Worship";
$page->slug  = "worship";
$page->content = '
<div class="container">
    <h1>Sunday Worship</h1>
    <p>The Wyreema Hall opens a little before 9:30 am on a Sunday for setup. We start with the Prayer of Requests at 9:30 am. Worship fellows with 3-4 acapella hymns, the Lord Supper, 2-3 more hymns and a few children\'s songs. Morning tea break for 15-20 minutes around 10:30 am. The lesson is either a bible study or sermon until 11:30 am. While the lesson is running there is a normally separate children\'s class. Closing prayer, announcements, plans for next week and pack up.</p>
    <p>Last updated: October 14th, 2025</p>
</div>
';


return $page;
