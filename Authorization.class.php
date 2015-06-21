<?php

class Authorization
{
    /**
     * The authorization function to the specified address with the login and password
     * which returns the content of a site available after login
     *
     * @param $host
     * @param $uri
     * @param $user
     * @param $pwd
     * @return int|string
     */
    public function authorize($host, $uri, $user, $pwd)
    {
        $out = "GET $uri HTTP/1.1\r\n";
        $out .= "Host: " . $host . "\r\n";
        $out .= "Connection: Close\r\n";
        $out .= 'Authorization: Basic ' . base64_encode($user . ':' . $pwd) . "\r\n";
        $out .= "\r\n";
        if (!$sock = @fsockopen($host, 80, $errno, $errstr, 10)) {
            return 0;
        }
        fwrite($sock, $out);
        $data = '';
        while (!feof($sock)) {
            $data .= fgets($sock);
        }
        fclose($sock);
        return $data;
    }
}

