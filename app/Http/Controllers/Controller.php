<?php

namespace App\Http\Controllers;


use App\Models\CompanyRemainBalance;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	
	public function addIntoRemainBalance($remainInfo, $type)
	{
		 
		 $lastRemainBalamnce = CompanyRemainBalance::OrderBy('id', 'desc')->first();
         $lastRemainBalamnce = !empty($lastRemainBalamnce->remain_balance) ? $lastRemainBalamnce->remain_balance : 0;
         //dd($eventAmount);
		 
		$remainInfo['created_user_id'] = !empty(auth()->id()) ? auth()->id() : 0;
		$remainInfo['event_type'] = $type;
			
		 
		if( $type =='Income' ||  $type =='Return from expense' )
		{
			
			$remainInfo['remain_balance'] = ($remainInfo['event_amount']+$lastRemainBalamnce);
		
		}
		else{
			
			$remainInfo['remain_balance'] = ($lastRemainBalamnce-$remainInfo['event_amount']);
				
		}
		
		CompanyRemainBalance::create($remainInfo);
	}
	
	
	
	
	 public function checkEditDeleteAllow($remainCheckParameter, $eventAmount, $type)
	 {
		$remainCheckAllow = CompanyRemainBalance::where($remainCheckParameter)->first();
		$rowId = $remainCheckAllow->id;
		
		$count = CompanyRemainBalance::where('id', '>', $rowId)->count();
		
		
		if( $count >0 )
		{
			return false;
			
		}else{
			
			if( !empty($eventAmount) )
			{
				
				$lastRemainBalamnce = CompanyRemainBalance::Where('id', '!=', $rowId)
									->OrderBy('id', 'desc')->first();
									
				$lastRemainBalamnce = !empty($lastRemainBalamnce->remain_balance) ? $lastRemainBalamnce->remain_balance : 0;
			   // dd($lastRemainBalamnce->toArray());
				$remainInfo['event_amount'] = $eventAmount;
				
				if($type =='Income' ||  $type =='Return from expense' )
				{
					$remainInfo['remain_balance'] = ($eventAmount+$lastRemainBalamnce);
				
				}else{
					$remainInfo['remain_balance'] = ($lastRemainBalamnce-$eventAmount);
				
				}
				
				$remain = CompanyRemainBalance::findOrFail($rowId);
				$remain->update($remainInfo);
				
				
			}else{
				
				$remainBalanceData = CompanyRemainBalance::findOrFail($rowId);
				$remainBalanceData->delete();
			
			}
			
			return true;
		}
		
	 }
	 
	 
	 
	 
	 public function checkCurrentBalance($conditions)
	 {
		$firstCond = [];
		$secondCondValue = '';
		
		if( !empty($conditions[0]))
		{
			$firstCond  = $conditions[0];
			
		}
		
		if( !empty($conditions[1]))
		{
			$secondCondValue  = $conditions[1];
			
		}
		
		
		 $remainBalance = CompanyRemainBalance::select('remain_balance')
							->where($firstCond)
							->where('event_table_row_id', '!=', $secondCondValue )
							->orderBy('id', 'DESC')->first();
		
		if( !empty( $remainBalance) )
		{
			 return $remainBalance->remain_balance;
		}else{
			
	     return 0;	
		}		 
		 
	 }
	 
	 
	 
}
