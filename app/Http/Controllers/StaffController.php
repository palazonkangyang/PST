<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Member;
use App\Models\Devotee;
use App\Models\User;
use App\Models\Wanyuanshenghui;
use App\Models\OptionalAddress;
use App\Models\OptionalVehicle;
use App\Models\FamilyCode;
use App\Models\SpecialRemarks;
use App\Models\GeneralDonation;
use App\Models\GeneralDonationItems;
use App\Models\Receipt;
use App\Models\FestiveEvent;
use App\Models\RelativeFriendLists;
use App\Models\Job;
use App\Models\Shengzhupai;
use Auth;
use DB;
use Hash;
use Mail;
use Input;
use Session;
use View;
use URL;
use Carbon\Carbon;

class StaffController extends Controller
{

	// getAllWanyuanshenghui
	public function postVerticalprintWanyuanshenghui(Request $request)
	{
		$input = array_except($request->all(), '_token');
		$validator = $this->validate($request, [
		'wanyuanshenghuis' => 'required'
	]);

	if ($validator && $validator->fails()) {
		return redirect()->back()
					->withErrors($validator)
					->withInput();
	}
		//get array which the data need for print type, block no and name
		$wanyuanshenghuis = Wanyuanshenghui::orderBy('type', 'asc')
												->orderBy('block_no','asc')
												->whereIn('id', $input['wanyuanshenghuis'])
												->get();

		//chinese name handling for spacing and second/third line

		for($i = 0; $i < count($wanyuanshenghuis); $i++)
		{

$lines = preg_split('/\n|\r\n?/', $wanyuanshenghuis[$i]['word_print']);
$wanyuanshenghuis[$i]['lines'] = $lines;

	}
	//use the first type to determine which format of blade needed to be use and redirect to
	if($wanyuanshenghuis[0]['type'] == '0')
	{
		return view('staff.wanyuanshenghuiprint', [
      'wanyuanshenghuis' => $wanyuanshenghuis
    ]);
	}elseif($wanyuanshenghuis[0]['type'] == '1')
{
	return view('staff.wanyuanshenghuiprint2', [
		'wanyuanshenghuis' => $wanyuanshenghuis
	]);
}elseif($wanyuanshenghuis[0]['type'] == '2')
{
	return view('staff.wanyuanshenghuiprint3', [
		'wanyuanshenghuis' => $wanyuanshenghuis
	]);
}elseif($wanyuanshenghuis[0]['type'] == '3')
{
	return view('staff.wanyuanshenghuiprint4', [
		'wanyuanshenghuis' => $wanyuanshenghuis
	]);
	}


	}

	// Edit Wanyuanshenghui
	public function getEditWanyuanshenghui($id)
	{
				$wanyuanshenghui = Wanyuanshenghui::find($id);

				if (!$wanyuanshenghui) {
						return view('errors.503');
				}

		return view('staff.edit-wanyuanshenghui', [
						'wanyuanshenghui' => $wanyuanshenghui
				]);
	}

	public function changeWanyuanshenghui(Request $request)
	{
		$input = Input::except('_token');
		$wanyuanshenghui = Wanyuanshenghui::find($input['id']);

		$wanyuanshenghui->word_print = $input['word_print'];
		$wanyuanshenghui->save();


				$request->session()->flash('success', 'wanyuanshenghui has been updated!');

				return view('staff.edit-wanyuanshenghui', [
								'wanyuanshenghui' => $wanyuanshenghui
						]);
	}



	public function getAllWanyuanshenghui()
	{
		$wanyuanshenghuis = Wanyuanshenghui::orderBy('type', 'asc')
												->orderBy('block_no','asc')
												->get();


		return view('staff.all-wanyuanshenghui', [
      'wanyuanshenghuis' => $wanyuanshenghuis
    ]);
	}



	public function getDonation()
	{
		$today = Carbon::today();

		$events = FestiveEvent::orderBy('start_at', 'asc')
							->where('start_at', '>', $today)
							->take(2)
							->get();

		return view('staff.donation', [
			'events' => $events
		]);
	}



	public function getShengzhupai()
	{
		$today = Carbon::today();

		$events = FestiveEvent::orderBy('start_at', 'asc')
							->where('start_at', '>', $today)
							->take(2)
							->get();

		return view('staff.shengzhupai', [
			'events' => $events
		]);
	}




