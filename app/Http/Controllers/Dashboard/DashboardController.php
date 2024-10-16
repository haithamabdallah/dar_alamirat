<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Modules\Brand\Models\Brand;
use Modules\Order\Models\Order;
use Modules\Product\Models\Variant;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermissions:Statistics' , ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counts = [
            'products' => Variant::count(),
            'users' => User::count(),
            'orders' => Order::count(),
            'brands' => Brand::count(),
        ];
        return view('dashboard.index' , compact('counts'));
    }


}
