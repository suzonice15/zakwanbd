<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use  Session;
use Illuminate\Support\Facades\Redirect;

use AdminHelper;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function __construct()
    {
        $this->middleware('Admin');
    }

    public function index()
    {
        $data['main'] = 'Dashboard';
        $data['active'] = 'View Dashboard';
        $status = Session::get('status');
        if (empty($status)) {
            //  return redirect('admin');
            Redirect::to('login')->send();
        }
        if ($status == 'super-admin' || $status == 'office-staff' || $status == 'editor') {
            // $data['orders']= DB::table('order_data')->select('order_total','order_status')->get();
            $today = date('Y-m-d');

            $data['affilites'] = DB::table('users_public')->count();
            $data['earning_balance'] = DB::table('users_public')->sum('earning_balance');

            $data['online_now'] = DB::table('user_active_status')
                ->where('logout_status', '=', 0)
                ->whereTime('login_time', '<=', now())  // Time column (optional)
                ->where('login_date', $today)->count();

            $data['today_visitor'] =   DB::table('affiliate_hitcounter')->where('date', $today)->count();
            $end_week = date('Y-m-d');
            $start_week = date('Y-m-d', strtotime('this week'));
            $data['last_week'] = DB::table('affiliate_hitcounter')->whereBetween('date', [$start_week, $end_week])->count();
            /// this month total visiror
            $currentMonth = date('m');
            $data['this_mount_user'] = DB::table("affiliate_hitcounter")
                ->whereRaw('MONTH(date) = ?', [$currentMonth])
                ->count();

            // total seell
            $datasell = DB::table('order_data')
                ->selectRaw('SUM(order_total) as total_order, SUM(advabced_price) as total_advance,Count(order_id) as total_count')
                ->where([
                    ['user_id', '>', 0],
                    ['order_status', '=', 'completed']
                ])
                ->first();

            $totalOrder = $datasell->total_order ?? 0;
            $totalAdvance = $datasell->total_advance ?? 0;
            $total_count = $datasell->total_count ?? 0;
            $data['total_sell'] = $totalOrder + $totalAdvance;
            $data['totalOrderCount'] = $total_count ;

            $withdrawStats = DB::table('withdraw_history')
                ->where('status', '!=', 2)
                ->selectRaw("
        SUM(CASE WHEN status = 0 THEN amount ELSE 0 END) as pending_withdraw,
        SUM(CASE WHEN status = 1 THEN amount ELSE 0 END) as paid_withdraw,
        SUM(CASE WHEN status = 3 THEN amount ELSE 0 END) as withdraw_charge
    ")
                ->first();

            // Safely access the values, fallback to 0 if null
            $pendingWithdraw = $withdrawStats ? ($withdrawStats->pending_withdraw ?? 0) : 0;
            $paidWithdraw    = $withdrawStats ? ($withdrawStats->paid_withdraw ?? 0) : 0;
            $withdrawCharge  = $withdrawStats ? ($withdrawStats->withdraw_charge ?? 0) : 0;

            $data['pendingWithdraw'] = $pendingWithdraw;
            $data['paidWithdraw'] = $paidWithdraw;
            $data['withdrawCharge'] = $withdrawCharge;
            return view('layouts.dashboard', $data);
        } else {
            $data['user'] = DB::table('users_public')->where('id', Session::get('id'))->first();
            $marketingMeterial = DB::table('marketing_metarial')
                ->where('affiliate_id', Session::get('id'))
                ->first();
            if ($marketingMeterial) {
                $data['marketingMetarialCheck'] = 1;
            } else {
                $data['marketingMetarialCheck'] = 0;
            }
            $session_id = Session::get('id');
            $data['order_count'] = DB::table('order_data')->select('order_id')
                ->where('order_status', '=', 'completed')
                ->where(function ($query) use ($session_id) {
                    return $query->where('order_from_affilite_id', $session_id)
                        ->orWhere('user_id', $session_id);
                })->count();
            $data['total_withdraw'] = DB::table('withdraw_history')
                ->where('from_user_id', Session::get('id'))
                ->where('status', '=', 1)
                ->sum('withdraw_history.amount');
            $data['totals_refer'] = DB::table('users_public')->select('id')
                ->orWhere('parent_id', Session::get('id'))
                ->count();
            $data['supend_account'] = DB::table('account_suspend')
                ->where('user_id', Session::get('id'))
                ->first();
            $product_sku = explode(',', get_option('product_code_affiliate_dashboard'));
            $data['products'] = DB::table('product')->whereIn('product.sku', $product_sku)->orderBy('top_deal', 'desc')->get();
            $data['skil_point'] = DB::table('marketing_metarial')->where('affiliate_id', Session::get('id'))->sum('skill_point');
            return view('layouts.affiliate_dashboard_1', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
