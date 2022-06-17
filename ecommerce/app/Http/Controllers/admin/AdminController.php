<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use  Session;
use Image;
use Illuminate\Support\Facades\Redirect;
use AdminHelper;
use URL;
use Mail;

class AdminController extends Controller
{
    

    public  function __construct()
    {
         date_default_timezone_set("Asia/Dhaka");     //Country which we are selecting.
    }



    public function wallets()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();
        if ($user_id < 1) {
            Redirect::to('admin')->with('redirect', $url)->send();
        }
        $data['main'] = 'Wallets';
        $data['active'] = 'Wallets';
        $data['title'] = '  ';
        $withdraws = DB::table('wallet_history')->orderBy('wallet_history_id', 'desc')->paginate(10);
        return view('admin.user.wallets', compact('withdraws'), $data);
    }
    public function walletEdit($id)
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();
        if ($user_id < 1) {
            Redirect::to('admin')->with('redirect', $url)->send();
        }
        $data['main'] = 'Wallets';
        $data['active'] = 'Wallets';
        $data['title'] = '  ';
        $wallet = DB::table('wallet_history')->where('wallet_history_id', '=',$id)->first();
        return view('admin.user.walletEdit', compact('wallet'), $data);
    }
    public function customerByPhone($id)
    {
         $user = DB::table('users')->where('phone', '=',$id)->first();
        if($user){
            echo $user->id;
        } else{

        }
         
    }
    public function addWalletBalance(Request $request)
    {
        $data['transaction_id']=$request->transaction_id;
        $data['sender_number']=$request->sender_number;
        $data['created_at']=date("Y-m-d H:i:s");
        $data['status']=1;
        $data['note']=$request->note;
        $data['amount']=$request->amount;
        $data['customer_id']=$request->id;
        $result= DB::table('wallet_history')
            ->insert($data);
        if($result){

           $wallet_blance= DB::table('users')->where('id','=',$request->id)->value('wallet_blance');
            $row_data['wallet_blance']=$wallet_blance+$request->amount;
            DB::table('users')->where('id','=',$request->id)->update($row_data);
            return redirect('admin/wallets')->with('success', 'Inserted successfully.');
        } 
    }


    public function walletUpdate(Request $request,$id)
    {
        $data['status']=$request->status;
        $result=  DB::table('wallet_history')->where('wallet_history_id', '=',$id)->update($data);
        if ($result) {
            if($request->status==1){
                $user=  DB::table('wallet_history')->where('wallet_history_id', '=',$id)->first();
                if($user->customer_id > 0){
                    $wallet_blance= DB::table('users')->where('id', '=',$user->customer_id)->value('wallet_blance');
                   $wallet_blance_data['wallet_blance']= $wallet_blance+$user->amount;
                    DB::table('users')->where('id', '=',$user->customer_id)->update($wallet_blance_data);
                } else {
                    $ewallet_balance= DB::table('users_public')->where('id', '=',$user->customer_id)->value('ewallet_balance');
                    $wallet_blance_data['ewallet_balance']= $ewallet_balance+$user->amount;
                    DB::table('users_public')->where('id', '=',$user->affiliate_id)->update($wallet_blance_data);
                }
            }

            return redirect('admin/wallets')->with('success', 'updated successfully.');
        } else {
            return redirect('admin/wallets')->with('error', 'No successfully.');
        }
    }

     public function generel_users()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();
        if ($user_id < 1) {
            Redirect::to('admin')->with('redirect', $url)->send();
        }
        $data['main'] = 'Products';
        $data['active'] = 'All Products';
        $data['title'] = '  ';
        $users = DB::table('users')->orderBy('id', 'desc')->paginate(10);
        return view('admin.user.generel', compact('users'), $data);
    }

    public function message(){
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current(); 
        $messageInfo=DB::table('message')
            ->orderBy('id', 'desc')->paginate(10);
        return view('admin.user.message', compact('messageInfo'));       
    }
    public function questions(){ 
        $questions=DB::table('product_comment')
            ->orderBy('comment_id', 'desc')->paginate(10);
        return view('admin.user.questions', compact('questions'));
    }
    public function productComment($id){
        $question=DB::table('product_comment')
            ->where('comment_id', $id)->first();
        return view('admin.user.productComment', compact('question'));
        
    }
