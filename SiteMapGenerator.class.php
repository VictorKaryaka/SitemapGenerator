<?php

class SiteMapGenerator
{
    private $priority;
    private $lastmod;

    // remote site
    private $siteAddress;
    // path to .xml file
    private $xmlPath;

    /**
     * @return string
     */
    public function getSiteAddress()
    {
        return $this->siteAddress;
    }

    /**
     * @return mixed
     */
    public function getXmlPath()
    {
        return $this->xmlPath;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return bool|string
     */
    public function getLastmod()
    {
        return $this->lastmod;
    }

    function __construct($priority, $lastmod, $xmlPath, $siteAddress)
    {
        $this->priority = $priority;
        $this->lastmod = $lastmod;
        $this->xmlPath = fopen($xmlPath, 'w');
        $this->siteAddress = $siteAddress;
    }

    /**
     *
     * @param $json
     */
    public function parseJson($json)
    {
        $url = json_decode($json);
        foreach ($url as $key => $value) {
            $this->writeUrls($value, $key);
        }
    }

    /**
     * @param $urlArray
     * @param $part
     * @param null $lastPart
     */
    public function writeUrls($urlArray, $part, $lastPart = null)
    {
        if ($lastPart) {
            $lastPart .= "/" . $part;
        } else {
            $lastPart .= $part;
        }
        $link = $this->siteAddress . "/" . $lastPart . "/";
        $this->writeUrl($link);

        foreach ($urlArray as $nextPart => $value) {
            if (is_array($value)) {
                $this->writeUrls($value, $nextPart, $lastPart);
            } else {
                if (is_object($value)) {
                    foreach ($value as $objectPart => $nextValue) {
                        $objectNextPart = $lastPart . "/" . $nextPart;
                        $this->writeUrls($nextValue, $objectPart, $objectNextPart);
                    }
                } else {
                    $link = $this->siteAddress . "/" . $lastPart . "/" . $value . ".html";
                    $this->writeUrl($link);
                }
            }
        }
    }

    /**
     * @param $link
     */
    private function writeUrl($link)
    {
        $content = '<url> <loc>' . $link . '</loc> <lastmod>' . $this->lastmod . '</lastmod> <priority>' . $this->priority . '</priority> </url>';
        fwrite($this->xmlPath, $content);
    }
}


