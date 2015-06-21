<?php
include_once 'SiteMapGenerator.class.php';

$host = 'http://example.com';
$url = '/sitemap-data/';
$user = 'demo';
$password = '123';
$source = new Authorization();
$json = $source->authorize($host, $url, $user, $password);

if ($json) {
    $siteMapGenerator = new SiteMapGenerator(0.7, date("Y-j-n"), 'sitemap.xml', $host);

    /**
     * Write header in .xml file
     */
    $header = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    $mapContent = '<url> <loc>' . $siteMapGenerator->getSiteAddress() . '/</loc> <lastmod>' . $siteMapGenerator->getLastmod() . '</lastmod> <priority>' . $siteMapGenerator->getPriority() . '</priority></url>';
    fwrite($siteMapGenerator->getXmlPath(), $header . $mapContent);

    /**
     * Write url's in .xml file
     */
    $siteMapGenerator->parseJson($json);
    $mapContent = "</urlset>";
    fwrite($siteMapGenerator->getXmlPath(), $mapContent);
    fclose($siteMapGenerator->getXmlPath());
} else {
    echo "I can't connect!";
}


