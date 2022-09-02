<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use  Session;
use Image;
use Illuminate\Support\Facades\Redirect;
use URL;
use Pusher\Pusher;

class AdminAffiliteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('Admin');
    }

    public function affilator_list()
    {
        $status = Session::get('status');
        if ($status == 'super-admin' || $status == 'editor' || $status == 'office-staff') {
            $data['main'] = 'Affilate';
            $data['active'] = 'Campain list';
            $data['affilates'] = DB::table('users_public')->orderBy('id', 'desc')->paginate(15);
            return view('admin.affilate.affilator_list', $data);
        } else {
            return view('login');
        }
    }

    public function affiliateActive($id)
    {
        DB::table('users_public')->where('id', $id)->update(['token' => 'ok']);
        return redirect('admin/affilator_list');

    }


    public function inactiveAllAffilate()
    {

        $month = date("m");
        $previous_month = date("m") - 1;
        $previous_year = date("Y");
        $day = date("d");

        $today = date("Y") . '-' . $month . '-' . $day;
        if ($previous_month == 0) {
            $previous_month = 12;
            $previous_year = date("Y") - 1;
        }
        if ($previous_month < 10) {
            $previous_month = '0' . $previous_month;
        }
        $previous_day = $previous_year . '-' . $previous_month . '-' . $day;

        $users = DB::table('users_public')->select('id')->orderBy('id', 'desc')->get();
        foreach ($users as $key => $user) {
            $user_row = DB::table('users_public')->where('id', '=', $user->id)->first();
            $joining_date = date_create($user_row->created);
            $today_for_minus = date_create($today);
            $diff = date_diff($joining_date, $today_for_minus);
            $day = $diff->format("%R%a");
            if ($day <= '+30') {
                DB::table('users_public')->where('id', '=', $user->id)->update(['status' => 1]);
            } else {
                $orderCount = DB::table('order_data')
                    ->where('order_status', '=', 'completed')
                    ->whereBetween('modified_time', [$previous_day, $today])
                    ->where('user_id', '=', $user->id)->count();
                if ($orderCount == 0) {
                    DB::table('users_public')->where('id', '=', $user->id)->update(['status' => 0]);
                } else {
                    DB::table('users_public')->where('id', '=', $user->id)->update(['status' => 1]);
                }
            }
        }
        return redirect()->back();

    }

    public function inactiveUser()
    {

//        $month=date("m");
//        $previous_month=date("m")-1;
//        $previous_year=date("Y");
//        $day=date("d");
//
//        $today=date("Y").'-'.$month.'-'.$day;
//        if($previous_month==0){
//            $previous_month=12;
//            $previous_year=date("Y")-1;
//        }
//        if($previous_month <10){
//            $previous_month='0'.$previous_month;
//        }
//        $previous_day=$previous_year.'-'.$previous_month.'-'.$day;
//
//
//
//
//
//        $users= DB::table('users_public')->select('id')->select('id')->get();
//        foreach ($users as $user){
//
//
//            $orderCount= DB::table('order_data')
//                ->where('order_status','=','completed')
//                ->whereBetween('order_date', [$previous_day, $today])
//                ->where('user_id','=',$user->id)->count();
//            if($orderCount==0){
//                DB::table('users_public')->where('id','=',$user->id)->update(['status'=>0]);
//            } else {
//                DB::table('users_public')->where('id','=',$user->id)->update(['status'=>1]);
//
//            }
//        }


        $data['affilates'] = DB::table('users_public')->where('status', "=", 0)->orderBy('id', 'desc')->paginate(10);
        return view('admin.affilate.inactive_affilator_list', $data);
    }

    public function inactiveAffilatorPagination(Request $request)
    {
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data['affilates'] = DB::table('users_public')
            ->where('status', "=", 0)
            ->where(function ($query_sql) use ($query) {
                return (
                $query_sql->orWhere('phone', 'LIKE', '%' . $query . '%')
                    ->orWhere('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('id', 'LIKE', '%' . $query . '%')
                    ->orWhere('email', 'LIKE', '%' . $query . '%')
                );

            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.affilate.inactive_affilator_pagination_list', $data);
    }


    public function royaltyHistory()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Royalty History';
            $data['active'] = 'Royalty History';
            $data['title'] = '  ';
            $affilates = DB::table('royalty_fund_history')
                ->join('users_public', 'royalty_fund_history.user_id', '=', 'users_public.id')
                ->orderBy('royalty_fund_history_id', 'desc')->paginate(15);
            $fund = DB::table('royalty_fund')
                ->first();
            $commision = DB::table('royalty_fund_commision')
                ->first();

            return view('admin.affilate.royaltyHistory', compact('affilates', 'fund', 'commision'), $data);
        } else {
            return view('login');
        }

    }

    public function royaltyFoundDistribution()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {

            $users = DB::table("order_data")
                ->select('user_id', 'name'
                    , DB::raw("count(order_data.user_id) as total"))
                ->join('users_public', 'users_public.id', '=', 'order_data.user_id')
                ->where('order_status', 'completed')
                ->where('status', '=', 1)
                ->whereNotIn('user_id', [1, 2])
                ->groupBy('user_id')
                ->orderBy('total', 'desc')
                ->paginate(20);

            $fund = DB::table("royalty_fund")
                ->first();
            $position = DB::table("royalty_fund_commision")
                ->first();

            $counter = 1;
            $position_amount_1 = 0;
            $position_amount_2 = 0;
            $position_amount_3 = 0;
            $position_amount_4 = 0;
            $position_amount_5 = 0;
            $position_amount_6 = 0;
            $position_amount_7 = 0;
            $position_amount_8 = 0;
            $position_amount_9 = 0;
            $position_amount_10 = 0;
            $position_amount_11 = 0;
            $position_amount_12 = 0;
            $position_amount_13 = 0;
            $position_amount_14 = 0;
            $position_amount_15 = 0;
            $position_amount_16 = 0;
            $position_amount_17 = 0;
            $position_amount_18 = 0;
            $position_amount_19 = 0;
            $position_amount_20 = 0;

            foreach ($users as $user) {

                if ($counter == 1) {
                    $position_amount_1 = ($fund->amount * $position->commistion_lavel_1) / 100;

                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_1);
                } elseif ($counter == 2) {
                    $position_amount_2 = ($fund->amount * $position->commistion_lavel_2) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_2);

                } elseif ($counter == 3) {
                    $position_amount_3 = ($fund->amount * $position->commistion_lavel_3) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_3);

                } elseif ($counter == 4) {
                    $position_amount_4 = ($fund->amount * $position->commistion_lavel_4) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_4);

                } elseif ($counter == 5) {
                    $position_amount_5 = ($fund->amount * $position->commistion_lavel_5) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_5);

                } elseif ($counter == 6) {
                    $position_amount_6 = ($fund->amount * $position->commistion_lavel_6) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_6);

                } elseif ($counter == 7) {
                    $position_amount_7 = ($fund->amount * $position->commistion_lavel_7) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_7);

                } elseif ($counter == 8) {
                    $position_amount_8 = ($fund->amount * $position->commistion_lavel_8) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_8);

                } elseif ($counter == 9) {
                    $position_amount_9 = ($fund->amount * $position->commistion_lavel_9) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_9);

                } elseif ($counter == 10) {
                    $position_amount_10 = ($fund->amount * $position->commistion_lavel_10) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_10);

                } elseif ($counter == 11) {
                    $position_amount_11 = ($fund->amount * $position->commistion_lavel_11) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_11);

                } elseif ($counter == 12) {
                    $position_amount_12 = ($fund->amount * $position->commistion_lavel_12) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_12);

                } elseif ($counter == 13) {
                    $position_amount_13 = ($fund->amount * $position->commistion_lavel_13) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_13);

                } elseif ($counter == 14) {
                    $position_amount_14 = ($fund->amount * $position->commistion_lavel_14) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_14);

                } elseif ($counter == 15) {
                    $position_amount_15 = ($fund->amount * $position->commistion_lavel_15) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_15);

                } elseif ($counter == 16) {
                    $position_amount_16 = ($fund->amount * $position->commistion_lavel_16) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_16);

                } elseif ($counter == 17) {
                    $position_amount_17 = ($fund->amount * $position->commistion_lavel_17) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_17);

                } elseif ($counter == 18) {
                    $position_amount_18 = ($fund->amount * $position->commistion_lavel_18) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_18);

                } elseif ($counter == 19) {
                    $position_amount_19 = ($fund->amount * $position->commistion_lavel_19) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_19);

                } else {
                    $position_amount_20 = ($fund->amount * $position->commistion_lavel_20) / 100;
                    $this->affilite_royalty_commision_distribution($user->user_id, $position_amount_20);

                }


                $counter++;

            }

            UpdateStatisticCommisionData($fund->amount);
            DB::table("royalty_fund")->update(['amount' => 0]);
            return redirect()->back();

        } else {
            return view('login');
        }

    }

    public function leadshipAmountDistribution()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {

            $users = DB::table("leadership_contest")
                ->orderBy('total_point', 'desc')
                ->whereNotIn('affilite_id', [1, 2])
                ->paginate(10);

            $fund = DB::table("contest_fund")
                ->first();
            $position = DB::table("context_found_commision")
                ->first();

            $counter = 1;
            $position_amount_1 = 0;
            $position_amount_2 = 0;
            $position_amount_3 = 0;
            $position_amount_4 = 0;
            $position_amount_5 = 0;
            $position_amount_6 = 0;
            $position_amount_7 = 0;
            $position_amount_8 = 0;
            $position_amount_9 = 0;
            $position_amount_10 = 0;
            $position_amount_11 = 0;

            foreach ($users as $user) {

                if ($counter == 1) {
                    $position_amount_1 = ($fund->amount * $position->commistion_lavel_1) / 100;

                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_1);
                } elseif ($counter == 2) {
                    $position_amount_2 = ($fund->amount * $position->commistion_lavel_2) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_2);

                } elseif ($counter == 3) {
                    $position_amount_3 = ($fund->amount * $position->commistion_lavel_3) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_3);

                } elseif ($counter == 4) {
                    $position_amount_4 = ($fund->amount * $position->commistion_lavel_4) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_4);

                } elseif ($counter == 5) {
                    $position_amount_5 = ($fund->amount * $position->commistion_lavel_5) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_5);

                } elseif ($counter == 6) {
                    $position_amount_6 = ($fund->amount * $position->commistion_lavel_6) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_6);

                } elseif ($counter == 7) {
                    $position_amount_7 = ($fund->amount * $position->commistion_lavel_7) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_7);

                } elseif ($counter == 8) {
                    $position_amount_8 = ($fund->amount * $position->commistion_lavel_8) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_8);

                } elseif ($counter == 9) {
                    $position_amount_9 = ($fund->amount * $position->commistion_lavel_9) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_9);

                } elseif ($counter == 10) {
                    $position_amount_10 = ($fund->amount * $position->commistion_lavel_10) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_10);

                } elseif ($counter == 11) {
                    $position_amount_11 = ($fund->amount * $position->commistion_lavel_11) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_11);

                } elseif ($counter == 12) {
                    $position_amount_12 = ($fund->amount * $position->commistion_lavel_12) / 100;
                    $this->affilite_contest_commision_distribution($user->user_id, $position_amount_12);

                } elseif ($counter == 13) {
                    $position_amount_13 = ($fund->amount * $position->commistion_lavel_13) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_13);

                } elseif ($counter == 14) {
                    $position_amount_14 = ($fund->amount * $position->commistion_lavel_14) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_14);

                } elseif ($counter == 15) {
                    $position_amount_15 = ($fund->amount * $position->commistion_lavel_15) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_15);

                } elseif ($counter == 16) {
                    $position_amount_16 = ($fund->amount * $position->commistion_lavel_16) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_16);

                } elseif ($counter == 17) {
                    $position_amount_17 = ($fund->amount * $position->commistion_lavel_17) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_17);

                } elseif ($counter == 18) {
                    $position_amount_18 = ($fund->amount * $position->commistion_lavel_18) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_18);

                } elseif ($counter == 19) {
                    $position_amount_19 = ($fund->amount * $position->commistion_lavel_19) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_19);
                } else {
                    $position_amount_20 = ($fund->amount * $position->commistion_lavel_20) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_20);
                }
                $counter++;
            }
            UpdateStatisticCommisionData($fund->amount);
            DB::table("contest_fund")->update(['amount' => 0]);
            return redirect()->back();
        } else {
            return view('login');
        }

    }


    public function leadshipAmountDistributionOfContestTwo()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {

            $users = DB::table("leadership_contest")
                ->orderBy('total_point', 'desc')
                ->whereNotIn('affilite_id', [1, 2])
                ->paginate(10);

            $fund = DB::table("contest_fund")
                ->first();
            $position = DB::table("context_found_commision")
                ->first();

            $counter = 1;
            $position_amount_1 = 0;
            $position_amount_2 = 0;
            $position_amount_3 = 0;
            $position_amount_4 = 0;
            $position_amount_5 = 0;
            $position_amount_6 = 0;
            $position_amount_7 = 0;
            $position_amount_8 = 0;
            $position_amount_9 = 0;
            $position_amount_10 = 0;
            $position_amount_11 = 0;

            foreach ($users as $user) {

                if ($counter == 1) {
                    $position_amount_1 = ($fund->amount * $position->commistion_lavel_1) / 100;

                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_1);
                } elseif ($counter == 2) {
                    $position_amount_2 = ($fund->amount * $position->commistion_lavel_2) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_2);

                } elseif ($counter == 3) {
                    $position_amount_3 = ($fund->amount * $position->commistion_lavel_3) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_3);

                } elseif ($counter == 4) {
                    $position_amount_4 = ($fund->amount * $position->commistion_lavel_4) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_4);

                } elseif ($counter == 5) {
                    $position_amount_5 = ($fund->amount * $position->commistion_lavel_5) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_5);

                } elseif ($counter == 6) {
                    $position_amount_6 = ($fund->amount * $position->commistion_lavel_6) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_6);

                } elseif ($counter == 7) {
                    $position_amount_7 = ($fund->amount * $position->commistion_lavel_7) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_7);

                } elseif ($counter == 8) {
                    $position_amount_8 = ($fund->amount * $position->commistion_lavel_8) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_8);

                } elseif ($counter == 9) {
                    $position_amount_9 = ($fund->amount * $position->commistion_lavel_9) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_9);

                } elseif ($counter == 10) {
                    $position_amount_10 = ($fund->amount * $position->commistion_lavel_10) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_10);

                } elseif ($counter == 11) {
                    $position_amount_11 = ($fund->amount * $position->commistion_lavel_11) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_11);

                } elseif ($counter == 12) {
                    $position_amount_12 = ($fund->amount * $position->commistion_lavel_12) / 100;
                    $this->affilite_contest_commision_distribution($user->user_id, $position_amount_12);


                } elseif ($counter == 13) {
                    $position_amount_13 = ($fund->amount * $position->commistion_lavel_13) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_13);


                } elseif ($counter == 14) {
                    $position_amount_14 = ($fund->amount * $position->commistion_lavel_14) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_14);


                } elseif ($counter == 15) {
                    $position_amount_15 = ($fund->amount * $position->commistion_lavel_15) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_15);


                } elseif ($counter == 16) {
                    $position_amount_16 = ($fund->amount * $position->commistion_lavel_16) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_16);


                } elseif ($counter == 17) {
                    $position_amount_17 = ($fund->amount * $position->commistion_lavel_17) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_17);


                } elseif ($counter == 18) {
                    $position_amount_18 = ($fund->amount * $position->commistion_lavel_18) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_18);


                } elseif ($counter == 19) {
                    $position_amount_19 = ($fund->amount * $position->commistion_lavel_19) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_19);

                } else {
                    $position_amount_20 = ($fund->amount * $position->commistion_lavel_20) / 100;
                    $this->affilite_contest_commision_distribution($user->affilite_id, $position_amount_20);


                }
                $counter++;
            }
            UpdateStatisticCommisionData($fund->amount);
            DB::table("contest_fund")->update(['amount' => 0]);
            return redirect()->back();
        } else {
            return view('login');
        }

    }

    public function lebelIncomeUpdate($earning_from_id, $commision)
    {
        $user = DB::table('users_public')->select('income_of_lebel_1')->where('id', $earning_from_id)->first();
        if ($user) {
            $data['income_of_lebel_1'] = $user->income_of_lebel_1 + $commision;
            DB::table('users_public')->where('id', $earning_from_id)->update($data);
        }
    }

    public function affilite_contest_commision_distribution($affilite_id, $amount)
    {


        $this->lebelIncomeUpdate($affilite_id, $amount);
        $affilite_user = DB::table('users_public')->select('earning_balance', 'life_time_earning')->where('id', $affilite_id)->first();

        if ($affilite_user) {
            $data['earning_balance'] = $affilite_user->earning_balance + $amount;
            $data['life_time_earning'] = $affilite_user->life_time_earning + $amount;
            DB::table('users_public')->where('id', $affilite_id)->update($data);

            $row_data['earning_for_id'] = $affilite_id;
            $row_data['commision'] = $amount;
            $row_data['source'] = "contest bonus";
            $row_data['earner_name'] = "contest bonus";
            $row_data['permission'] = 7;
            $row_data['date'] = date("Y-m-d H:i:s");
            DB::table('earning_history')->insert($row_data);

        }


    }


    public function affilite_royalty_commision_distribution($affilite_id, $amount)
    {
        $this->lebelIncomeUpdate($affilite_id,$amount);
        $affilite_user = DB::table('users_public')->select('earning_balance', 'life_time_earning')->where('id', $affilite_id)->first();
        if ($affilite_user) {
            $data['earning_balance'] = $affilite_user->earning_balance + $amount;
            $data['life_time_earning'] = $affilite_user->life_time_earning + $amount;
            DB::table('users_public')->where('id', $affilite_id)->update($data);

            $row_data['earning_for_id'] = $affilite_id;
            $row_data['commision'] = $amount;
            $row_data['source'] = "Royalty bonus";
            $row_data['earner_name'] = "Royalty bonus";
            $row_data['permission'] = 6;
            $row_data['date'] = date("Y-m-d H:i:s");
            DB::table('earning_history')->insert($row_data);

        }


    }


    public function royaltyCommision(Request $request)
    {

        $data['commistion_lavel_1'] = $request->commistion_lavel_1;
        $data['commistion_lavel_2'] = $request->commistion_lavel_2;
        $data['commistion_lavel_3'] = $request->commistion_lavel_3;
        $data['commistion_lavel_4'] = $request->commistion_lavel_4;
        $data['commistion_lavel_5'] = $request->commistion_lavel_5;
        $data['commistion_lavel_6'] = $request->commistion_lavel_6;
        $data['commistion_lavel_7'] = $request->commistion_lavel_7;
        $data['commistion_lavel_8'] = $request->commistion_lavel_8;
        $data['commistion_lavel_9'] = $request->commistion_lavel_9;
        $data['commistion_lavel_10'] = $request->commistion_lavel_10;
        $data['commistion_lavel_11'] = $request->commistion_lavel_11;
        $data['commistion_lavel_12'] = $request->commistion_lavel_12;
        $data['commistion_lavel_13'] = $request->commistion_lavel_13;
        $data['commistion_lavel_14'] = $request->commistion_lavel_14;
        $data['commistion_lavel_15'] = $request->commistion_lavel_15;
        $data['commistion_lavel_16'] = $request->commistion_lavel_16;
        $data['commistion_lavel_17'] = $request->commistion_lavel_17;
        $data['commistion_lavel_18'] = $request->commistion_lavel_18;
        $data['commistion_lavel_19'] = $request->commistion_lavel_19;
        $data['commistion_lavel_20'] = $request->commistion_lavel_20;
        DB::table('royalty_fund_commision')->where('id', '=', 1)->update($data);
        return redirect('admin/royalty/history');
    }

    public function contestCommision(Request $request)
    {

        $data['commistion_lavel_1'] = $request->commistion_lavel_1;
        $data['commistion_lavel_2'] = $request->commistion_lavel_2;
        $data['commistion_lavel_3'] = $request->commistion_lavel_3;
        $data['commistion_lavel_4'] = $request->commistion_lavel_4;
        $data['commistion_lavel_5'] = $request->commistion_lavel_5;
        $data['commistion_lavel_6'] = $request->commistion_lavel_6;
        $data['commistion_lavel_7'] = $request->commistion_lavel_7;
        $data['commistion_lavel_8'] = $request->commistion_lavel_8;
        $data['commistion_lavel_9'] = $request->commistion_lavel_9;
        $data['commistion_lavel_10'] = $request->commistion_lavel_10;
        $data['commistion_lavel_11'] = $request->commistion_lavel_11;
        $data['commistion_lavel_12'] = $request->commistion_lavel_12;
        $data['commistion_lavel_13'] = $request->commistion_lavel_13;
        $data['commistion_lavel_14'] = $request->commistion_lavel_14;
        $data['commistion_lavel_15'] = $request->commistion_lavel_15;
        $data['commistion_lavel_16'] = $request->commistion_lavel_16;
        $data['commistion_lavel_17'] = $request->commistion_lavel_17;
        $data['commistion_lavel_18'] = $request->commistion_lavel_18;
        $data['commistion_lavel_19'] = $request->commistion_lavel_19;
        $data['commistion_lavel_20'] = $request->commistion_lavel_20;

        DB::table('context_found_commision')->where('id', '=', 1)->update($data);
        return redirect('admin/contest/history');
    }

    public function royaltyHistoryPagination(Request $request)
    {
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);
        $affilates = DB::table('royalty_fund_history')
            ->join('users_public', 'royalty_fund_history.user_id', '=', 'users_public.id')
            ->orderBy('royalty_fund_history_id', 'desc')->paginate(15);
        return view('admin.affilate.royaltyHistoryPagination', compact('affilates'));
    }


    public function leadshipPointDistribution()
    {
        $from = get_option('contest_two_first_date');
        $to = get_option('contest_two_last_date');
        DB::table('leadership_contest')->truncate();
        $affilites = DB::table('users_public')
            ->select('id', 'name')
            ->where('status', 1)->get();
        foreach ($affilites as $affilite) {
            //  DB::table('leadership_contest')->where('affilite_id','=',$affilite->id)->delete();
            $total_affilite_count = DB::table("users_public")
                ->where('users_public.parent_id', '=', $affilite->id)
                ->count();
            $orders = DB::table("order_data")
                ->select('id', DB::raw("count(id) as total"))
                ->join('users_public', 'users_public.id', '=', 'order_data.user_id')
                ->whereBetween('order_date', [$from, $to])
                ->where('user_id', '>', '0')
                ->where('users_public.parent_id', '=', $affilite->id)
                ->where('order_status', '=', 'completed')
                ->groupBy(['users_public.id'])
                ->get();
            if ($orders) {
                $total_orders = 0;
                $active_affilite = 0;
                foreach ($orders as $order) {
                    $total_orders += $order->total;
                    if ($order->total >= 5) {
                        $active_affilite = $active_affilite + 1;
                    }
                }
            }
            if ($active_affilite == 0) {
                $active_affilite = 1;
            }
            if ($total_orders > 0) {
                $data['affilite_id'] = $affilite->id;
                $data['affilite_name'] = $affilite->name;
                $data['total_affilite'] = $total_affilite_count;
                $data['total_active_affilite'] = $active_affilite;
                $data['total_sell'] = $total_orders;
                $data['total_point'] = $active_affilite * $total_orders;
                DB::table("leadership_contest")
                    ->insert($data);
            }
        }
        return redirect('admin/contest/history')->with('success', 'Successfully updated data');
    }

    public function leadshipPointDistributionOfContestTwo()
    {
        $from = get_option('contest_first_date');
        $to = get_option('contest_last_date');
        DB::table('leadership_contest')->truncate();
        $affilites = DB::table('users_public')
            ->select('id', 'name')
            ->where('status', 1)->get();
        foreach ($affilites as $affilite) {
            //  DB::table('leadership_contest')->where('affilite_id','=',$affilite->id)->delete();
            $total_affilite_count = DB::table("users_public")
                ->where('users_public.parent_id', '=', $affilite->id)
                ->count();
            $orders = DB::table("order_data")
                ->select('id', DB::raw("count(id) as total"))
                ->join('users_public', 'users_public.id', '=', 'order_data.user_id')
                ->whereBetween('order_date', [$from, $to])
                ->where('user_id', '>', '0')
                ->where('users_public.parent_id', '=', $affilite->id)
                ->where('order_status', '=', 'completed')
                ->groupBy(['users_public.id'])
                ->get();
            if ($orders) {
                $total_orders = 0;
                $active_affilite = 0;

                $own_order = DB::table("order_data")
                    ->whereBetween('order_date', [$from, $to])
                    ->where('user_id', '>', '0')
                    ->where('order_data.user_id', '=', $affilite->id)
                    ->where('order_status', '=', 'completed')
                    ->count();
                if ($own_order >= 5) {
                    $active_affilite = 1;
                }
                foreach ($orders as $order) {
                    $total_orders += $order->total;
                    if ($order->total >= 5) {
                        $active_affilite = $active_affilite + 1;
                    }
                }
            }
            if ($active_affilite == 0) {
                $active_affilite = 1;
            }
            if ($total_orders > 0) {
                $data['affilite_id'] = $affilite->id;
                $data['affilite_name'] = $affilite->name;
                $data['total_affilite'] = $total_affilite_count;
                $data['total_active_affilite'] = $active_affilite;
                $data['total_sell'] = $total_orders;
                $data['total_point'] = $active_affilite * $total_orders;
                DB::table("leadership_contest")
                    ->insert($data);
            }
        }
        return redirect('admin/contest/history')->with('success', 'Successfully updated data');
    }


    public function contestHistory()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Contest Fund History';
            $data['active'] = 'Contest Fund  History';
            $data['title'] = '  ';
            $affilates = DB::table('contest_fund_history')
                ->join('users_public', 'contest_fund_history.user_id', '=', 'users_public.id')
                ->orderBy('fund_history_id', 'desc')->paginate(20);
            $fund = DB::table('contest_fund')
                ->first();
            $data['commision'] = DB::table('context_found_commision')
                ->first();
            return view('admin.affilate.contestHistory', compact('affilates', 'fund'), $data);
        } else {
            return view('login');
        }

    }


    public function contestHistoryPagination(Request $request)
    {
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $affilates = DB::table('contest_fund_history')
            ->join('users_public', 'contest_fund_history.user_id', '=', 'users_public.id')
            ->orderBy('fund_history_id', 'desc')->paginate(20);
        return view('admin.affilate.contestHistoryPagination', compact('affilates'));
    }

    public function affiliateComplain()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'affiliate Complain';
            $data['active'] = 'affiliate Complain';
            $data['title'] = '  ';
            $affilates = DB::table('complain')
                ->orderBy('complain_id', 'desc')->paginate(15);
            return view('admin.affilate.affiliateComplain_admin', compact('affilates'), $data);
        } else {
            return view('login');
        }

    }


    public function complainPagination(Request $request)
    {
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $affilates = DB::table('complain')
            ->orderBy('complain_id', 'desc')->paginate(15);
        return view('admin.affilate.affiliateComplain_admin_pagination', compact('affilates'));
    }

    public function complainEdit($id)
    {
        $data['main'] = 'affiliate Complain ';
        $data['active'] = 'affiliate Complain update';

        $affilate = DB::table('complain')
            ->where('complain_id', $id)->first();
        return view('admin.affilate.complainEdit', compact('affilate'), $data);
    }

    public function complainEditUpdate(Request $request, $id)
    {
        $data['affiliate_answer'] = $request->affiliate_answer;
        $data['status'] = $request->status;
        $affilate = DB::table('complain')
            ->where('complain_id', $id)->update($data);
        return redirect('/admin/affiliate/complain')->with('success', 'Updated successfully');
    }


    public function marketingMetarial()
    {
        $status = Session::get('status');
        if ($status == 'super-admin' || $status == 'office-staff' || $status == 'editor') {
            $data['main'] = 'Affiliate Material';
            $data['active'] = 'Affiliate Material';
            $data['title'] = '  ';
            $affilates = DB::table('marketing_metarial')
                ->select('marketing_id', 'name', 'id', 'email', 'phone', 'marketing_metarial.status', 'marketing_metarial.created', 'metarial_name', 'metarial_value', 'affiliate_id')
                ->join('users_public', 'marketing_metarial.affiliate_id', '=', 'users_public.id')
                ->where('marketing_metarial.status', 0)
                ->orderBy('marketing_id', 'desc')->paginate(10);

            return view('admin.affilate.marketingMetarial', compact('affilates'), $data);
        } else {
            return view('login');
        }

    }


    public function marketingMetarialPagination(Request $request)
    {
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $affilates = DB::table('marketing_metarial')
            ->select('marketing_id', 'name', 'id', 'email', 'phone', 'marketing_metarial.status', 'marketing_metarial.created', 'metarial_name', 'metarial_value', 'affiliate_id')
            ->where('email', 'LIKE', '%' . $query . '%')
            ->where('marketing_metarial.status', 0)
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->orWhere('phone', 'LIKE', '%' . $query . '%')
            ->join('users_public', 'marketing_metarial.affiliate_id', '=', 'users_public.id')
            ->orderBy('marketing_id', 'desc')->paginate(10);
        return view('admin.affilate.marketingMetarialPagination', compact('affilates'));
    }

    public function singleMarketingMetarial(Request $request)
    {
        $affilite_id = $request->get('affilite_id');
        $affilate = DB::table('marketing_metarial')->where('marketing_id', '=', $affilite_id)
            ->first();

        return view('admin.affilate.singleMarketingMetarial', compact('affilate'));
    }

    public function marketingMemberUpdate(Request $request)
    {
        $marketing_id = $request->get('marketing_id');
        $data['status'] = $request->get('status');
        $data['reject_note'] = $request->get('reject_note');
        if ($request->get('status') == 1) {
            $single_row = DB::table('marketing_metarial')->where('marketing_id', '=', $marketing_id)->first();
            $metarial_name = $single_row->metarial_name;
            if ($metarial_name == 'Facebook Page') {
                $data['skill_point'] = 10;
            } else if ($metarial_name == 'Facebook Group') {
                $data['skill_point'] = 10;
            } else if ($metarial_name == 'Youtube') {
                $data['skill_point'] = 20;
            } else if ($metarial_name == 'Website') {
                $data['skill_point'] = 20;
            } else if ($metarial_name == 'Twitter') {
                $data['skill_point'] = 5;
            } else if ($metarial_name == 'instagram') {
                $data['skill_point'] = 5;
            } else if ($metarial_name == 'linkedin') {
                $data['skill_point'] = 10;
            } else if ($metarial_name == 'Likee') {
                $data['skill_point'] = 5;
            } else if ($metarial_name == 'Tiktok') {
                $data['skill_point'] = 5;
            } else if ($metarial_name == 'Jibonpata Page') {
                $data['skill_point'] = 10;
            } else if ($metarial_name == 'Jibonpata Group') {
                $data['skill_point'] = 10;
            }


        }

        $affilate = DB::table('marketing_metarial')->where('marketing_id', '=', $marketing_id)
            ->update($data);
        if ($affilate) {
            return response()->json(['success' => 'done']);
        } else {
            return response()->json(['error' => 'false']);

        }


    }


    public function adminWallet()
    {

        $data['main'] = ' Wallet History';
        $data['active'] = 'Wallet History';
        $data['title'] = '  ';
        $wallets = DB::table('wallet_history')
            ->select('wallet_history.*', 'name', 'email', 'phone')
            ->join('users_public', 'users_public.id', '=', 'wallet_history.affiliate_id')
            ->orderBy('wallet_history_id', 'desc')->paginate(15);
        return view('admin.affilate.admin_wallet_history', compact('wallets'));

    }

    public function adminWallet_pagination(Request $request)
    {

        $wallets = DB::table('wallet_history')
            ->select('wallet_history.*', 'name', 'email', 'phone')
            ->join('users_public', 'users_public.id', '=', 'wallet_history.affiliate_id')
            ->orderBy('wallet_history_id', 'desc')->paginate(15);
        return view('admin.affilate.admin_wallet_history_pagination', compact('wallets'));
    }

    public function walletShow($wallet_id)
    {

        $wallet = DB::table('wallet_history')
            ->where('wallet_history_id', '=', $wallet_id)->first();
        return view('admin.affilate.walletShow', compact('wallet'));
    }

    public function walletShowUpdate(Request $request, $wallet_id)
    {


        if ($request->status == 1) {
            $user = DB::table('users_public')->select('ewallet_balance')->where('id', $request->affiliate_id)->first();
            $beforeBlance = $user->ewallet_balance;
            $amount = $request->amount;
            $data['ewallet_balance'] = $beforeBlance + $amount;
            DB::table('users_public')->where('id', $request->affiliate_id)->update($data);
        }

        $row_data['status'] = $request->status;
        DB::table('wallet_history')
            ->where('wallet_history_id', '=', $wallet_id)->update($row_data);
        return redirect('admin/wallet');


    }


    public function product_list()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Products';
            $data['active'] = 'All Products';
            $data['title'] = '  ';
            $products = DB::table('product')->where('vendor_id', 0)->orderBy('product_id', 'desc')->paginate(10);

            return view('admin.affilate.product_list', compact('products'), $data);
        } else {
            return view('login');
        }

    }

    public function product_list_pagination(Request $request)
    {
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);
        $products = DB::table('product')->where('vendor_id', 0)->where('sku', 'LIKE', '%' . $query . '%')
            ->orWhere('product_title', 'LIKE', '%' . $query . '%')
            ->orderBy('product_id', 'desc')->paginate(10);
        return view('admin.affilate.product_list_pagination', compact('products'));
    }

    public function editProfile($id)
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['user'] = DB::table('admin')->where('admin_id', $id)->first();
            return view('admin.affilate.editProfile', $data);
        } else {
            return view('login');
        }

    }


    public function updateProfile(Request $request, $id)
    {


        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['status'] = $request->status;
        $data['user_phone'] = $request->user_phone;
        //https://zakwanbd.com/public/uploads/users/{{ $user->picture }}
        $old_picture = 'https://zakwanbd.com/public/uploads/users' . '/' . $request->old_picture;
        $password_id = $request->user_pass;
        if ($password_id) {
            $password = md5($request->user_pass);
            $data['password'] = $password . 'admin';
        }
        $image = $request->file('user_picture');
        // $image_name = time() . '.' . $image->getClientOriginalExtension();
        // $destinationPath ='https://zakwanbd.com/public/uploads/users/'.$image_name;
        // echo "<pre/>";
        // print_r($destinationPath);
        // exit();
        if ($image) {
            if (file_exists($old_picture)) {

                unlink($old_picture);
            }
            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = 'https://zakwanbd.com/public/uploads/users/' . $image_name;

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function ($constraint) {

            })->save($destinationPath);
            $data['picture'] = $image_name;
        }
        $result = DB::table('admin')->where('admin_id', $id)->update($data);
        if ($result) {
            return redirect('/dashboard')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('/dashboard')
                ->with('error', 'No successfully.');
        }


    }

    public function editProduct($id)
    {

        $data['product'] = DB::table('product')->where('product_id', $id)->first();
        $data['main'] = 'Products';
        $data['active'] = 'Update Products';
        $data['categories'] = DB::table('category')->where('parent_id', 0)->orderBy('category_id', 'ASC')->get();
        $data['product_categories'] = DB::table('product_category_relation')->where('product_id', $id)->orderBy('product_id', 'ASC')->get();


        return view('admin.affilate.editProduct', $data);
    }


    public function updateProduct(Request $request, $product_id)
    {


        date_default_timezone_set('Asia/Dhaka');

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';
        $sell_price = 0;
        $pont_price = 0;
        $product_profite = 0;
        if ($request->discount_price) {
            $sell_price = $request->discount_price;
            $pont_price = round(($sell_price * 10) / 100);
            $product_profite = $sell_price - $request->purchase_price;
        } else {
            $sell_price = $request->product_price;
            $pont_price = round(($sell_price * 10) / 100);
            $product_profite = $sell_price - $request->purchase_price;


        }


        $data['product_point'] = $pont_price;
        $data['product_profite'] = $product_profite;

        $data['product_title'] = $request->product_title;
        $data['top_deal'] = $request->hot_deal;
        $data['folder'] = $request->folder;
        $data['product_name'] = $request->product_name;
        $data['hot_product'] = $request->hot_product;
        // $data['top_deal'] = $request->top_deal;
        $data['cash_back'] = $request->cash_back;
        $data['product_price'] = $request->product_price;
        $data['purchase_price'] = $request->purchase_price;
        $data['discount_price'] = $request->discount_price;
        $data['product_specification'] = $request->product_specification;
        $data['delivery_in_dhaka'] = $request->delivery_in_dhaka;
        $data['delivery_out_dhaka'] = $request->delivery_out_dhaka;
        $data['product_description'] = $request->product_description;
        $data['product_terms'] = $request->product_terms;
        $data['sku'] = $request->sku;
        $data['product_stock'] = $request->product_stock;
        $data['product_type'] = $request->product_type;
//        $data['stock_alert']=$request->stock_alert;
        $data['vendor_id'] = 0;
        $data['product_video'] = $request->product_video;
        $data['status'] = $request->status;
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['modified_time'] = date('Y-m-d H:i:s');
        $data['seo_title'] = $request->seo_title;
        $data['seo_keywords'] = $request->seo_keywords;
        $data['seo_content'] = $request->seo_content;
        // echo "<pre/>";
        // print_r($data);
        // exit();
        if ($request->discount_price) {
            $price = $request->product_price - $request->discount_price;
            $discount = round(($price * 100) / ($request->product_price));
            $data['discount'] = $discount;
        }
        DB::table('product')->where('product_id', $product_id)->update($data);


        $featured_image_orgianal = $request->file('featured_image');
        $product_image1 = $request->file('product_image1');
        $product_image2 = $request->file('product_image2');
        $product_image3 = $request->file('product_image3');
        $product_image4 = $request->file('product_image4');
        $product_image5 = $request->file('product_image5');
        $product_image6 = $request->file('product_image6');


        if ($featured_image_orgianal) {

            // $image_name = time().'.'.$featured_image->getClientOriginalExtension();
            $featured_image = $product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($featured_image_orgianal->getRealPath());
            $resize_image->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $featured_image);

            $resize_image->resize(200, 200, function ($constraint) {

            })->save($thumb . '/' . $featured_image);

            $resize_image->resize(50, 50, function ($constraint) {

            })->save($small . '/' . $featured_image);
            $data['feasured_image'] = $featured_image;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'featured_image';
            $media_data['media_path'] = $media_path . '/' . $featured_image;
            //DB::table('media')->insert($media_data);
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'featured_image')->update($media_data);


        }
        if ($product_image1) {
            $random_number1 = rand(10, 100);
            $galary_image1 = $random_number1 . '.' . $product_image1->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image1 = Image::make($product_image1->getRealPath());
            $resize_galary_image1->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image1);
            $data['galary_image_1'] = $galary_image1;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image1;
            $media_data['media_type'] = 'galary_image_1';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_1')->update($media_data);


        }
        if ($product_image2) {
            $random_number2 = rand(10, 100);
            $galary_image2 = $random_number2 . '.' . $product_image2->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image2 = Image::make($product_image2->getRealPath());
            $resize_galary_image2->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image2);
            $data['galary_image_2'] = $galary_image2;

            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image2;
            $media_data['media_type'] = 'galary_image_2';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_2')->update($media_data);

        }
        if ($product_image3) {
            $random_number3 = rand(10, 100);
            $galary_image3 = $random_number3 . '.' . $product_image3->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image3 = Image::make($product_image3->getRealPath());
            $resize_galary_image3->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image3);
            $data['galary_image_3'] = $galary_image3;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image3;
            $media_data['media_type'] = 'galary_image_3';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_3')->update($media_data);

        }
        if ($product_image4) {
            $random_number4 = rand(10, 100);
            $galary_image4 = $random_number4 . '.' . $product_image4->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image4 = Image::make($product_image4->getRealPath());
            $resize_galary_image4->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image4);
            $data['galary_image_4'] = $galary_image4;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image4;
            $media_data['media_type'] = 'galary_image_4';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_4')->update($media_data);

        }
        if ($product_image5) {
            $random_number5 = rand(10, 100);
            $galary_image5 = $random_number5 . '.' . $product_image5->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image5 = Image::make($product_image5->getRealPath());
            $resize_galary_image5->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image5);
            $data['galary_image_5'] = $galary_image5;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image5;
            $media_data['media_type'] = 'galary_image_5';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_5')->update($media_data);

        }
        if ($product_image6) {
            $random_number6 = rand(10, 100);
            $galary_image6 = $random_number6 . '.' . $product_image6->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image6 = Image::make($product_image6->getRealPath());
            $resize_galary_image6->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image6);
            $data['galary_image_6'] = $galary_image6;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image6;
            $media_data['media_type'] = 'galary_image_6';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_6')->update($media_data);

        }

        DB::table('product')->where('product_id', $product_id)->update($data);
        DB::table('product_category_relation')->where('product_id', $product_id)->delete();

        $category_id = $request->category_id;
        foreach ($category_id as $key => $cat) {
            $category_data['product_id'] = $product_id;
            $category_data['category_id'] = $cat;
            DB::table('product_category_relation')->updateOrInsert($category_data);

        }


        if ($product_id) {
            return redirect('/admin/product_list')
                ->with('success', 'Update successfully.');
        } else {
            return redirect('/admin/product_list')
                ->with('error', 'No successfully.');
        }

    }

    public function affilite_pagination(Request $request)
    {
        if ($request->ajax()) {


            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $affilates = DB::table('users_public')
                ->orWhere('phone', 'LIKE', '%' . $query . '%')
                ->orWhere('name', 'LIKE', '%' . $query . '%')
                ->orWhere('id', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(15);

            return view('admin.affilate.affilator_list_pagination', compact('affilates'));
        }

    }

    public function online_user()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Online User';
            $data['active'] = 'Online user';
            $today = date('Y-m-d');

            $data['affilates'] = DB::table('users_public')
                ->join('user_active_status', 'user_active_status.user_id', '=', 'users_public.id')
                ->where('login_date', $today)
                ->where('logout_status', '=', 0)
                ->orderBy('user_active_id', 'desc')->get();
            $data['affilates_total'] = DB::table('users_public')
                ->join('user_active_status', 'user_active_status.user_id', '=', 'users_public.id')
                ->where('login_date', $today)
                ->where('logout_status', '=', 0)
                ->orderBy('user_active_id', 'desc')
                ->count();
            return view('admin.affilate.online_user', $data);
        } else {
            return view('login');
        }


    }

    public function online_user_ajax()
    {

        $today = date('Y-m-d');

        $data['affilates'] = DB::table('users_public')->join('user_active_status', 'user_active_status.user_id', '=', 'users_public.id')->where('login_date', $today)->where('logout_status', '=', 0)->orderBy('user_active_id', 'desc')->get();
        $data['affilates_total'] = DB::table('users_public')->join('user_active_status', 'user_active_status.user_id', '=', 'users_public.id')->where('login_date', $today)->where('logout_status', '=', 0)->orderBy('user_active_id', 'desc')->count();


        return view('admin.affilate.online_user_ajax', $data);


    }

    public function online_user_ajax_total()
    {

        $today = date('Y-m-d');

        echo $affilates_total = DB::table('users_public')->join('user_active_status', 'user_active_status.user_id', '=', 'users_public.id')->where('login_date', $today)->where('logout_status', '=', 0)->orderBy('user_active_id', 'desc')->count();


    }

    public function campain_report()
    {
        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Campaign Report';
            $data['active'] = 'Campaign Report';
            $data['affilates'] = DB::table('users_public')
                ->join('product_link_info', 'product_link_info.user_id', '=', 'users_public.id')
                ->join('product', 'product.product_id', '=', 'product_link_info.product_id')
                ->select('*')
                ->orderBy('product_link_info.id', 'DESC')
                ->get();
            // echo "<pre/>";
            // print_r($data['affilates']);
            // exit();
            return view('admin.affilate.admin_campain_report', $data);
        } else {
            return view('login');
        }

    }

    public function date_wise_report(Request $request)
    {

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $data['affilates'] = DB::table('users_public')
            ->join('product_link_info', 'product_link_info.user_id', '=', 'users_public.id')
            ->join('product', 'product.product_id', '=', 'product_link_info.product_id')
            ->select('*')
            ->where('create_date', '>=', $from_date)
            ->where('create_date', '<=', $to_date)
            ->orderBy('product_link_info.id', 'DESC')
            ->get();


        return view('admin.affilate.admin_campain_report', $data);
    }


    public function single_suspend_show(Request $request)
    {
        $affilite_id = $request->get('affilite_id');
        $suspend = DB::table('account_suspend')
            ->where('user_id', $affilite_id)
            ->orderBy('account_suspend_id', 'desc')->first();


        $user = DB::table('users_public')->where('id', '=', $affilite_id)
            ->first();

        return view('admin.affilate.single_suspend_view', compact('user', 'suspend'));
    }

    public function single_suspend_save(Request $request)
    {


        // $affilite_id = $request->get('user_id');
        $data['status'] = $request->status;
        if ($request->start_date) {

            $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        } else {
            $data['end_date'] = '';
        }
        if ($request->end_date) {
            $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        } else {
            $data['end_date'] = '';
        }
        $data['user_id'] = $request->user_id;
        $data['life_time'] = $request->life_time;
        $data['message'] = $request->message;
        $account_suspend_id = DB::table('account_suspend')->where('user_id', $request->user_id)->orderBy('account_suspend_id', 'desc')->first();
        if ($account_suspend_id) {
            DB::table('account_suspend')->where('user_id', $request->user_id)->update($data);
        } else {
            DB::table('account_suspend')->insert($data);

        }


        return redirect('admin/affilator_list');
    }

    public function changedPasswordOfAffiliate(Request $request)
    {
        $user=DB::table('users_public')->where('id',$request->user_id)->first();
        if($user){
            $data['password']=md5($request->password);
            DB::table('users_public')->where('id',$request->user_id)->update($data);
            return response()->json(['success'=>'Successfully Changed']);
        }
        return response()->json(['success'=>'Failed  Changed']);

    }

    public function single_affilite_show(Request $request)
    {
        $affilite_id = $request->get('affilite_id');

        $affilate = DB::table('users_public')->where('id', '=', $affilite_id)
            ->first();
        $amount = DB::table('users_public')->where('id', '=', $affilite_id)->sum('users_public.bonus_balance');
        $commistion = DB::table('users_public')->where('id', '=', $affilite_id)->sum('users_public.earning_balance');
        $total_earn = $amount + $commistion;
        $total_withdraw = DB::table('withdraw_history')->where('from_user_id', '=', $affilite_id)->where('status', '=', 1)->sum('withdraw_history.amount');
        $user = DB::table('users_public')->where('id', '=', $affilite_id)->first();
        $total_referral = DB::table('users_public')->select('id')
            ->Where('referrer', $affilate->id)
            ->orwhere('referrer', $affilate->personal_ref_id)
            ->orWhere('parent_id', $affilate->id)
            ->orwhere('parent_id', $affilate->personal_ref_id)
            ->count();
        $referrerName = DB::table('users_public')
            ->where('id', $affilate->parent_id)
            ->first();
        $lavel = DB::table('affilite_commission_lavel')->where('user_id', $affilite_id)->where('active', '=', 1)->orderBy('commision_lavel_id', 'desc')->first();
        return view('admin.affilate.single_affilite_view', compact('affilate', 'total_earn', 'user', 'total_withdraw', 'total_referral', 'referrerName', 'lavel'));
    }

    public function Profile()
    {
        $data['main'] = 'Affilate';
        $data['active'] = 'Profile';
        $data['user'] = DB::table('users_public')->where('id', Session::get('id'))->first();
        return view('admin.affilate.profile', $data);


    }

    public function products()
    {


        $data['main'] = 'Affilate';
        $data['active'] = 'All Product';

        $data['products'] = DB::table('product')->where('status', '=', 1)->orderBy('product_id', 'desc')->paginate(12);
        $data['categories'] = DB::table('category')->orderBy('category_id', 'ASC')->get();


        return view('admin.affilate.products', $data);
    }

    public function products_pagination(Request $request)
    {

        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')->where('sku', 'LIKE', '%' . $query . '%')
                ->orWhere('product_title', 'LIKE', '%' . $query . '%')
                ->orderBy('product_id', 'desc')->paginate(12);
            return view('admin.affilate.product_pagination', compact('products'));
        }
    }

    public function product_link_id(Request $request)
    {


        $product_id = $request->get('product_id');

        $product = DB::table('product')->select('product_name')->where('product_id', $product_id)
            ->first();

        $data['product_id'] = $product_id;
        $data['user_id'] = Session::get('id');
        $data['create_date'] = date('Y-m-d h:i:s');
        $data['product_link'] = "https://zakwanbd.com/" . $product->product_name . '/' . Session::get('id');
        DB::table('product_link_info')->insert($data);
        return view('admin.affilate.product_link_id', compact('product'));


    }


    public function products_pagination_category(Request $request)
    {

        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->join('product_category_relation', 'product_category_relation.product_id', '=', 'product.product_id')->where('product_category_relation.category_id', $query)->orderBy('.product_category_relation.product_id', 'desc')->paginate(10);
            return view('admin.affilate.product_pagination', compact('products'));
        }
    }

    public function profile_store(Request $request)
    {


        $id = $request->id;
        $pass = $request->password;
        $data['name'] = $request->name;

        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['post_code'] = $request->post_code;
        $data['address'] = $request->address;
        if ($pass) {
            $data['password'] = md5($pass);
        }

        $image = $request->file('picture');
        if ($image) {

            $image_name = date("d-m-Y") . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(100, 100, function ($constraint) {

            })->save($destinationPath . '/' . $image_name);
            $data['picture'] = $image_name;
        }

        DB::table('users_public')->where('id', $id)->update($data);
        //return redirect('profile');


    }

    public function orderhistory()
    {

        $data['main'] = 'Affilate';
        $data['active'] = 'Purchase History';
        $data['orders'] = DB::table('order_data')->where('user_id', 0)->orderBy('order_id', 'desc')->paginate(10);
        return view('admin.affilate.order_history', $data);

    }


    public function orderhistory_pagination(Request $request)
    {
        if ($request->ajax()) {

//            $query = $request->get('query');
//            $query = str_replace(" ", "%", $query);

            $orders = DB::table('order_data')->where('user_id', Session::get('user_id'))->orderBy('order_id', 'desc')->paginate(10);

            return view('admin.affilate.order_history_pagination', compact('orders'));
        }

    }

    public function earnings()
    {
        $data['main'] = 'Affilate';
        $data['active'] = 'Earnings';
// Session::get('user_id')
        $data['earning_history'] = DB::table('earning_history')->where('earning_for_id', 1)->orderBy('date', 'desc')->paginate(10);
        return view('admin.affilate.earnings', $data);

    }

    public function earnings_pagination(Request $request)
    {
        if ($request->ajax()) {

//            $query = $request->get('query');
//            $query = str_replace(" ", "%", $query);
            $users = DB::table('users_public')->where('parent_id', 1)->orderBy('id', 'desc')->paginate(15);

            $earning_history = DB::table('earning_history')->where('earning_for_id', 1)->orderBy('date', 'desc')->paginate(10);

            return view('admin.affilate.earnings_pagination', compact('earning_history'));
        }

    }

    public function statistics()
    {

        $data['main'] = 'Affilate';
        $data['active'] = 'Statistics';
        $data['title'] = '  ';
        // Session::get('user_id')

        $data['level_1'] = 0;
        $data['level_2'] = 0;
        $data['level_3'] = 0;
        $data['level_4'] = 0;
        $data['level_5'] = 0;

        $data['level_11'] = 0;
        $data['level_21'] = 0;
        $data['level_31'] = 0;
        $data['level_41'] = 0;
        $data['level_51'] = 0;
        $data['total_income'] = 0;
        $puser = 1;
        $earningResults = $this->earning_history_by_id($puser);
        foreach ($earningResults as $earningResult) {
            if ($earningResult->earner_position == 1) {
                $data['level_11'] += $earningResult->amount;
            } elseif ($earningResult->earner_position == 2) {
                $data['level_21'] += $earningResult->amount;
            } elseif ($earningResult->earner_position == 3) {
                $data['level_31'] += $earningResult->amount;
            } elseif ($earningResult->earner_position == 4) {
                $data['level_41'] += $earningResult->amount;
            } else {
                $data['level_51'] += $earningResult->amount;
            }

        }
        $data['total_income'] = $data['level_11'] +
            $data['level_21'] +
            $data['level_31'] +
            $data['level_41'] +
            $data['level_51'];


        for ($i = 0; $i < sizeof($this->getChild($puser)); $i++) {

            $data['level_1'] += 1;
            for ($j = 0; $j < sizeof($this->getChild($this->getChild($puser)[$i]->id)); $j++) {
                $data['level_2'] += 1;
                for ($k = 0; $k < sizeof($this->getChild($this->getChild($this->getChild($puser)[$i]->id)[$j]->id)); $k++) {
                    $data['level_3'] += 1;
                    for ($l = 0; $l < sizeof($this->getChild($this->getChild($this->getChild($this->getChild($puser)[$i]->id)[$j]->id)[$k]->id)); $l++) {
                        $data['level_4'] += 1;
                        for ($m = 0; $m < sizeof($this->getChild($this->getChild($this->getChild($this->getChild($this->getChild($puser)[$i]->id)[$j]->id)[$k]->id)[$l]->id)); $m++) {
                            $data['level_5'] += 1;
                        }
                    }
                }
            }
        }


        return view('admin.affilate.statistics', $data);
    }

    public function getChild($parent_id)
    {

        return $result = DB::table('users_public')->select('id')->where('parent_id', $parent_id)->get();

    }


    public function earning_history_by_id($id)
    {


        return $result = DB::table('earning_history')->select('amount', 'earner_position')->where('earning_for_id', $id)->get();
    }


    public function myreferrel()
    {

        $data['main'] = 'Affilate';
        $data['active'] = 'All Refferrers';
        $data['title'] = '  ';
        // c
        $data['users'] = DB::table('users_public')->where('parent_id', 1)->orderBy('id', 'desc')->paginate(15);
        return view('admin.affilate.myreferrel', $data);
    }


    public function myreferrel_pagination(Request $request)
    {
        if ($request->ajax()) {

//            $query = $request->get('query');
//            $query = str_replace(" ", "%", $query);
            $users = DB::table('users_public')->where('parent_id', 1)->orderBy('id', 'desc')->paginate(15);
            return view('admin.affilate.myreferrel_pagination', compact('users'));
        }

    }


    public function purchaseHistory()
    {

        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Purchases History';
            $data['active'] = 'All Purchases History';
            $data['title'] = '  ';
            // c
            $data['purchases'] = DB::table('order_data')
                ->select('name', 'email', 'phone', 'order_id', 'order_data.created_time', 'order_total')
                ->join('users_public', 'users_public.id', '=', 'order_data.order_from_affilite_id')
                ->orderBy('order_data.order_id', 'desc')
                ->paginate(15);
            return view('admin.affilate.admin_purchaseHistory', $data);
        } else {
            return view('login');
        }


    }

    public function purchaseHistoryPagination(Request $request)
    {
        if ($request->ajax()) {


            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $purchases = DB::table('order_data')
                ->select('name', 'email', 'phone', 'order_id', 'order_data.created_time', 'order_total')
                ->join('users_public', 'users_public.id', '=', 'order_data.order_from_affilite_id')
                ->orWhere('phone', 'LIKE', '%' . $query . '%')
                ->orWhere(function ($query_row) use ($query) {
                    return $query_row->orWhere('email', 'LIKE', '%' . $query . '%')
                        ->orWhere('name', 'LIKE', '%' . $query . '%');;
                })->orderBy('order_data.order_id', 'desc')
                ->paginate(15);
            return view('admin.affilate.admin_purchaseHistoryPagination', compact('purchases'));
        }

    }

    public function incomeHistory()
    {

        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Income History';
            $data['active'] = 'All Income History';
            $data['title'] = '  ';
            // c
            $data['incomes'] = DB::table('earning_history')
                ->select('name', 'email', 'phone', 'earning_history.commision', 'order_id', 'earning_history.date')
                ->join('users_public', 'users_public.id', '=', 'earning_history.earning_for_id')
                ->orderBy('earning_history.id', 'desc')
                ->paginate(15);
            return view('admin.affilate.admin_incomeHistory', $data);
        } else {
            return view('login');
        }


    }

    public function incomeHistoryPagination(Request $request)
    {
        if ($request->ajax()) {


            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $incomes =
                DB::table('earning_history')
                    ->select('name', 'email', 'phone', 'earning_history.commision', 'order_id', 'earning_history.date')
                    ->join('users_public', 'users_public.id', '=', 'earning_history.earning_for_id')
                    ->orWhere('phone', 'LIKE', '%' . $query . '%')
                    ->orWhere(function ($query_row) use ($query) {
                        return $query_row->orWhere('email', 'LIKE', '%' . $query . '%')
                            ->orWhere('name', 'LIKE', '%' . $query . '%');;
                    })->orderBy('earning_history.id', 'desc')
                    ->paginate(15);

            return view('admin.affilate.admin_incomeHistoryPagination', compact('incomes'));
        }

    }



 


    public function withdraw()
    {

        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Withdraw';
            $data['active'] = 'All Withdraw';
            $data['title'] = '  ';
            // c
            $data['withdraws'] = DB::table('withdraw_history')->orderBy('id', 'desc')->paginate(15);
            return view('admin.affilate.admin_withdraw', $data);
        } else {
            return view('login');
        }


    }

    public function withdraw_pagination(Request $request)
    {
        if ($request->ajax()) {


            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $withdraws = DB::table('withdraw_history')->orWhere('id', 'LIKE', '%' . $query . '%')
                ->orWhere('from_user_ac', 'LIKE', '%' . $query . '%')
                ->orWhere('to_user_ac', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(15);

            return view('admin.affilate.admin_withdraw_pagination', compact('withdraws'));
        }

    }

    public function editWithdrawStatus($id)
    {
        $withdraw_data = DB::table('withdraw_history')
            ->where('id', $id)
            ->first();
        return view('admin.affilate.editWithdrawStatus', compact('id', 'withdraw_data'));
    }

    public function updateWithdrawStatus(Request $request)
    {
        $id = $request->id;
        // $data=array();

        if ($request->status == 1) {

            $affiliate = DB::table('withdraw_history')
                ->select('from_user_id', 'amount')
                ->where('id', $id)
                ->first();
            if ($affiliate) {


                $affiliate_id = $affiliate->from_user_id;
                $affilite_user = DB::table('users_public')->select('withdraw_balance')
                    ->where('id', $affiliate_id)->first();

                if ($affilite_user) {
                    $withdraw['withdraw_balance'] = $affilite_user->withdraw_balance + $affiliate->amount;


                    $result = DB::table('users_public')
                        ->where('id', $affiliate_id)->update($withdraw);

                }

            }

        }

        $data['status'] = $request->status;
        $updateStatus = DB::table('withdraw_history')
            ->where('id', $id)
            ->update($data);
        if ($updateStatus) {
            return redirect('/admin/withdraw')->with('success', 'Status Change successfully done !');
        } else {
            return redirect('/admin/withdraw')->with('error', 'Status does not Change successfully !');

        }

    }

    public function point_pay()
    {

        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Affilite Point';
            $data['active'] = 'affilite point ';
            $data['affilates'] = DB::table('users_public')->join('point_pay', 'point_pay.user_id', '=', 'users_public.id')->get();
            return view('admin.affilate.point_pay', $data);
        } else {
            return view('login');
        }


    }

    public function super_offer()
    {

        $status = Session::get('status');
        if ($status == 'super-admin') {
            $data['main'] = 'Supper Offer';
            $data['active'] = 'All Supper Offer';
            $data['title'] = '  ';
            // c
            $data['offers'] = DB::table('super_offer')->select('name', 'phone', 'acount_type', 'sender_number', 'super_offer.user_id', 'super_offer_id', 'super_offer.status', 'transaction_id', 'amount', 'super_offer.created_at')
                ->join('users_public', 'users_public.id', '=', 'super_offer.user_id')
                ->orderBy('super_offer_id', 'desc')
                ->paginate(10);
            $data['total_user'] = DB::table('super_offer')
                ->count();
            return view('admin.affilate.admin_super_offer', $data);
        } else {
            return view('login');
        }


    }

    public function super_offerPagination(Request $request)
    {

        if ($request->ajax()) {


            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $offers = DB::table('super_offer')->select('name', 'phone', 'acount_type', 'sender_number', 'super_offer.user_id', 'super_offer_id', 'super_offer.status', 'transaction_id', 'amount', 'super_offer.created_at')
                ->join('users_public', 'users_public.id', '=', 'super_offer.user_id')
                ->orderBy('super_offer_id', 'desc')
                ->paginate(10);

            return view('admin.affilate.admin_super_offer_pagination', compact('offers'));
        }

    }

    public function super_offer_pagination(Request $request)
    {

        if ($request->ajax()) {


            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $withdraws = DB::table('withdraw_history')->orWhere('id', 'LIKE', '%' . $query . '%')
                ->orWhere('from_user_ac', 'LIKE', '%' . $query . '%')
                ->orWhere('to_user_ac', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(15);

            return view('admin.affilate.admin_withdraw_pagination', compact('withdraws'));
        }

    }

    public function super_offer_delete($id)
    {
        $offers = DB::table('super_offer')
            ->where('super_offer_id', $id)
            ->delete();
        if ($offers) {
            return back()->with('success', 'delete successfully');
        } else {
            return back()->with('success', 'delete successfully');
        }
    }

    public function super_offer_inactive($id)
    {
        $data['status'] = 0;
        $offers = DB::table('super_offer')
            ->where('super_offer_id', $id)
            ->update($data);
        if ($offers) {
            return back()->with('success', 'Updated successfully');
        } else {
            return back()->with('success', 'Updated successfully');
        }
    }

    public function super_offer_active($id)
    {
        $data['status'] = 1;
        $offers = DB::table('super_offer')
            ->where('super_offer_id', $id)
            ->update($data);
        if ($offers) {
            return back()->with('success', 'Updated successfully');
        } else {
            return back()->with('success', 'Updated successfully');
        }
    }

    public function notificationDelete()
    {
        $data['main'] = 'Notification Delete';
        $data['active'] = 'Notification Delete';
        $data['title'] = '  ';
        return view('admin.affilate.notificationDelete', $data);


    }


    public function adminLoginToAffiliate($affiliate_id)
    {

        $user = DB::table('users_public')
            ->where('id', $affiliate_id)
            ->first();


        if ($user) {
            Session::put('id', $user->id);
            Session::put('email', $user->email);
            Session::put('name', $user->name);
            Session::put('phone', $user->phone);
            Session::put('address', $user->address);
            Session::put('personal_ref_id', $user->personal_ref_id);
            Session::put('status', 'user');
            Session::put('picture', $user->picture);
            return redirect('dashboard');
        } else {
            return redirect('/login');
        }


    }

    public function message()
    {
        $data['main'] = 'Message ';
        $data['active'] = 'Message ';
        $data['affilator'] = DB::table('users_public')->select('name', 'id')->get();
        $data['title'] = '  ';
        return view('admin.affilate.message', $data);


    }

    public function withdrawNotificatioCount()
    {

        $withdrawcount = DB::table('withdraw_history')->where('status', 0)->count();
        if ($withdrawcount) {
            return $withdrawcount;
        }
    }

    public function sendMessage(Request $request)
    {
        $data['message'] = $request->message;
        $data['affiliate_id'] = $request->user_id;
        $data['created_at'] = date("Y-m-d");
        $data['status'] = 0;

        if ($request->user_id == 0) {
            $affilites = DB::table('users_public')->select('id')->get();
            foreach ($affilites as $key => $affilite) {
                // $data['affiliate_id']= $affilite->id;
                $row_data[$key]['message'] = $request->message;
                $row_data[$key]['affiliate_id'] = $affilite->id;
                $row_data[$key]['created_at'] = date("Y-m-d");
                $row_data[$key]['status'] = 0;


            }

            DB::table('message_to_affilates')->insert($row_data);


        } else {
            $result = DB::table('message_to_affilates')->insert($data);

        }


        return redirect()->back()->with('success', "Successfully send Your Message");


    }

    public function notificationDeleteAction(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->date));


        $result = DB::table("product_update_affiliate_notification")->where('created_at', '<', $date)->delete();

        return redirect('admin/product/notification/delete')->with('success', 'deleted successfully');

    }

    

    public function getCharge()
    {
        $data['main'] = 'chat ';
        $data['active'] = 'chat ';
        $data['charge'] = DB::table('service_charge')->first();
        $data['charges'] = DB::table('service_charge_history')
        ->join('users_public','service_charge_history.user_id','=','users_public.id')
        ->select('amount','created_date','phone','name','users_public.id')
        ->orderBy('service_charge_history.id','desc')->get();
        return view('admin.affilate.getCharge', $data);
    }
    
    public function getServiceChargeFromAffiliate()
    {
        
        $charge=DB::table('service_charge')->first();

        $this_month=date("Y-m");
        if( $charge){
        $system_date=$charge->charge_year.'-'.$charge->charge_month;

        if($system_date <="2022-12"){
            return redirect()->back()->with('error', "You have no permission to get charge before 2023-01-01");
        }

        if($system_date==$this_month){
            return redirect()->back()->with('error', "You Already taken Service Charge");
        }else{
         $users=DB::table('users_public')->whereNotIn('id',[1,2])->get();
         $total_amount_get=0;
         foreach( $users as $user){
            $pay_amount=50;
            $total_amount_get +=$pay_amount;
           $public_data['earning_balance']=$user->earning_balance- $pay_amount;
           DB::table('users_public')->where('id',$user->id)->update($public_data);
           $history['amount']=$pay_amount;
           $history['user_id']=$user->id;
           $history['created_date']=date('Y-m-d H:i:s');
           DB::table('service_charge_history')->insert($history);


         }
         $data_charge_info['amount']= $charge->amount+$total_amount_get;
         $data_charge_info['update_date']= date('Y-m-d H:i:s');
         $data_charge_info['charge_year']= date('Y');
         $data_charge_info['charge_month']= date('m');
          DB::table('service_charge')->update($data_charge_info); 

        }

        } 
        return redirect()->back()->with('success', "Successfully Done");
         
    }
    


    public function chat()
    {
        $data['main'] = 'chat ';
        $data['active'] = 'chat ';
        $data['users'] = DB::table('messages')
            ->where('message_status', '=', 0)
            ->orderBy('messages_id', 'desc')
            ->groupBy('affiliate_id')->get();
        return view('admin.affilate.admin_chat', $data);
    }


    public function message_status_affiliate($id)
    {
        $data['users'] = DB::table('messages')
            ->where('message_status', '=', $id)
            ->orderBy('messages_id', 'desc')
            ->groupBy('affiliate_id')->get();
        return view('admin.affilate.getChatUser', $data);

    }


    public function messageConvert($user_id, $status)
    {
        $rowData['message_status'] = $status;

        DB::table('messages')->where('affiliate_id', $user_id)->update($rowData);

    }


    public function getChatUser()
    {
        $users = DB::select("select messages.messages_id,users_public.id, users_public.name, users_public.email, picture,is_read  from users_public right  JOIN  messages ON users_public.id = messages.from 
                group by users_public.id ORDER BY created_at desc limit  100");
        foreach ($users as $key => $user) {
            $unread = DB::table('messages')->where('from', $user->id)->where('is_read', '=', 0)->count();
            $data['users'][$key]['id'] = $user->id;
            $data['users'][$key]['name'] = $user->name;
            $data['users'][$key]['email'] = $user->email;
            $data['users'][$key]['picture'] = $user->picture;
            $data['users'][$key]['unread'] = $unread;
        }
        return view('admin.affilate.getChatUser', $data);
    }

    public function chat_user($user_id)
    {
        $my_id = Session::get('id');
        $rowData['is_read'] = 1;
        $rowData['admin_id'] = $my_id;
        DB::table('messages')->where('affiliate_id', $user_id)->update($rowData);
        // Get all message from selected user
        $data['messages'] = DB::table('messages')->where('affiliate_id', '=', $user_id)->get();
        $data['admin_id'] = Session::get('id');
        return view('admin.affilate.admin_chat_message', $data);
    }

    public function sendChatMessage(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');

        $admin_id = Session::get('id');
        $affiliate_id = $request->receiver_id;
        $message = $request->message;
        $data['affiliate_id'] = $affiliate_id;
        $data['admin_id'] = $admin_id;
        $data['message'] = $message;
        $data['message_status'] = 2;
        $data['message_by'] = 'admin';
//        $data['is_read']  = ; // message will be unread when sending message
        $data['created_at'] = date("Y-m-d H:i:s"); // message will be unread when sending message


        DB::table('messages')->insert($data);

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $admin_id, 'to' => $affiliate_id]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);

    }

    public function affiliate_varification_list()
    {
        $data['affilates'] = DB::table('users_public')
            ->where('accountVarificationStatus', '=', 4)
            ->simplePaginate(50);
        return view('admin.affilate.affiliate_varification_list', $data);

    }

    public function singleAffiliate_varification_list($id)
    {
        $data['user'] = DB::table('users_public')
            ->where('id', '=', $id)
            ->first();
        return view('admin.affilate.singleAffiliate_varification_list', $data);

    }

    public function achievements()
    {

        $affiliates = $this->achivementGenerate();
        foreach ($affiliates as $affiliate) {
            $this->achivementHistory($affiliate->user_id, $affiliate->total);

        }


        $data['affiliates'] = DB::table('users_public')
            ->select('achievement.id', 'users_public.id as user_id', 'create_time', 'achievement.status', 'achivement_id', 'name', 'phone', 'address')
            ->join('achievement', 'achievement.affiliate_id', '=', 'users_public.id')->orderBy('achievement.id', 'desc')->paginate(10);

        return view('admin.affilate.achievement', $data);

    }

    public function achivementHistory($user, $total)
    {

        if ($total >= 10) {

            $checkTshart = DB::table('achievement')->where('affiliate_id', $user)->where('achivement_id', 1)->value('affiliate_id');
            if ($checkTshart == '') {
                $row_data['affiliate_id'] = $user;
                $row_data['achivement_id'] = 1;
                $row_data['status'] = 0;
                $row_data['create_time'] = date("Y-m-d H:i:s");
                DB::table('achievement')->insert($row_data);

            }
        }
        if ($total >= 100) {
            $smartWatch = DB::table('achievement')->where('affiliate_id', $user)->where('achivement_id', 2)->value('affiliate_id');
            if ($smartWatch == '') {
                $row_data['affiliate_id'] = $user;
                $row_data['achivement_id'] = 2;
                $row_data['status'] = 0;
                $row_data['create_time'] = date("Y-m-d H:i:s");
                DB::table('achievement')->insert($row_data);

            }

        }
    }

    public function achivementGenerate()
    {
        return DB::table('order_data')->select('user_id', DB::raw("count(order_id) as total"))->where('order_status', 'completed')->where('user_id', '>', 0)->groupBy('user_id')->get();
    }

    public function achivementComplete($id)
    {
        DB::table('achievement')->where('id', $id)->update(['status' => 1]);
        return redirect()->back()->with('success', 'Paid Successfully');

    }


    public function singleAffiliateVarificationUpdate(Request $request)
    {

        $data['accountVarificationStatus'] = $request->accountVarificationStatus;
        $data['reject_note'] = $request->reject_note;
        $id = $request->user_id;
        if ($request->accountVarificationStatus == 0) {
            if ($request->rejected == 1) {
                $data['nationalIdPicture'] = '';
            } elseif ($request->rejected == 2) {
                $data['addressVarifiedPicture'] = '';
            } elseif ($request->rejected == 3) {
                $data['addressVarifiedPicture'] = '';
                $data['nationalIdPicture'] = '';
            }
        }


        $result = DB::table('users_public')->where('id', '=', $id)->update($data);

        return redirect('admin/affiliate_varification_list');


    }


    public function logout()
    {
        Session::put('id', '');
        $url = URL::current();
        return redirect('/admin')->with('success', 'You are successfully Logout !')->with('current', $url);
    }


}
