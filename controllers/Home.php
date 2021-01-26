<?php
class Home extends App
{
    public function __construct()
    {
        parent::__construct();
        $this->load_library("Gorest");
    }

    public function products()
    {
        $gorest = new Gorest();
        if ($this->uri_segment(2)) {
            $page = $this->uri_segment(2);
            $gorest->setPage($page);
        }
        $products = $gorest->result();
        $data["products"] = $products;
        $pages = isset($products->meta->pagination) ? $products->meta->pagination : array("pages" => 1, "page" => 1, "limit" => 20);
        $pages->url = "products";
        $data["pagination"] = $gorest->setPagination($pages);
        $this->view("products", $data);
    }
    public function search()
    {
        $query = $this->input_post("query");
        $page = $this->input_post("page");
        $page = $page ? $page : 1;
        $gorest = new Gorest();
        $gorest->setPage($page);
        $products = isset($query) ? $gorest->search($query) : $gorest->result();
        $viewData["products"] = $products;
        $pages = isset($products->meta->pagination) ? $products->meta->pagination : (object) array("pages" => 1, "page" => 1, "limit" => 20);
        $pages->url = "products";
        $viewData["pagination"] = $gorest->setPagination($pages);
        $data["content"] = $this->view("content", $viewData, true);
        echo json_encode($data);
    }

    public function product()
    {
        $id = $this->input_post("id");
        $gorest = new Gorest();
        $gorest->setId($id);
        $data = $gorest->row();
        echo json_encode($data);
    }
}