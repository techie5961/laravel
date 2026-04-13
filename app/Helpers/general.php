<?php
use Illuminate\Support\Facades\DB;
// wallets
function Wallets(){
  $wallets= [
    [
        'key' => 'main_balance',
        'name' => 'Main Wallet',
        'class' => 'general'
    
    ],
    [
        'key' => 'deposit_balance',
        'name' => 'Deposit Wallet',
        'class' => 'credit'
    ],
    [
        'key' => 'withdrawal_balance',
        'name' => 'Withdrawal Wallet',
        'class' => 'debit'
    ],
    

  ];
  return json_decode(json_encode($wallets));
}

// notification amount
function TotalNotifications(){
  $total=DB::table('notifications')->where('status->admin','unread')->count();
  if($total >= 99){
    return '99+';
  }else{
    return $total;
  }
}

?>