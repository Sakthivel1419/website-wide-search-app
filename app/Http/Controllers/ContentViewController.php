<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Page;
use App\Models\Faq;

class ContentViewController extends Controller
{
    public function blog($id)
    {
        $blog = BlogPost::findOrFail($id);
        return view('content-details.blog', compact('blog'));
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);
        return view('content-details.product', compact('product'));
    }

    public function page($id)
    {
        $page = Page::findOrFail($id);
        return view('content-details.page', compact('page'));
    }

    public function faq($id)
    {
        $faq = Faq::findOrFail($id);
        return view('content-details.faq', compact('faq'));
    }
}
