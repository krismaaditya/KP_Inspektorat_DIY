<?php
echo '<h2>'.$news_item['title'].'</h2>';
echo $news_item['text'];

echo "<a href='".base_url('/user/logout')."''>LOGOUT<a>"
?>
