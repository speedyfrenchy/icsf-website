<?php

function run()
{
	global $mapping, $regexmap;

	$url = $_GET['original'];
	$url = trim($url);
	$url = parse_url($url, PHP_URL_PATH);

	if (array_key_exists($url, $mapping))
	{
		header('Location: <!--$SRVROOT-->' . $mapping[$url], false, 301);
		exit;
	}

	foreach ($regexmap as $rule => $rewrite)
	{
		if (preg_match($rule, $url))
		{
			$url = preg_replace($rewrite, $url);
			header('Location: <!--$SRVROOT-->' . $mapping[$url], false, 301);
			exit;
		}
	}
}

$mapping = array(
	'/frameset.php?warp=events' => '/events/',
	'/frameset.php?warp=picocon' => '/picocon/',
	'/frameset.php?warp=searchlibrary' => '/library/search.php',
	'/social/index.html' => '/social/',
	'/library/index.html' => '/library/',
	'/php/news.php' => '/social/news',
	'/php/reviews.php' => '/social/reviews',
	'/php/index_committee.php' => '/committee/',
	'/php/events_calendar.php' => '/events/',
	'/php/recent_updates.php' => '/social/news/',
	'/intros/contact_details.html' => '/committee/',
	'/social/events/picocon/' => '/picocon/',
	'/social/irc/darkerirc/darker.html' => '/social/irc.html',
	'/library/misc/location.html' => '/library/finding.html',
	'/php/library_search.php' => '/library/search.php',
	'/php/request_list.php' => '/library/request.php',
	'/library/library_newstuff/index.php' => '/library/recent.php',
);

$regexmap = array(
	':^/library/minutes/committee:' => ':^/library/minutes/committee/:/committee/minutes/:',
);

run();

header('Cache-control: no-cache', false, 410);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Page Gone - ICSF</title>
		<meta name="robots" content="noindex,follow" />
	</head>
	<body>
		<h1>Page Gone</h1>
		<p>
			This page no longer exists, and we don't currently have a
			replacement listed.
		</p>
		<p>
			You can see if this page exists on the
			<a href="/old/<?php echo $_GET['original']; ?>">archived version of
			the new site.</a>
		</p>
		<p>
			If you think this page should exist, please contact the
			<a href="mailto:techpriest@icsf.org.uk">sysadmin</a>.
		</p>
	</body>
</html>