	public function getLingwei()
	{
		$today = Carbon::today();

		$events = FestiveEvent::orderBy('start_at', 'asc')
							->where('start_at', '>', $today)
							->take(2)
							->get();

		return view('staff.lingwei', [
			'events' => $events
		]);
	}


	public function getBei()
	{
		$today = Carbon::today();

		$events = FestiveEvent::orderBy('start_at', 'asc')
							->where('start_at', '>', $today)
							->take(2)
							->get();

		return view('staff.bei', [
			'events' => $events
		]);
	}


public function getRmkbei()
	{
		$today = Carbon::today();

		$events = FestiveEvent::orderBy('start_at', 'asc')
							->where('start_at', '>', $today)
							->take(2)
							->get();

		return view('staff.rmkbei', [
			'events' => $events
		]);
	}

	public function getWanyuanshenghui()
	{
		$today = Carbon::today();

		$events = FestiveEvent::orderBy('start_at', 'asc')
							->where('start_at', '>', $today)
							->take(2)
							->get();

		return view('staff.wanyuanshenghui', [
			'events' => $events
		]);
	}

		public function getWanyuanshenghuiprint()
	{

		return view('staff.wanyuanshenghuiprint');
	}

		public function getWanyuanshenghuiprint2()
	{

		return view('staff.wanyuanshenghuiprint2');
	}

	public function getWanyuanshenghuiprint3()
	{

		return view('staff.wanyuanshenghuiprint3');
	}

	public function getWanyuanshenghuiprint4()
	{

		return view('staff.wanyuanshenghuiprint4');
	}



