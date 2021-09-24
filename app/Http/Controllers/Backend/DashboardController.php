<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Gate::authorize('app.dashboard.index');
        $data['userCount'] = User::count();
        $data['roleCount'] = Role::count();
        $data['productCount'] = Product::count();
        $data['stockCount'] = Stock::count();
        $data['products'] = Product::latest()->limit(5)->get();
        return view('backend.dashboard', $data);
    }
}
