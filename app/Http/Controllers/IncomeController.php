<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\GeneralDonation;
use App\Models\Receipt;
use Auth;
use DB;
use Hash;
use Mail;
use Input;
use Session;
use View;
use URL;
use Carbon\Carbon;

class IncomeController extends Controller
{
  public function getAllIncomeLists()
  {

                // Get Receipt History
            			$receipts = Receipt::leftjoin('devotee', 'devotee.devotee_id', '=', 'receipt.devotee_id')
            									->orderBy('receipt_id', 'desc')
                              ->whereNotNull('receipt.module')
            									->select('receipt.*','devotee.*')
            									->get();


    return view('income.income-lists', [
      'receipts' => $receipts
    ]);
  }
}