	public function postDonation(Request $request)
	{
		$input = array_except($request->all(), '_token');

		// Add Relative and Friend Lists
		if(isset($input["other_devotee_id"]))
		{
			// Delete relative and friend lists by focus devotee before saving
			RelativeFriendLists::where('donate_devotee_id', $input['focusdevotee_id'])->delete();

			for($i = 0; $i < count($input["other_devotee_id"]); $i++)
			{
			  $list = [
			    "donate_devotee_id" => $input['focusdevotee_id'],
			    "relative_friend_devotee_id" =>$input["other_devotee_id"][$i],
			    "year" => date('Y')
			  ];

			  RelativeFriendLists::create($list);
			}
		}

		// Modify Receipt At fields
		if(isset($input['receipt_at']))
		{
		  $input_receipt_at = str_replace('/', '-', $input['receipt_at']);
		  $receipt_at = date("Y-m-d", strtotime($input_receipt_at));
		}
		else
		{
		  $receipt_at = $input['receipt_at'];
		}

		$trans_id = GeneralDonation::all()->last()->generaldonation_id;
		$prefix = "T";
		$trans_id += 1;
		$trans_id = $prefix . $trans_id;

		$data = [
		  "trans_no" => $trans_id,
		  "description" => "Xiangyou",
		  "hjgr" => $input['hjgr'],
		  "total_amount" => $input['total_amount'],
		  "mode_payment" => $input['mode_payment'],
		  "cheque_no" => $input['cheque_no'],
		  "receipt_at" =>	$receipt_at,
		  "manualreceipt" => $input['manualreceipt'],
		  "trans_at" => Carbon::now(),
		  "focusdevotee_id" => $input['focusdevotee_id']
		];

		$general_donation = GeneralDonation::create($data);

		if($general_donation)
		{
			if($input["hjgr"] == "hj")
			{
				$same_receipt = "";
				$count = 0;

				if(isset($input["amount"]))
				{
					// save receipt for same family (1 receipt for printing)
					for($i = 0; $i < count($input["amount"]); $i++)
					{
						$amount = array_sum($input["amount"]);

						if(isset($input["amount"][$i]) && $count < 1)
						{
						  $same_xy_receipt = Receipt::all()->last()->receipt_id;
						  $prefix = "XY";
						  $same_xy_receipt += 1;
						  $same_xy_receipt = $prefix . $same_xy_receipt;

						  $receipt = [
						    "xy_receipt" => $same_xy_receipt,
						    "trans_date" => Carbon::now(),
						    "description" => "Xiangyou",
						    "amount" => $amount,
						    "generaldonation_id" => $general_donation->generaldonation_id
						  ];

						  $same_receipt = Receipt::create($receipt)->receipt_id;

							$count++;
						}

						// save receipt for same family
						if(isset($input["amount"][$i]))
						{
							// Modify fields
							$paid_till_date = str_replace('/', '-', $input['paid_till'][$i]);
							$new_paid_till_date = date("Y-m-d", strtotime($paid_till_date));

							$data = [
								"amount" => $input["amount"][$i],
								"paid_till" => $new_paid_till_date,
								"hjgr" => $input["hjgr_arr"][$i],
								"display" => $input["display"][$i],
								"trans_date" => Carbon::now(),
								"generaldonation_id" => $general_donation->generaldonation_id,
								"devotee_id" => $input["devotee_id"][$i],
								"receipt_id" => $same_receipt
							];

							GeneralDonationItems::create($data);
						}
					}
				}

				if(isset($input["other_amount"]))
				{
					// save receipt for relative and friend lists (1 receipt for printing)
					for($i = 0; $i < count($input["other_amount"]); $i++)
					{

						if(isset($input["other_amount"][$i]))
						{
						  $different_xy_receipt = Receipt::all()->last()->receipt_id;
						  $prefix = "XY";
						  $different_xy_receipt += 1;
						  $different_xy_receipt = $prefix . $different_xy_receipt;

						  $receipt = [
						    "xy_receipt" => $different_xy_receipt,
						    "trans_date" => Carbon::now(),
						    "description" => "Xiangyou",
						    "amount" => $input["other_amount"][$i],
						    "generaldonation_id" => $general_donation->generaldonation_id
						  ];

						  $different_xy_receipt = Receipt::create($receipt)->receipt_id;

							// Modify fields
			        $paid_till = $input['other_paid_till'][$i];
			        $paid_till_date = str_replace('/', '-', $paid_till);
			        $new_paid_till_date = date("Y-m-d", strtotime($paid_till_date));

			        $data = [
			          "amount" => $input["other_amount"][$i],
			          "paid_till" => $new_paid_till_date,
			          "hjgr" => $input["other_hjgr_arr"][$i],
			          "display" => $input["other_display"][$i],
			          "trans_date" => Carbon::now(),
			          "generaldonation_id" => $general_donation->generaldonation_id,
			          "devotee_id" => $input["other_devotee_id"][$i],
			          "receipt_id" => $different_xy_receipt
			        ];

			        GeneralDonationItems::create($data);
						}
					}
				}
			}

			else
			{
				$count = 0;

				if(isset($input["amount"]))
				{
					// save receipt for same family (Individual receipt for printing)
					for($i = 0; $i < count($input["amount"]); $i++)
					{
						if(isset($input["amount"][$i]))
						{
						  $individual_xy_receipt = Receipt::all()->last()->receipt_id;
						  $prefix = "XY";
						  $individual_xy_receipt += 1;
						  $individual_xy_receipt = $prefix . $individual_xy_receipt;

						  $receipt = [
						    "xy_receipt" => $individual_xy_receipt,
						    "trans_date" => Carbon::now(),
						    "description" => "Xiangyou",
						    "amount" => $input["amount"][$i],
						    "generaldonation_id" => $general_donation->generaldonation_id
						  ];

						  $individual_receipt = Receipt::create($receipt)->receipt_id;

							// Modify fields
							$paid_till_date = str_replace('/', '-', $input['paid_till'][$i]);
							$new_paid_till_date = date("Y-m-d", strtotime($paid_till_date));

							$data = [
								"amount" => $input["amount"][$i],
								"paid_till" => $new_paid_till_date,
								"hjgr" => $input["hjgr_arr"][$i],
								"display" => $input["display"][$i],
								"trans_date" => Carbon::now(),
								"generaldonation_id" => $general_donation->generaldonation_id,
								"devotee_id" => $input["devotee_id"][$i],
								"receipt_id" => $individual_receipt
							];

							GeneralDonationItems::create($data);
						}
					}
				}

				if(isset($input["other_amount"]))
				{
					// save receipt for relative and friend lists (Individual receipt for printing)
					for($i = 0; $i < count($input["other_amount"]); $i++)
					{
						if(isset($input["other_amount"][$i]))
						{
						  $individual_xy_receipt = Receipt::all()->last()->receipt_id;
						  $prefix = "XY";
						  $individual_xy_receipt += 1;
						  $individual_xy_receipt = $prefix . $individual_xy_receipt;

						  $receipt = [
						    "xy_receipt" => $individual_xy_receipt,
						    "trans_date" => Carbon::now(),
						    "description" => "Xiangyou",
						    "amount" => $input["other_amount"][$i],
						    "generaldonation_id" => $general_donation->generaldonation_id
						  ];

						  $different_xy_receipt = Receipt::create($receipt)->receipt_id;

							// Modify fields
			        $paid_till_date = str_replace('/', '-', $input['other_paid_till'][$i]);
			        $new_paid_till_date = date("Y-m-d", strtotime($paid_till_date));

			        $data = [
			          "amount" => $input["other_amount"][$i],
			          "paid_till" => $new_paid_till_date,
			          "hjgr" => $input["other_hjgr_arr"][$i],
			          "display" => $input["other_display"][$i],
			          "trans_date" => Carbon::now(),
			          "generaldonation_id" => $general_donation->generaldonation_id,
			          "devotee_id" => $input["other_devotee_id"][$i],
			          "receipt_id" => $different_xy_receipt
			        ];

			        GeneralDonationItems::create($data);
						}
					}
				}

			}
		}

		// remove session
		if(Session::has('relative_friend_lists'))
		{
		  Session::forget('relative_friend_lists');
		}

		// remove session
		if(Session::has('receipts'))
		{
		  Session::forget('receipts');
		}



		// remove session
		if(Session::has('shengzhupai_receipts'))
		{
		  Session::forget('shengzhupai_receipts');
		}
		// Get Relative and friends lists
		$relative_friend_lists = RelativeFriendLists::leftjoin('devotee', 'devotee.devotee_id', '=', 'relative_friend_lists.relative_friend_devotee_id')
															->where('donate_devotee_id', $input['focusdevotee_id'])
															->select('relative_friend_lists.*', 'devotee.chinese_name', 'devotee.guiyi_name', 'devotee.address_unit1',
															'devotee.address_unit2', 'devotee.address_street', 'devotee.address_building')
															->get();

		// Get Receipt History
		$receipts = Receipt::leftjoin('generaldonation', 'generaldonation.generaldonation_id', '=', 'receipt.generaldonation_id')
								->leftjoin('devotee', 'devotee.devotee_id', '=', 'generaldonation.focusdevotee_id')
								->where('generaldonation.focusdevotee_id', $input['focusdevotee_id'])
								->orderBy('receipt_id', 'desc')
								->select('receipt.*', 'devotee.chinese_name', 'devotee.devotee_id', 'generaldonation.manualreceipt',
								'generaldonation.hjgr as generaldonation_hjgr')
								->get();

		// store session
		if(!Session::has('relative_friend_lists'))
		{
			Session::put('relative_friend_lists', $relative_friend_lists);
		}

		// store session
    if(!Session::has('receipts'))
    {
      Session::put('receipts', $receipts);
    }

		$request->session()->flash('success', 'General Donation is successfully created.');
		return redirect()->back();
	}

