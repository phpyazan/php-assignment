<?php

Router::get('', 'Home@index');
Router::get('products', 'Home@products');
Router::post('search', 'Home@search');
Router::post('product', 'Home@product');