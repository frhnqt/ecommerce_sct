<?php

namespace App\Http\Controllers;
use app\Models\Categorymodel;
use App\Models\Productmodel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class User_HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexuser()
    {
        // Fetch all categories from the database
        $categories = DB::table('tbl_category')->get();

        // Fetch a limited number of products from the database (e.g., 5 products)
        $products = DB::table('tbl_product')->get();

        // Return view with categories and products
        return view('home', compact('categories', 'products'));
    }

}