	// Post Sheng Zhu Pai
	public function postShengzhupai(Request $request)
	{
		$input = array_except($request->all(), '_token');


		$data = [
		  "name" =>$input['name'],
		  "type" => $input['type'],
		  "entermastertype" => $input['entermastertype'],
		  "done" => $input['done'],
		"total"  => $input['total_amount'],
        "association_dd" => $input['association_dd'],
        "total_gst" => $input['total_gst'],
        "total_aftergst" => $input['total_aftergst'],
        "total_afterdiscount" => $input['total_afterdiscount'],
		  "focusdevotee_id" => $input['focusdevotee_id'],
		  "slot_id" => $input['slot_id']
		];

		$shengzhupai = Shengzhupai::create($data);

		  $data_receipts = [
						    "xy_receipt" => 'S'.$shengzhupai->id,
						    "trans_date" => Carbon::now(),
						    "description" => "Shengzhupai:".$input['ss_blk']."-".$input['ss_level']."-".$input['ss_number'],
						    "amount" => $input['total_amount'],
						       "module" => "shengzhupai",
						    "module_id" => $shengzhupai->id
						  ];

						  $shengzhupaireceipt= Receipt::create($data_receipts);

	// Get Receipt History
		$shengzhupai_receipts = Receipt::leftjoin('shengzhupai', 'shengzhupai.id', '=', 'receipt.module_id')
								->leftjoin('devotee', 'devotee.devotee_id', '=', 'shengzhupai.focusdevotee_id')
								->leftjoin('shengzhupaislots', 'shengzhupaislots.id', '=', 'shengzhupai.slot_id')
								->where('shengzhupai.focusdevotee_id', $input['focusdevotee_id'])
								->where('receipt.module', 'shengzhupai')
								->orderBy('receipt_id', 'desc')
								->select('receipt.*','shengzhupaislots.*', 'devotee.chinese_name', 'devotee.devotee_id')
								->get();


		 	// store session
    if(!Session::has('shengzhupai_receipts'))
    {
      Session::put('shengzhupai_receipts', $shengzhupai_receipts);
    }


		$request->session()->flash('success', '神主牌 is successfully created.');
		return redirect()->back();


    }


