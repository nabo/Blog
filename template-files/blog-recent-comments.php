<?php 

/**
 * recent-comments template
 * Example template file. Show a short list of recent comments in a Blog Widget
 *
 */

	//note: in these examples, the code below has now been moved to /site/templates/blog-side-bar.inc
	//we leave this here as an example...
	
	//CALL THE MODULE - MarkupBlog
	$blogOut = $modules->get("MarkupBlog");

	$url = $config->urls->root . 'blog/comments/';

	$out =	"<h4>" . $page->title . "</h4>";

	$limit = $page->blog_quantity;

	$comments = $blogOut->findRecentComments($limit, 0, false);//false = in the sidebar, do not show pending or spam comments whether admin is logged in or not

	if(count($comments)) {

			$out .= "<ul class='links'>";

			foreach($comments as $comment) {

						$cite = htmlentities($comment->cite, ENT_QUOTES, "UTF-8");
						$date = $blogOut->formatDate($comment->created); 

						$out .= "<li><span class='date'>$date</span><br />" . 
								"<a href='{$comment->page->url}#comment{$comment->id}'>$cite &raquo; {$comment->page->title}</a>" . 
								"</li>";
			}

			$out .= "</ul>";


			$out .= "<p>" . 
				"<a class='more' href='$url'>" . __('More') . "</a>  " . 
				"<a class='rss' href='{$url}rss/'>" . __('RSS') . "</a>" . 
				"</p>";

	} 

	else {
		
			$out .= "<p>" . __('No comments yet') . "</p>";
	}

	echo $out;