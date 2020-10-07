<?php
/*
 * This page displays a single event, called during the em_content() if this is an event page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 *
 * $args - the args passed onto EM_Events::output()
 */
global $EM_Category;

$termid= $EM_Category->term_id;

echo do_shortcode('[events_list scope="all" category="'.$termid.'"]<p>#_EVENTLINK will take place at #_LOCATIONLINK on #_EVENTDATES at #_EVENTTIMES</p>[/events_list]');
//em_events('all');
//var_dump($asasd);