    // Post Ling Wei
	public function postLingwei(Request $request)
	{
		$input = array_except($request->all(), '_token');

		dd($input);
    }

      // Post Bei
	public function postBei(Request $request)
	{
		$input = array_except($request->all(), '_token');

		dd($input);
    }

     // Post Rmkbei
	public function postRmkbei(Request $request)
	{
		$input = array_except($request->all(), '_token');

		dd($input);
    }

       // Post Wanyuanshenghui
	public function postWanyuanshenghui(Request $request)
	{
		$input = array_except($request->all(), '_token');
		$data = [
			"year_report" =>$input['year_report'],
		 "type" => $input['type'],
		 "is_preancestor" => $input['is_preancestor'],
		 "temp_receiptno" => $input['temp_receiptno'],
		 "word_print"  => $input['word_print'],
				"recommend_ppl" => $input['recommend_ppl'],
				"last_print_at" => Carbon::now(),
				"print_by" => "test",

		 "devotee_id" => $input['focusdevotee_id'],
		"total"  => $input['total_amount'],
        "association_dd" => $input['association_dd']

		];

		$wanyuanshenghui = Wanyuanshenghui::create($data);

		//receipt creation and receipt handling pending yet

		$request->session()->flash('success', '万缘胜会 is successfully created.');
		return redirect()->back();

    }



	// Receipt Cancellation
	public function postReceiptCancellation(Request $request)
	{
		$input = array_except($request->all(), '_token');

		if(isset($input['authorized_password']))
		{
			$user = User::find(Auth::user()->id);
      $hashedPassword = $user->password;

			if (Hash::check($input['authorized_password'], $hashedPassword))
			{
				$receipt = Receipt::find($input['receipt_id']);

				$receipt->cancelled_date = Carbon::now();
				$receipt->status = "cancelled";
				$receipt->cancelled_by = Auth::user()->id;

				$result = $receipt->save();

				if($result)
				{
					$receiptdetail = Receipt::join('user', 'user.id', '=', 'receipt.cancelled_by')
									->where('receipt.receipt_id', $input['receipt_id'])
									->select('receipt.*', 'user.first_name', 'user.last_name')
									->get();

					// dd($data->toArray());

					return redirect()->back()->with([
						'receiptdetail' => $receiptdetail
					]);
				}
			}

			else
			{
				$request->session()->flash('error', "Password did not match. Please Try Again");
				return redirect()->back();
			}
		}
	}

	// Print Receipt
	public function getReceipt(Request $request, $receipt_id)
	{
		$receipt = Receipt::join('generaldonation', 'generaldonation.generaldonation_id', '=', 'receipt.generaldonation_id')
					->join('devotee', 'devotee.devotee_id', '=', 'generaldonation.focusdevotee_id')
					->select('receipt.*', 'devotee.*', 'devotee.devotee_id', 'generaldonation.trans_no')
					->where('receipt.receipt_id', $receipt_id)
					->get();

		// get general donation devotee by generaldonation id
		$donation_devotees = GeneralDonationItems::join('devotee', 'devotee.devotee_id', '=', 'generaldonation_items.devotee_id')
							->select('generaldonation_items.*')
							->addSelect('devotee.chinese_name', 'devotee.address_houseno', 'devotee.address_street', 'devotee.address_unit1',
								'devotee.address_unit2')
							->where('receipt_id', $receipt_id)
							->get();

		$generaldonation = GeneralDonation::find($receipt[0]->generaldonation_id);

		$festiveevent = FestiveEvent::find($generaldonation->festiveevent_id);

		return view('staff.receipt', [
			'festiveevent' => $festiveevent,
      'receipt' => $receipt,
      'donation_devotees' => $donation_devotees,
      'generaldonation' => $generaldonation
    ]);
	}

