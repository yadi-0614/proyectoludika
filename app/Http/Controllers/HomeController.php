<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("security:auth");
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'like', $search . '%');
        })
            ->paginate(20)
            ->withQueryString();

        return view("home", compact('products', 'search'));
    }
}
