<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang chủ', route('home'), ['icon' => 'fa-solid fa-house-chimney']);
});

// Home > Page
Breadcrumbs::for('detailPage', function ($trail, $cat, $page) {
    $trail->parent('home');
    $trail->push($cat->name);
    $trail->push($page->title);
});

// Home > Contact
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push('Liên hệ');
});

// Home > Blog[Danh-muc]
Breadcrumbs::for('catArticle', function ($trail,$cats) {
    $trail->parent('home');
    $trail->push($cats->name, route('catArticle',['slug' => $cats->alias]));
});

// Home > Blog[Danh-muc] > [Title]
Breadcrumbs::for('detailArticle', function ($trail,$article) {
    $trail->parent('home');
    $trail->push($article->category->name, route('catArticle',['slug' => $article->category->alias]));
    $trail->push($article->title, route('detailArticle',['cat_slug'=> $article->category->alias, 'slug' => $article->alias]));
});

// Home > Sản phẩm > [Category]
Breadcrumbs::for('catProduct', function ($trail, $category) {
    $trail->parent('home');
    $trail->push('Sản phẩm');
    $trail->push($category->name, route('catProduct', ['slug'=>$category->alias]));
});

// Home > [Category...] > [Product]
Breadcrumbs::for('detailProduct', function ($trail, $product) {
    $trail->parent('home');
    $trail->push($product->category->name, route('catProduct', ['slug'=>$product->category->alias]));
    $trail->push($product->name);
});

// Home > Tìm kiếm > Từ khóa: [Keyword]
Breadcrumbs::for('search', function ($trail, $keyword) {
    $trail->parent('home');
    $trail->push('Tìm kiếm');
    $trail->push('Từ khóa: '.$keyword, route('search'));
});