	// Get Detail for Receipt ID
	public function getReceiptDetail($receipt_id)
	{
		$receipt = Receipt::join('generaldonation', 'generaldonation.generaldonation_id', '=', 'receipt.generaldonation_id')
							 ->join('devotee', 'devotee.devotee_id', '=', 'generaldonation.focusdevotee_id')
							 ->select('receipt.*', 'devotee.chinese_name', 'devotee.devotee_id', 'generaldonation.trans_no')
							 ->where('receipt.receipt_id', $receipt_id)
							 ->get();

	  // get general donation devotee by generaldonation id
	  $donation_devotees = GeneralDonationItems::join('devotee', 'devotee.devotee_id', '=', 'generaldonation_items.devotee_id')
											 	 ->select('generaldonation_items.*')
											 	 ->addSelect('devotee.chinese_name', 'devotee.address_houseno', 'devotee.address_street', 'devotee.address_unit1',
													'devotee.address_unit2')
											 	 ->where('receipt_id', $receipt_id)
											 	 ->get();

	  $generaldonation = GeneralDonation::find($receipt[0]->generaldonation_id);

		$festiveevent = FestiveEvent::find($generaldonation->festiveevent_id);

		return view('staff.receiptdetail', [
			'festiveevent' => $festiveevent,
			'receipt' => $receipt,
      'donation_devotees' => $donation_devotees,
      'generaldonation' => $generaldonation
		]);
	}

	public function getTransaction(Request $request, $generaldonation_id)
	{
		$receipt = Receipt::join('generaldonation', 'generaldonation.generaldonation_id', '=', 'receipt.generaldonation_id')
					->join('devotee', 'devotee.devotee_id', '=', 'generaldonation.focusdevotee_id')
					->select('receipt.*', 'devotee.chinese_name', 'devotee.devotee_id', 'generaldonation.trans_no')
					->where('receipt.generaldonation_id', $generaldonation_id)
					->get();

		$generaldonation_items = GeneralDonationItems::join('devotee', 'devotee.devotee_id', '=', 'generaldonation_items.devotee_id')
									->join('receipt', 'receipt.receipt_id', '=', 'generaldonation_items.receipt_id')
									->select('generaldonation_items.*')
									->addSelect('devotee.chinese_name', 'devotee.address_houseno', 'devotee.address_street',
											'devotee.address_unit1', 'devotee.address_unit2')
									->addSelect('receipt.xy_receipt')
									->where('generaldonation_items.generaldonation_id', $generaldonation_id)
								 	->get();

		$generaldonation = GeneralDonation::find($generaldonation_id);

		// dd($generaldonation_items->toArray());

		return view('staff.transaction-detail', [
			'receipt' => $receipt,
			'generaldonation' => $generaldonation,
			'generaldonation_items' => $generaldonation_items
		]);
	}


	public function getSearchDevotee(Request $request)
	{
		$devotee_id = $_GET['devotee_id'];

		$devotee = Devotee::find($devotee_id);

		return response()->json([
			'devotee' => $devotee
		]);
	}


	public function getCreateFestiveEvent()
	{
			$events = FestiveEvent::orderBy('start_at', 'asc')->get();
			$jobs = Job::orderBy('created_at', 'desc')->get();

			return view('staff.create-festive-event', [
				'jobs' => $jobs,
				'events' => $events
			]);
	}

	public function postCreateFestiveEvent(Request $request)
	{
			$input = array_except($request->all(), '_token', 'display');

			FestiveEvent::truncate();

			for($i = 0; $i < count($input["start_at"]); $i++)
			{

				$start_at = $input["start_at"][$i];
				$new_start_at = str_replace('/', '-', $start_at);

				$end_at = $input['end_at'][$i];
				$new_end_at = str_replace('/', '-', $end_at);

				$data = [
					"event" => $input['event'][$i],
        	"start_at" => date("Y-m-d", strtotime($new_start_at)),
        	"end_at" => date("Y-m-d", strtotime($new_end_at)),
					"lunar_date" => $input['lunar_date'][$i],
					"time" => $input['time'][$i],
					"shuwen_title" => $input['shuwen_title'][$i],
					"display" => $input['display_hidden'][$i]
      	];

				FestiveEvent::create($data);
			}


			$events = FestiveEvent::orderBy('start_at', 'desc')->get();

			$request->session()->flash('success', 'Event Calender has been outdated!');

			return redirect()->back()->with([
				'events' => $events
			]);
	}

}