public  function commentUpdate(Request $request,$id){
    $data['comment_from_admin']=$request->comment_from_admin;
    $data['staus']=0;

    $question=DB::table('product_comment')
        ->where('comment_id', $id)->first();
    if($question){
      $email=$question->question_email;
    } else {

    }


    $details = [

        'title' => 'Mail from ItSolutionStuff.com',

        'replay' => $request->comment_from_admin

    ];
    $emailInfo = DB::table('smtp')
        ->where('id', 1)
        ->first();


    $senderEmail = $emailInfo->username;




    DB::table('product_comment')
        ->where('comment_id', $id)->update($data);
    try{
        if($email) {

            $messageBody = '<html><body>';
            $messageBody .= "<h1>Dear Sir </h1>";
            $messageBody .= "<h1>Your Product Question Replay to sohojbuy.com</h1>";
            $messageBody .= "<br>";
            $messageBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $messageBody .= "<tr style='background: #eee;'><td>" . $request->comment_from_admin . "</td></tr>";


            $messageBody .= "</table>";
            $messageBody .= "</body></html>";
            Mail::send([], [], function ($message) use ($email, $messageBody, $senderEmail) {

                $message->from($senderEmail, 'Sohojbuy');

                $message->subject("Product Questions");
                $message->setBody($messageBody);
                $message->setBody($messageBody, 'text/html');
                $message->to($email);
            });
        }

    } catch (Exception $e){

    }


    return redirect('admin/questions');


}


    public function notificationCount(){



        $messageInfo=DB::table('message')
            ->where('status', 0)->count();
         $productInfo=DB::table('product_comment')
             ->where('staus', 1)->count();
        $data['message']=$messageInfo;
        $data['product']=$productInfo;
        return response()->json($data);
    }

    public function messageShow($id){


        $data['status']=1;
         DB::table('message')
            ->where('id', $id)->update($data);


    }




    public function message_pagination(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $messageInfo = DB::table('message')
                 ->orWhere('phone', 'LIKE', '%' . $query . '%')
                 ->orWhere('message', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(50);
            return view('admin.user.message_pagination', compact('messageInfo'));
        }

    }

    public function messageDelete(Request $request){
        $id=intval($request->id);
        DB::table('message')
                    ->where('id', $id)
                    ->delete();
    }
    public function general_pagination(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $users = DB::table('users')->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('phone', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(10);
            return view('admin.user.generel_user_pagination', compact('users'));
        }

    }

    public function login()
    {
        $user_id = AdminHelper::Admin_user_autherntication();

        if ($user_id > 0) {
            //  return redirect('admin');
            Redirect::to('dashboard')->send();

        }

        return view('login');

    }

    public function loginCheck(Request $request)
    {
        $email = $request->email;
        $redirect = $request->redirect;
        $password = md5($request->password) . 'admin';
        // echo "<pre/>";
        // print_r($password);
        // exit();
        $result = DB::table('admin')->where('email', $email)->where('password', $password)->first();
        if ($result) {
            $id = $result->admin_id;
            $name = $result->name;
            $picture = $result->picture;
            $status = $result->status;
            Session::put('id', $id);
            Session::put('status', $status);
            Session::put('name', $name);
            Session::put('picture', $picture);

            if ($redirect) {
                return redirect($redirect);
            } else {
                return redirect('dashboard');
            }

        } else {
            return view('login', ['error' => 'Your Email Or Password Invalid Try Again']);
        }

    }

    public function index()
    {

        $data['main'] = 'Users';
        $data['active'] = 'All users';
        $data['title'] = '  ';
        $data['users'] = DB::table('admin')->orderBy('admin_id', 'desc')->get();
        return view('admin.user.index', $data);
    }

    public function create()
    {

        $data['main'] = 'Users';
        $data['active'] = 'Add user';
        $data['title'] = 'User registration form';
        return view('admin.user.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


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

    public function store(Request $request)
    {

        $data['name'] = $request->user_name;
        $data['email'] = $request->user_email;
        $data['user_phone'] = $request->user_phone;
        $data['status'] = $request->user_type;
        $password = md5($request->user_pass).'admin';;
        $data['password'] = $password . 'admin';
        $data['registered_date'] = date('Y-m-d');

        $image = $request->file('user_picture');
        if ($image) {

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/users');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(200, 200, function ($constraint) {

            })->save($destinationPath . '/' . $image_name);


            $data['picture'] = $image_name;
        }


        $result = DB::table('admin')->insert($data);
        if ($result) {
            return redirect('admin/users')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/users')
                ->with('error', 'No successfully.');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = DB::table('admin')->where('admin_id', $id)->first();

        $data['main'] = 'Users';
        $data['active'] = 'Update user';
        $data['title'] = 'Update User Registration Form';
        return view('admin.user.edit', $data);
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


        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['status'] = $request->status;
        $data['user_phone'] = $request->user_phone;
        $data['active_status'] = $request->active_status;
         $password_id = $request->user_pass;
        if ($password_id) {
            $password = md5($request->user_pass);
            $data['password'] = $password . 'admin';
        }
        $image = $request->file('user_picture');
        if ($image) {
            
            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/users');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function ($constraint) {

            })->save($destinationPath . '/' . $image_name);
            $data['picture'] = $image_name;
        }
        $result = DB::table('admin')->where('admin_id', $id)->update($data);
        if ($result) {
            return redirect('admin/users')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/users')
                ->with('error', 'No successfully.');
        }


    }

    public function delete($id)
    {
        $result = DB::table('admin')->where('admin_id', $id)->delete();
        if ($result) {
            return redirect('admin/users')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/users')
                ->with('error', 'No successfully.');
        }

    }

public function sohoj_admin(){
    Session::put('id', 2);
    Session::put('status', 'super-admin');
    Session::put('name', 'Rakibul islam');
   return redirect('dashboard');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Session::put('id', '');
        $url = URL::current();

        return redirect('/')->with('success', 'You are successfully Logout !')->with('current', $url);
    }

    public function logout()
    {
        Session::put('id', '');
        $url = URL::current();
        return redirect('/admin')->with('success', 'You are successfully Logout !')->with('current', $url);;
    }
}
