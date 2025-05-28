<?php

$roboFilePath = __DIR__ . '/robo.txt';

$roboContent = <<<EOD
User-agent: Googlebot
Disallow: /nogooglebot/

User-agent: *
Allow: /

Sitemap: https://www.example.com/sitemap.xml
EOD;

file_put_contents($roboFilePath, $roboContent);

echo "robo.txt file has been updated successfully!";
?>

<?php
//$robotsFilePath = $_SERVER['DOCUMENT_ROOT'] . '/robots.txt';

//$robotsContent = <<<EOD/
//User-agent: Googlebot
//Disallow: /nogooglebot/

//User-agent: *
//Allow: /

//Sitemap: https://www.example.com/sitemap.xml
//EOD;

//file_put_contents($robotsFilePath, $robotsContent);

//echo "robots.txt file has been updated successfully!";
?>

