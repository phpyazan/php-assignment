<?php

class Gorest
{
    protected $url;
    protected $id;
    public $page = 1;
    public static $BASEURL = "https://gorest.co.in/public-api/products";

    public function __construct()
    {

    }
    public function setUrl($url)
    {
        $this->url = $url;
    }
    public function row()
    {
        $this->url = self::$BASEURL . "/{$this->id}";
        return $this->curl();
    }
    public function result()
    {
        $this->url = self::$BASEURL . "?page={$this->page}";
        return $this->curl();
    }
    public function search($query)
    {
        $query = urlencode($query);
        $this->url = self::$BASEURL . "?name={$query}";
        return $this->curl();
    }
    public function setPage($page = 1)
    {
        $this->page = $page;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setPagination($meta)
    {
        $pages = array();

        for ($i = 1; $i <= $meta->pages; $i++) {
            $pages[] = array(
                "page" => $i,
                "class" => $meta->page == $i ? "page-item disabled" : "page-item",
                "url" => "/{$meta->url}/{$i}",
            );
        }

        return $pages;
    }
    public function curl()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
}