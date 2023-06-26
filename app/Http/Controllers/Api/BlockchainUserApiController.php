<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BlockchainUser;
use DB;
use Carbon\Carbon;

class BlockchainUserApiController extends Controller
{
    public function blockchaninUserData(Request $request)
    {
        $input = $request->all();

    	$validator = Validator::make($input, [
            'user_address' => 'required',
            'token_sale' => 'required',
            'round' => 'required'
        ]);
 
        if ($validator->fails()) {
        	$data = [
	    		'status' => false,
	    		'message' => $validator->errors()->first()
	    	];

        	return response()->json($data, 403);
        }
        
        $add_user = new BlockchainUser();
        $add_user->user_address = $request->user_address;
        $add_user->token_sale = $request->token_sale;
        $add_user->eth_amount = $request->eth_amount;
        $add_user->usdt_amount = $request->usdt_amount;
        
        if($request->round == 1 || $request->round == '1'){
            $add_user->round_1 = 1;
        }
        else
        if($request->round == 2 || $request->round == '2'){
            $add_user->round_2 = 1;
        }
        else
        if($request->round == 3 || $request->round == '3'){
            $add_user->round_3 = 1;
        }
        else
        if($request->round == 4 || $request->round == '4'){
            $add_user->round_4 = 1;
        }
        else
        if($request->round == 5 || $request->round == '5'){
            $add_user->round_5 = 1;
        }
        
        $add_user->save();
        
        if($add_user){
            $data = [
                'status' => true,
                'message' => "blockchain user added successfully!"
            ];

            return response()->json($data, 200);
        }else{
            $data = [
                'status' => false,
                'message' => "error accur in adding user data"
            ];

            return response()->json($data, 422);
        }
    }
    
    // public function getUserData(Request $request)
    // {
    //     $users = DB::table('blockchain_users')
    //     ->selectRaw('user_address, ifnull(sum(token_sale),0) as total_token, ifnull(sum(eth_amount),0) as total_eth, ifnull(sum(usdt_amount),0) as total_usdt');
        
    //     if($request->has('filter')){
    //         if($request->filter == 'today'){
    //             $users = $users->where('created_at', '>=', Carbon::today());
    //         }
    //         else
    //         if($request->filter == 'week'){
    //             $users = $users->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    //         }
    //         else
    //         if($request->filter == 'month'){
    //             $users = $users->whereMonth('created_at',Carbon::now()->format('m'));
    //         }
    //         else
    //         if($request->filter == 'year'){
    //             $users = $users->whereYear('created_at',Carbon::now()->format('Y'));
    //         }
    //     }
        
    //     if($request->has('round')){
    //         if($request->round == 1 || $request->round == '1'){
    //             $users = $users->where('round_1', 1);
    //         }
    //         else
    //         if($request->round == 2 || $request->round == '2'){
    //             $users = $users->where('round_2', 1);
    //         }
    //         else
    //         if($request->round == 3 || $request->round == '3'){
    //             $users = $users->where('round_3', 1);
    //         }
    //         else
    //         if($request->round == 4 || $request->round == '4'){
    //             $users = $users->where('round_4', 1);
    //         }
    //         else
    //         if($request->round == 5 || $request->round == '5'){
    //             $users = $users->where('round_5', 1);
    //         }
    //     }
        
    //     $users = $users->groupBy('user_address')->get();
        
    //     if(!empty($users)){
    //         $total_token = 0;
    //         $total_eth = 0;
    //         $total_usdt = 0;
    //         foreach($users as $key => $value){
    //             $total_token = $total_token + (double)$value->total_token;
    //             $total_eth = $total_eth + (double)$value->total_eth;
    //             $total_usdt = $total_usdt + (double)$value->total_usdt;
    //         }
            
    //         $arr = [
    //             'total_users' => count($users),
    //             'total_token_sale' => $total_token,
    //             'total_eth_amount' => $total_eth,
    //             'total_usdt_amount' => $total_usdt
    //         ];
            
    //         $data = [
    //             'status' => true,
    //             'message' => "fetch all user information successfully!",
    //             'data' => $arr
    //         ];

    //         return response()->json($data, 200);
    //     }
        
    //     // if(!empty($users)){
            
    //     // }else{
    //     //     $data = [
    //     //         'status' => false,
    //     //         'message' => "users not found"
    //     //     ];

    //     //     return response()->json($data, 404);
    //     // }

