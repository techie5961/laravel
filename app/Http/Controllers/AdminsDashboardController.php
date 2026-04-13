<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminsDashboardController extends Controller
{
    // login
    public function Login(){
        return view('admins.auth.login');
    }
    // dashboard
    public function DashBoard(){
        return view('admins.dashboard',[
            'total_users' => DB::table('users')->count(),
            'today_users' => DB::table('users')->whereDate('date',Carbon::now())->count(),
            'pending_withdrawals' => DB::table('transactions')->where('type','withdrawal')->where('class','debit')->where('status','pending')->sum('amount'),
            'successfull_withdrawals' => DB::table('transactions')->where('type','withdrawal')->where('class','debit')->where('status','success')->sum('amount'),
            'rejected_withdrawals' => DB::table('transactions')->where('type','withdrawal')->where('class','debit')->where('status','rejected')->sum('amount'),
            'pending_deposits' => DB::table('transactions')->where('type','deposit')->where('class','credit')->where('status','pending')->sum('amount'),
            'successfull_deposits' => DB::table('transactions')->where('type','deposit')->where('class','credit')->where('status','success')->sum('amount'),
            'rejected_deposits' => DB::table('transactions')->where('type','deposit')->where('class','credit')->where('status','rejected')->sum('amount'),


        ]);
    }
    // transactions
    public function Transactions(){
        // variables
        $transactions=DB::table('transactions');
         $total=DB::table('transactions');
       $today=DB::table('transactions')->whereDate('date',Carbon::today());
       $sum=DB::table('transactions');

// apending

        if(request()->has('type')){
            $transactions=$transactions->where('type',request('type'));
            $total=$total->where('type',request('type'));
            $today=$today->where('type',request('type'));
            $sum=$sum->where('type',request('type'));
        }
        if(request()->has('status')){
            $transactions=$transactions->where('status',request('status'));
            $total=$total->where('status',request('status'));
            $today=$today->where('status',request('status'));
            $sum=$sum->where('status',request('status'));
        }
        if(request()->has('user_id')){
            $transactions=$transactions->where('user_id',request('user_id'));
            $total=$total->where('user_id',request('user_id'));
            $today=$today->where('user_id',request('user_id'));
            $sum=$sum->where('user_id',request('user_id'));;
        }
       $transactions=$transactions->orderBy('date','desc')->paginate(10);
       $transactions->getCollection()->transform(function($each){
    $each->day=Carbon::parse($each->date)->format('M d, Y');
    $each->time=Carbon::parse($each->date)->format('H:i');
    return $each;
       });
      
       
        return view('admins.transactions',[
            'total' => $total->count(),
            'today' => $today->count(),
            'sum' => $sum->sum('amount'),
            'trx' => $transactions,
            'type' => request('type'),
            'status' => request('status') == 'success' ? 'successful' : request('status')
        ]);
    }
    // transaction receipt
    public function TransactionReceipt(){
        $trx=DB::table('transactions')->where('id',request('id'))->first();
        $trx->day=Carbon::parse($trx->date)->format('d M Y');
        $trx->time=Carbon::parse($trx->date)->format('H:i');
        $trx->user=DB::table('users')->where('id',$trx->user_id)->first();
        $trx->user->frame=Carbon::parse($trx->user->date)->diffForHumans();
        return view('admins.receipt',[
            'data' => $trx
        ]);
    }

    // all users
    public function AllUsers(){
      
        $users=DB::table('users');
        if(request()->has('status')){
            $users=$users->where('status',request('status'));
        }
        if(request()->has('type')){
            $users=$users->where('type',request('type'));
        }
        $users=$users->orderBy('date','desc')->paginate(10);
        $users->getCollection()->transform(function($each){
    $each->date_format=Carbon::parse($each->date)->format('d M Y');
    $each->frame=Carbon::parse($each->date)->diffForHumans();
    return $each;
        });
        return view('admins.users',[
            'users' => $users,
            'status' => request()->has('status') ? request('status') : 'All',
            'total_users' => DB::table('users')->count(),
            'active_users' => DB::table('users')->where('status','active')->count(),
            'today_signups' => DB::table('users')->whereDate('date',Carbon::today())->count(),
        ]);
    }
    // user 
    public function User(){
        $user=DB::table('users')->where('id',request('id'))->first();
        $user->date_format=Carbon::parse($user->date)->format('d M Y');
    $user->frame=Carbon::parse($user->date)->diffForHumans();
        return view('admins.user',[
           'data' => $user
        ]);

    }
    // site settings
    public function SiteSettings(){
        return view('admins.settings',[
            'general_settings' => json_decode(DB::table('settings')->where('key','general_settings')->first()->value ?? '{}'),
            'social_settings' => json_decode(DB::table('settings')->where('key','social_settings')->first()->value ?? '{}'),

        ]);
    }
    // notifications
    public function Notifications(){
      
    $notifications=DB::table('notifications');
    $notifications=$notifications->orderBy('date','desc')->paginate(10);
    $notifications->getCollection()->transform(function($each){
        $each->frame=Carbon::parse($each->date)->diffForHumans();
        return $each;
    });
        return view('admins.notifications',[
        'total' => DB::table('notifications')->count(),
        'read' => DB::table('notifications')->where('status->admins','read')->count(),
        'unread' => DB::table('notifications')->where('status->admins','unread')->count(),
        'notifications' => $notifications
        ]);
    }

    // logout
    public function Logout(){
       Auth::guard('admins')->logout();
       return redirect('admins/login');
    }


   
}
