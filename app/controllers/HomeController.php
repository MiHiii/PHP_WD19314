<?php

class Home
{
  public function index()
  {
    echo 'Home';
  }

  public function detail($id = '', $slug = '')
  {
    echo 'Id: ' . $id . ' - Slug: ' . $slug;
  }

  public function search()
  {
    $keyword = $_GET['keyword'];
    echo 'Keyword: ' . $keyword;
  }
}
