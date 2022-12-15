<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index() {
        
        $user = Auth::user();

        $sql_query_monthly_orders = 'SELECT COUNT(id) as orders_per_month, created_at FROM orders  WHERE user_id = ' . $user->id . ' GROUP bY MONTH(created_at), YEAR(created_at) ORDER BY created_at DESC LIMIT 12';
        $sql_query_monthly_revenue = 'SELECT  SUM(total_amount) as revenue_per_month, created_at FROM orders WHERE user_id = '  . $user->id . ' GROUP bY MONTH(created_at), YEAR(created_at) ORDER BY created_at DESC LIMIT 12';
        
        $user_orders = DB::select($sql_query_monthly_orders);
        $user_revenues = DB::select($sql_query_monthly_revenue);

        $monthly_orders = [];
        $timestamps = [];
        $monthly_revenue = [];

        foreach($user_orders as $order) {
            $monthly_orders[] = $order->orders_per_month;
            $timestamps[] = Carbon::create($order->created_at)->format('m/Y');
        }

        foreach($user_revenues as $revenue) {
            $monthly_revenue[] = $revenue->revenue_per_month;
        }

        $chart_types = ['bar', 'line', 'radar', 'polarArea', 'doughnut'];

        $data = [
            'user' => $user,
            'chart_types' => $chart_types,
            'monthly_orders' => $monthly_orders,
            'monthly_revenue' => $monthly_revenue,
            'timestamps' => $timestamps,
        ];

        return view('admin.statistics', $data);
    }
}
