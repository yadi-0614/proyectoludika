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
        $user = $request->user();
        $search = $request->input('search', '');

        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'like', $search . '%');
        })
            ->paginate(20)
            ->withQueryString();

        $view = $user && $user->hasRole('admin') ? 'home-admin' : 'home';

        return view($view, compact('products', 'search'));
    }

    public function admin(Request $request)
    {
        $search = $request->input('search', '');

        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'like', $search . '%');
        })
            ->paginate(20)
            ->withQueryString();

        return view('home-admin', compact('products', 'search'));
    }
}
