<?php

use App\Cms\Page;

$page = new Page();

$page->template = 'theme::templates/privacy';
$page->title = "Our Mission";
$page->slug  = "mission";
$page->content = '<div class="container">
    <h1>Our Mission</h1>
    <hr></hr>
    <p>Our identity and purpose is founded on the person and work of Jesus Christ, our point of reference as revealed in the Bible, the inspired word of God. We seek to model all we say and do off the life, teachings and example of Jesus as found in the New Testament.<br>
    <br>
    Our purpose is to bring the light of Christ into communities, locally here in Wyreema and district and throughout the world as we have opportunity. We strive to create an inclusive, caring, compassionate environment, without discrimination or prejudice.</p>
    <h3>Matthew 28:18-20 - Matthew 15:14-16</h3>
    <p>There are two underlying principles from Christ and his teachings.
        <ol style="font-size: 1.3rem; font-weight: 400;">
            <li>“\'Love the Lord your God with all your heart and with all your soul and with all your mind.\'</li>
            <li>\'Love your neighbour as yourself.\' All the Law and the Prophets hang on these two commandments.” </li>
        </ol>
        <h3>Matthew 22:37-40 - Luke 10:29-37</h3>

    </p>
    <br></br>
    <p>Our mission is to care for the spiritual and physical needs of our congregation here in Wyreema, The Church, our family in Christ, as well as the local community and all mankind as we have opportunity.</p>
    <h3>Matthew 28:18-20 - Matthew 25:35-40 - Luke 10:29-37</h3>
    </div>';



return $page;