    //     // $users = DB::table('blockchain_users');
    //     // if($request->has('filter')){
    //     //     if($request->filter == 'today'){
    //     //         $users = $users->where('created_at', '>=', Carbon::today());
    //     //     }
    //     //     else
    //     //     if($request->filter == 'week'){
    //     //         $users = $users->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    //     //     }
    //     //     else
    //     //     if($request->filter == 'month'){
    //     //         $users = $users->whereMonth('created_at',Carbon::now()->format('m'));
    //     //     }
    //     //     else
    //     //     if($request->filter == 'year'){
    //     //         $users = $users->whereYear('created_at',Carbon::now()->format('Y'));
    //     //     }
    //     // }
    //     // $users = $users->get();

    //     // if(!empty($users)){
    //     //     $user_arr = [];
            
    //     //     foreach($users as $key => $value){
    //     //         if(!in_array($value->user_address, $user_arr)){
    //     //             array_push($user_arr, $value->user_address);
    //     //         }
    //     //     }
            
    //     //     if(!empty($user_arr)){
    //     //         $total_token = 0;
    //     //         $total_usdt = 0;
    //     //         foreach($user_arr as $key => $value){
    //     //             $get_user = DB::table('blockchain_users')->where('user_address', $value)->get();
                    
    //     //             if($get_user){
    //     //                 foreach($get_user as $key1 => $value1){
    //     //                     if($value1->token_sale != null || $value1->token_sale != 0){
    //     //                         $total_token = $total_token + (double)$value1->token_sale;
    //     //                     }
                            
    //     //                     if($value1->usdt_amount != null || $value1->usdt_amount != 0){
    //     //                         $total_usdt = $total_usdt + (double)$value1->usdt_amount;
    //     //                     }
    //     //                 }
    //     //             }
    //     //         }
    //     //     }
            
    //     //     $arr = [
    //     //         'total_users' => count($user_arr),
    //     //         'total_token_sale' => $total_token,
    //     //         'total_usdt_amount' => $total_usdt
    //     //     ];
            
    //     //     $data = [
    //     //         'status' => true,
    //     //         'message' => "fetch all users successfully!",
    //     //         'data' => $arr
    //     //     ];

    //     //     return response()->json($data, 200);
    //     // }else{
    //     //     $data = [
    //     //         'status' => false,
    //     //         'message' => "users not found"
    //     //     ];

    //     //     return response()->json($data, 404);
    //     // }
    // }
    
    public function getUserData(Request $request)
    {
        $users = DB::table('blockchain_users')
        ->selectRaw('user_address, ifnull(sum(token_sale),0) as total_token, ifnull(sum(eth_amount),0) as total_eth, ifnull(sum(usdt_amount),0) as total_usdt');
        
        if($request->has('filter')){
            if($request->filter == 'today'){
                $users = $users->where('created_at', '>=', Carbon::today());
            }
            else
            if($request->filter == 'week'){
                $users = $users->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            else
            if($request->filter == 'month'){
                $users = $users->whereMonth('created_at',Carbon::now()->format('m'));
            }
            else
            if($request->filter == 'year'){
                $users = $users->whereYear('created_at',Carbon::now()->format('Y'));
            }
        }
        
        if($request->has('round')){
            if($request->round == 1 || $request->round == '1'){
                $users = $users->where('round_1', 1);
            }
            else
            if($request->round == 2 || $request->round == '2'){
                $users = $users->where('round_2', 1);
            }
            else
            if($request->round == 3 || $request->round == '3'){
                $users = $users->where('round_3', 1);
            }
            else
            if($request->round == 4 || $request->round == '4'){
                $users = $users->where('round_4', 1);
            }
            else
            if($request->round == 5 || $request->round == '5'){
                $users = $users->where('round_5', 1);
            }
        }
        
        $users = $users->groupBy('user_address')->get();
        
        if(!empty($users)){
            $total_token = 0;
            $total_eth = 0;
            $total_usdt = 0;
            foreach($users as $key => $value){
                $total_token = $total_token + (double)$value->total_token;
                $total_eth = $total_eth + (double)$value->total_eth;
                $total_usdt = $total_usdt + (double)$value->total_usdt;
            }
            
            $arr = [
                'total_users' => count($users),
                'total_token_sale' => $total_token,
                'total_eth_amount' => $total_eth,
                'total_usdt_amount' => $total_usdt
            ];
            
            $data = [
                'status' => true,
                'message' => "fetch all user information successfully!",
                'data' => $arr
            ];

            return response()->json($data, 200);
        }
    }
}
