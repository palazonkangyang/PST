<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Staff;
use App\Models\User;
use App\Models\SelectionOption;
use App\Models\Shengzhupaislots;
use App\Models\LingWeislots;
use App\Models\Beislots;
use App\Models\LingWeitrans;
use App\Models\LingWei;
use App\Models\Gst;
use App\Models\Acknowledge;
use App\Models\Dialect;
use App\Models\Race;
use App\Models\Amount;
use App\Models\MembershipFee;
use App\Models\TranslationStreet;
use Auth;
use DB;
use Hash;
use Mail;
use Input;
use Session;
use View;
use URL;
use Carbon\Carbon;

class AdminController extends Controller
{

	public function index()
	{
		$staff = Staff::get()->first();

		return view('admin/homepage');
	}

    public function dashboard()
    {
      return view('admin/dashboard');
    }

	// Get All Accounts
	public function getAllAccounts()
	{
		$users = User::select("id", "role", "first_name", "last_name", "user_name")
						 ->get();

		foreach($users as $key => $val)
    {

      if($users[$key]['role'] == 1)
      {
        $users[$key]['role_name'] = "Super Admin";
      }

      else if($users[$key]['role'] == 2)
      {
        $users[$key]['role_name'] = "Admin";
      }

      else if($users[$key]['role'] == 3)
      {
        $users[$key]['role_name'] = "Supervisor";
      }

      else if($users[$key]['role'] == 4)
      {
      	$users[$key]['role_name'] = "Account Officer";
      }

      else if($users[$key]['role'] == 5)
      {
        $users[$key]['role_name'] = "Operator";
      }

			else
      {
        $users[$key]['role_name'] = "Account Supervisor";
      }
  	}

		return view('admin.all-accounts', [
      'staffs' => $users
    ]);
	}

	// Add Account
	public function getAddAccount()
	{
		return view('admin.add-account');
	}

	// Create New Account
	public function postAddAccount(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$validator = $this->validate($request, [
      'user_name'	=> 'required|string',
      'password' => 'required',
      'confirm_password' => 'required',
      'role' => 'required'
    ]);

    if ($validator && $validator->fails()) {
      return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

		$user = User::where('user_name', $input['user_name'])->first();

		if($user)
		{
			$request->session()->flash('error', "Username has already exist. Please try another username.");
			return redirect()->back()->withInput();
		}

    if ($input['password'] != $input['confirm_password']) {
      $request->session()->flash('error', "Password don't match. Please Try Again");
      return redirect()->back()->withInput();
    }

		$input['password'] = Hash::make($input['password']);

		User::create($input);

		$request->session()->flash('success', 'New User successfully added!');
		return redirect()->route('all-accounts-page');
	}

	// Edit Account
	public function getEditAccount($id)
	{
    $staff = User::find($id);

    if (!$staff) {
      return view('errors.503');
    }

		return view('admin.edit-account', [
      'staff' => $staff
    ]);
	}

	// Change Account
	public function changeAccount(Request $request)
	{
		$input = Input::except('_token');

    if(isset($input['password']) && isset($input['confirm_password']))
		{
			if ($input['password'] != $input['confirm_password']) {

	      $request->session()->flash('error', "Password don't match. Please Try Again");
	      return redirect()->back()->withInput();
	    }

			else
			{
				$staff = User::find($input['staff_id']);

		    $staff->first_name = $input['first_name'];
		    $staff->last_name = $input['last_name'];
		    $staff->user_name = $input['user_name'];
		    $staff->password = Hash::make($input['password']);
		    $staff->role = $input['role'];
		    $staff->save();
			}

			$request->session()->flash('success', 'User account has been updated!');
	    return redirect()->route('all-accounts-page');
		}

		else {
			$staff = User::find($input['staff_id']);

			$staff->first_name = $input['first_name'];
			$staff->last_name = $input['last_name'];
			$staff->user_name = $input['user_name'];
			$staff->role = $input['role'];
			$staff->save();

			$request->session()->flash('success', 'User account has been updated!');
			return redirect()->route('all-accounts-page');
		}
	}

	// Delete Account
	public function deleteAccount(Request $request, $id)
	{
		$staff = User::find($id);

    if (!$staff) {
      $request->session()->flash('error', 'Selected Account is not found.');
      return redirect()->back();
  	}

    $staff->delete();

		$request->session()->flash('success', 'Selected Account has been deleted.');
    return redirect()->back();
	}

	// Admin Login
	public function login()
	{
		$acknowledge = Acknowledge::all();

		return view('admin.login', [
			'acknowledge' => $acknowledge
		]);
	}

	// Login Authentication
	public function postLogin(Request $request)
	{
		$input = Input::except('_token');

		$input = array_except($request->all(), '_token');
		$input['password'] = Hash::make($input['password']);
		$input['role'] = 5;

		$staff = User::create($input);

		return redirect()->back();
	}

  public function logout()
  {
    Auth::logout();
    return redirect()->intended(URL::route('login-page'));
  }

	public function getPreLoginNote()
	{
		$acknowledge = Acknowledge::all();

		return view('admin.acknowledge', [
			'acknowledge' => $acknowledge
		]);
	}

	public function postUpdateAcknowledge(Request $request)
	{
		$input = array_except($request->all(), '_token');

		if(!isset($input['show_prelogin']))
		{
			$input['show_prelogin'] = 0;
		}

		$acknowledge = Acknowledge::find($input['id']);
		$acknowledge->prelogin_notes = $input['prelogin_notes'];
		$acknowledge->show_prelogin = $input['show_prelogin'];

		$acknowledge->save();

		$request->session()->flash('success', 'Acknowledge has been updated!');
		return redirect()->back();

	}

	// Get Add Dialect
	public function getAddDialect()
	{
		return view('admin.add-dialect');
	}

	public function getAllDialects()
	{
		$dialects = Dialect::orderBy('dialect_id', 'desc')->get();

		return view('admin.all-dialects', [
			'dialects' => $dialects
		]);
	}

	// Add Dialect
	public function postAddDialect(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$dialect = Dialect::where('dialect_name', $input['dialect_name'])->first();

		if($dialect)
		{
			$request->session()->flash('error', "Dialect Name is already exist.");
			return redirect()->back()->withInput();
		}

		Dialect::create($input);

		$request->session()->flash('success', 'New Dialect is successfully added!');
		return redirect()->back();
	}

	public function getEditDialect($id)
	{
		$dialect = Dialect::find($id);

		if (!$dialect) {
      return view('errors.503');
    }

		return view('admin.edit-dialect', [
      'dialect' => $dialect
    ]);
	}

	public function updateDialect(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$dialect = Dialect::where('dialect_name', $input['dialect_name'])
							 ->where('dialect_id', '!=', $input['dialect_id'])
							 ->first();

		if($dialect)
		{
			$request->session()->flash('error', "Dialect Name is already exist.");
			return redirect()->back()->withInput();
		}

		$result = Dialect::find($input['dialect_id']);
		$result->dialect_name = $input['dialect_name'];
		$result->save();

		$request->session()->flash('success', 'Dialect is successfully updated!');
		return redirect()->route('all-dialects-page');
	}

	// Delete Dialect
	public function deleteDialect(Request $request, $id)
	{
		$dialect = Dialect::find($id);

    if (!$dialect) {
      $request->session()->flash('error', 'Selected Dialect is not found.');
      return redirect()->back();
  	}

    $dialect->delete();

		$request->session()->flash('success', 'Selected Dialect has been deleted.');
    return redirect()->back();
	}

	public function getAddRace()
	{
		return view('admin.add-race');
	}

	public function getAllRace()
	{
		$race = Race::orderBy('race_id', 'desc')->get();

		return view('admin.all-race', [
			'race' => $race
		]);
	}

	public function postAddRace(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$race = Race::where('race_name', $input['race_name'])->first();

		if($race)
		{
			$request->session()->flash('error', "Race Name is already exist.");
			return redirect()->back()->withInput();
		}

		Race::create($input);

		$request->session()->flash('success', 'New Race is successfully added!');
		return redirect()->back();
	}

	public function getEditRace($id)
	{
		$race = Race::find($id);

		if (!$race) {
      return view('errors.503');
    }

		return view('admin.edit-race', [
      'race' => $race
    ]);
	}

	public function updateRace(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$race = Race::where('race_name', $input['race_name'])
						->where('race_id', '!=', $input['race_id'])
						->first();

		if($race)
		{
			$request->session()->flash('error', "Race Name is already exist.");
			return redirect()->back()->withInput();
		}

		$result = Race::find($input['race_id']);
		$result->race_name = $input['race_name'];
		$result->save();

		$request->session()->flash('success', 'Race is successfully updated!');
		return redirect()->route('all-race-page');
	}

	public function deleteRace(Request $request, $id)
	{
		$race = Race::find($id);

    if (!$race) {
      $request->session()->flash('error', 'Selected Race is not found.');
      return redirect()->back();
  	}

    $race->delete();

		$request->session()->flash('success', 'Selected Race has been deleted.');
    return redirect()->back();
	}

	public function getMemebershipFee()
	{
		$membership = MembershipFee::all();

		return view('admin.membership-fee', [
			'membership' => $membership
		]);
	}

	public function postUpdateMemebershipFee(Request $request)
	{
	  $input = array_except($request->all(), '_token');

		$membership = MembershipFee::find($input['membership_fee_id']);
		$membership->membership_fee = $input['membership_fee'];
	  $membership->save();

		$yuejuan_same_family = Session::get('yuejuan_same_family');
		$yuejuan_different_family = Session::get('yuejuan_different_family');

		if(count($yuejuan_same_family) > 0)
		{
			Session::forget('samefamily_amount');

			$samefamily_amount = [];

			for($i = 0; $i < count($yuejuan_same_family); $i++)
			{
				$amount = [];

				if(isset($yuejuan_same_family[$i]->paytill_date))
				{
					$myArray = explode('-', $yuejuan_same_family[$i]->paytill_date);

					$count = 1;
					for($j = 1; $j <= 10; $j++)
					{
						$dt = Carbon::create($myArray[0], $myArray[1], $myArray[2], 0);
						$dt = $dt->addYears($count);

						$format = Carbon::parse($dt)->format("Y-m");

						$fee = $membership->membership_fee * $j;
						$amount[$j] = number_format($fee, 2) . ' --- ' . $format;

						$count++;
					}

				}

				array_push($samefamily_amount, $amount);
			}

			Session::put('samefamily_amount', $samefamily_amount);
		}

		if(count($yuejuan_different_family) > 0)
		{
			Session::forget('differentfamily_amount');

			$differentfamily_amount = [];

			for($i = 0; $i < count($yuejuan_different_family); $i++)
			{
				$amount = [];

				if(isset($yuejuan_different_family[$i]->paytill_date))
				{
					$myArray = explode('-', $yuejuan_different_family[$i]->paytill_date);

					$count = 1;
					for($j = 1; $j <= 10; $j++)
					{
						$dt = Carbon::create($myArray[0], $myArray[1], $myArray[2], 0);
						$dt = $dt->addYears($count);

						$format = Carbon::parse($dt)->format("Y-m");

						$fee = $membership->membership_fee * $j;
						$amount[$j] = number_format($fee, 2) . ' --- ' . $format;

						$count++;
					}
				}

				array_push($differentfamily_amount, $amount);
			}

			Session::put('differentfamily_amount', $differentfamily_amount);
		}

	  $request->session()->flash('success', 'Membership Fee has been updated!');
	  return redirect()->back();
	}

	public function getMinimumAmount()
	{
		$amount = Amount::all();

		return view('admin.minimum-amount', [
			'amount' => $amount
		]);
	}

	public function postUpdateMinimumAmount(Request $request)
	{
	  $input = array_except($request->all(), '_token');

		$amount = Amount::find($input['amount_id']);
		$amount->minimum_amount = $input['minimum_amount'];
	  $amount->save();

	  $request->session()->flash('success', 'Minimum Amount has been updated!');
	  return redirect()->back();
	}

	public function getAddressStreetLists()
	{
		return view('admin.all-address-streets');
	}

	public function SearchAddress(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$translation_street = TranslationStreet::where('chinese', 'like', '%' . $input['chinese'] . '%')
													->where('english', 'like', '%' . $input['english'] . '%')
													->where('address_houseno', 'like', '%' . $input['address_houseno'] . '%')
													->where('address_postal', 'like', '%' . $input['address_postal'] . '%')
													->get();

		// dd($translation_street->toArray());

		return view('admin.filter-streets', [
			'translation_street' => $translation_street
		]);
	}

	public function getAddAddress()
	{
		return view('admin.add-address');
	}

	public function postAddAddress(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$check_address_postal = TranslationStreet::where('address_postal', $input['address_postal'])->first();
		$check_address = TranslationStreet::where('english', $input['english'])
										->where('address_houseno', $input['address_houseno'])
										->first();

		if($check_address_postal)
		{
			$request->session()->flash('error', 'Address Postal is already exit.');
      return redirect()->back()->withInput();
		}

		if($check_address)
		{
			$request->session()->flash('error', 'Address House No and English Street Name are already exits.');
      return redirect()->back()->withInput();
		}

		TranslationStreet::create($input);

		$request->session()->flash('success', 'New Address Street has been created!');
	  return redirect()->back();
	}

	public function getEditAddress($id)
	{
		$result = TranslationStreet::find($id);

		if (!$result) {
      return view('errors.503');
    }

		return view('admin.edit-address', [
      'address' => $result
    ]);
	}

	public function updateAddress(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$check_address_postal = TranslationStreet::where('address_postal', $input['address_postal'])
														 ->where('id', '!=', $input['id'])
														 ->first();

		$check_address = TranslationStreet::where('english', $input['english'])
														->where('address_houseno', $input['address_houseno'])
												 		->where('id', '!=', $input['id'])
												 		->first();

		if($check_address_postal)
		{
			$request->session()->flash('error', 'Address Postal is already exit.');
			return redirect()->back()->withInput();
		}

		if($check_address)
		{
			$request->session()->flash('error', 'Address House No and English Street Name are already exits.');
			return redirect()->back()->withInput();
		}

		$result = TranslationStreet::find($input['id']);
		$result->chinese = $input['chinese'];
		$result->english = $input['english'];
		$result->address_houseno = $input['address_houseno'];
		$result->address_postal = $input['address_postal'];

		$result->save();

		$request->session()->flash('success', 'Address is successfully updated!');
		return redirect()->route('address-street-lists-page');
	}

	// Delete Address
	public function deleteAddress(Request $request, $id)
	{
		$result = TranslationStreet::find($id);

    if (!$result) {
      $request->session()->flash('error', 'Selected Address is not found.');
      return redirect()->back();
  	}

    $result->delete();

		$request->session()->flash('success', 'Selected Address has been deleted.');
    return redirect()->back();
	}


	    public function getAjaxShengzhupaiSlots(Request $request)
	    {
	        $slot_id = $_GET['slot_id'];
	          $Shengzhupaislots = Shengzhupaislots::where('id', '=',  $slot_id)
	                ->first();

	        return response()->json(array(
	            'shengzhupaislots' => $Shengzhupaislots
	        ));
	    }

			// Get Setting Ling Wei
			public function getSettingLingwei()
			{
					return view('admin.setting-lingwei');
			}

			// Get All Ling Wei
			public function getAllLingwei()
			{
				$Lingweis = Lingweislots::leftjoin('lingwei', 'lingwei.slot_id', '=', 'lingweislots.id')
																		->leftjoin('devotee', 'devotee.devotee_id', '=', 'lingwei.focusdevotee_id')
				                            ->select('lingweislots.*', 'lingwei.focusdevotee_id', 'devotee.chinese_name', 'devotee.nric', 'devotee.contact')
				                           ->get();
					return view('admin.all-lingwei', [
						'lingweis' => $Lingweis
				]);
			}

			// Get All Ling Wei Exchange
			public function getAllLingweiExchange()
			{
	$Lingweis = Lingweitrans::leftjoin('lingweislots', 'lingweislots.id', '=', 'lingwei_trans.lingweislot_id')
															->leftjoin('devotee  as df', 'df.devotee_id', '=', 'lingwei_trans.devotee_from_id')
															->leftjoin('devotee  as dt', 'dt.devotee_id', '=', 'lingwei_trans.devotee_to_id')
															->select('lingweislots.*','lingwei_trans.created_at as trans_created_at', 'dt.chinese_name as dt_chinese_name', 'dt.nric as dt_nric', 'dt.contact as dt_contact', 'df.chinese_name as df_chinese_name', 'df.nric as df_nric', 'df.contact as df_contact')
														 ->get();
				return view('admin.all-lingwei-exchange', [
					'lingweis' => $Lingweis
								]);
			}

			// Get Setting Shengzhupai
			public function getSettingShengzhupai()
			{
					return view('admin.setting-shengzhupai');
			}

			// Get AllShengzhupai
			public function getAllShengzhupai()
			{
			
				$Shengzhupais = Shengzhupaislots::leftjoin('shengzhupai', 'shengzhupai.slot_id', '=', 'shengzhupaislots.id')
																		->leftjoin('devotee', 'devotee.devotee_id', '=', 'shengzhupai.focusdevotee_id')
				                            ->select('shengzhupaislots.*', 'shengzhupai.focusdevotee_id', 'devotee.chinese_name', 'devotee.nric', 'devotee.contact')
				                           ->get();
					return view('admin.all-shengzhupai', [
						'shengzhupais' => $Shengzhupais
				]);
			}



			// Get AllBei
			public function getAllBei()
			{

			}



			// Get SettingOtherOption
			public function getAddOtherOption()
			{
						return view('admin.add-otheroption');
			}

			public function postAddOtherOption(Request $request)
			{
				$input = array_except($request->all(), '_token');

				$validator = $this->validate($request, [
		            'name' => 'required|string',
		            'description' => 'string',
		            'price'	=> 'required|numeric'
		        ]);

		        if ($validator && $validator->fails()) {
		            return redirect()->back()
		                ->withErrors($validator)
		                ->withInput();
		        }



				SelectionOption::create($input);

				$request->session()->flash('success', 'New 其他选项 successfully added!');
				return redirect()->back();
			}


	public function postSettingShengzhupai(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$validator = $this->validate($request, [
						'blk' => 'required',
						'level' => 'required',
						'start_number'	=> 'required|numeric',
						'end_number'	=> 'required|numeric',
						'type'	=> 'required|numeric',
						'price'	=> 'required|numeric',
						'select_price'	=> 'required|numeric'
				]);

				if ($validator && $validator->fails()) {
						return redirect()->back()
								->withErrors($validator)
								->withInput();
				}

				//loop


				for ($i = $input['start_number']; $i < $input['end_number']+1; $i++) {
			//if no exist then create whole record
			//if exist then update price only
			$shengzhupaislot= Shengzhupaislots::where('ss_blk', '=', $input['blk'])->where('ss_level', '=',$input['level'])->where('ss_number', '=', $i)->where('type', '=', $input['type']) ->first();

			if (!$shengzhupaislot) {
				$shengzhupaislotsnewrecord= new Shengzhupaislots;
				$shengzhupaislotsnewrecord->ss_blk = $input['blk'];
				$shengzhupaislotsnewrecord->ss_level = $input['level'];
				$shengzhupaislotsnewrecord->ss_number = $i;
				$shengzhupaislotsnewrecord->type =  $input['type'];
				$shengzhupaislotsnewrecord->price = $input['price'];
				$shengzhupaislotsnewrecord->select_price = $input['select_price'];
				$shengzhupaislotsnewrecord->save();
			}else{
			 $shengzhupaislotoldrecord = Shengzhupaislots::find($shengzhupaislot->id);
			 $shengzhupaislotoldrecord->price = $input['price'];
			 $shengzhupaislotoldrecord->select_price = $input['select_price'];
			 $shengzhupaislotoldrecord->save();
			}
		}



		$request->session()->flash('success', 'New 神主牌 slots successfully added/edited!');
		return redirect()->back();
	}


	public function postPriceSettingShengzhupai(Request $request)
	{
		$input = array_except($request->all(), '_token');

		$validator = $this->validate($request, [
						'blk' => 'required',
						'level' => 'required',
						'start_number'	=> 'required|numeric',
						'end_number'	=> 'required|numeric',
						'type'	=> 'required|numeric',
						'price'	=> 'required|numeric',
						'select_price'	=> 'required|numeric'
				]);

				if ($validator && $validator->fails()) {
						return redirect()->back()
								->withErrors($validator)
								->withInput();
				}

				//loop


				for ($i = $input['start_number']; $i < $input['end_number']+1; $i++) {
			//if no exist then create whole record
			//if exist then update price only
			$shengzhupaislot= Shengzhupaislots::where('ss_blk', '=', $input['blk'])->where('ss_level', '=',$input['level'])->where('ss_number', '=', $i)->where('type', '=', $input['type']) ->first();

			if($shengzhupaislot){
			 $shengzhupaislotoldrecord = Shengzhupaislots::find($shengzhupaislot->id);
			 $shengzhupaislotoldrecord->price = $input['price'];
			 $shengzhupaislotoldrecord->select_price = $input['select_price'];
			 $shengzhupaislotoldrecord->save();
		 }

		}



		$request->session()->flash('success', '神主牌 slots price successfully edited!');
		return redirect()->back();
	}

			public function postSettingLingwei(Request $request)
			{
				$input = array_except($request->all(), '_token');

				$validator = $this->validate($request, [
								'blk' => 'required',
								'level' => 'required',
								'start_number'	=> 'required|numeric',
								'end_number'	=> 'required|numeric',
								'type'	=> 'required|numeric',
								'price'	=> 'required|numeric',
								'select_price'	=> 'required|numeric'
						]);

						if ($validator && $validator->fails()) {
								return redirect()->back()
										->withErrors($validator)
										->withInput();
						}

						//loop


						for ($i = $input['start_number']; $i < $input['end_number']+1; $i++) {
					//if no exist then create whole record
					//if exist then update price only
					$lingweislot = Lingweislots::where('ls_blk', '=', $input['blk'])->where('ls_level', '=',$input['level'])->where('ls_number', '=', $i)->where('type', '=', $input['type']) ->first();

					if (!$lingweislot) {
						$lingWeislotsnewrecord= new LingWeislots;
						$lingWeislotsnewrecord->ls_blk = $input['blk'];
						$lingWeislotsnewrecord->ls_level = $input['level'];
						$lingWeislotsnewrecord->ls_number = $i;
						$lingWeislotsnewrecord->type =  $input['type'];
						$lingWeislotsnewrecord->price = $input['price'];
						$lingWeislotsnewrecord->select_price = $input['select_price'];
						$lingWeislotsnewrecord->save();
					}else{
					 $lingweislotoldrecord = LingWeislots::find($lingweislot->id);
					 $lingweislotoldrecord->price = $input['price'];
					 $lingweislotoldrecord->select_price = $input['select_price'];
					 $lingweislotoldrecord->save();
					}
				}



				$request->session()->flash('success', 'New 灵位 slots successfully added/edited!');
				return redirect()->back();
			}

			public function postPriceSettingLingwei(Request $request)
			{
				$input = array_except($request->all(), '_token');

				$validator = $this->validate($request, [
								'blk' => 'required',
								'level' => 'required',
								'start_number'	=> 'required|numeric',
								'end_number'	=> 'required|numeric',
								'type'	=> 'required|numeric',
								'price'	=> 'required|numeric',
								'select_price'	=> 'required|numeric'
						]);

						if ($validator && $validator->fails()) {
								return redirect()->back()
										->withErrors($validator)
										->withInput();
						}

						//loop


						for ($i = $input['start_number']; $i < $input['end_number']+1; $i++) {
					//if no exist then create whole record
					//if exist then update price only
					$lingweislot = Lingweislots::where('ls_blk', '=', $input['blk'])->where('ls_level', '=',$input['level'])->where('ls_number', '=', $i)->where('type', '=', $input['type']) ->first();

					if($lingweislot){
					 $lingweislotoldrecord = LingWeislots::find($lingweislot->id);
					 $lingweislotoldrecord->price = $input['price'];
					 $lingweislotoldrecord->select_price = $input['select_price'];
					 $lingweislotoldrecord->save();
				 }

				}



				$request->session()->flash('success', '灵位 slots price successfully updated!');
				return redirect()->back();
			}



			// Get getAddZuolingStatus
			public function getAddZuolingStatus()
			{
						return view('admin.add-otheroption');
			}

			public function postAddZuolingStatus(Request $request)
			{
				$input = array_except($request->all(), '_token');

				$validator = $this->validate($request, [
								'name' => 'required|string',
								'description' => 'string',
								'price'	=> 'required|numeric'
						]);

						if ($validator && $validator->fails()) {
								return redirect()->back()
										->withErrors($validator)
										->withInput();
						}



				SelectionOption::create($input);

				$request->session()->flash('success', 'New 其他选项 successfully added!');
				return redirect()->back();
			}


			// Edit Other Option
			public function getEditOtherOption($id)
			{
		        $option = SelectionOption::find($id);

		        if (!$option) {
		            return view('errors.503');
		        }

				return view('admin.edit-otheroption', [
		            'option' => $option
		        ]);
			}

			public function changeOtherOption(Request $request)
			{
				$input = Input::except('_token');

		        $validator = $this->validate($request, [
		            'name' => 'required|string',
		            'price'	=> 'required|numeric'
		        ]);

		        if ($validator && $validator->fails()) {
		            return redirect()->back()
		                ->withErrors($validator)
		                ->withInput();
		        }

		        $option = SelectionOption::find($input['option_id']);
		        $option->name = $input['name'];
		        $option->description = $input['description'];
		        $option->price = $input['price'];
		        $option->save();

		        $request->session()->flash('success', 'Selection Option has been updated!');

		        return redirect()->back();
			}


			// Edit Lingwei
			public function getEditLingwei($id)
			{
				$lingwei = Lingweislots::leftjoin('lingwei', 'lingwei.slot_id', '=', 'lingweislots.id')
																		->leftjoin('devotee', 'devotee.devotee_id', '=', 'lingwei.focusdevotee_id')
																		->select('lingweislots.*','lingweislots.id as lingweislot_id', 'lingwei.focusdevotee_id', 'devotee.chinese_name', 'devotee.nric', 'devotee.devotee_id', 'devotee.contact')
																	->where('lingweislots.id', '=', $id)
																	 ->first();

						if (!$lingwei) {
								return view('errors.503');
						}

				return view('admin.edit-lingwei', [
								'lingwei' => $lingwei
						]);
			}

			public function changeLingwei(Request $request)
			{
				$input = Input::except('_token');

				$validator = $this->validate($request, [
						'devotee_to_id' => 'required'
				]);

				if ($validator && $validator->fails()) {
						return redirect()->back()
								->withErrors($validator)
								->withInput();
				}

				$lingwei = Lingwei::find($input['lingwei_id']);
				$lingwei->focus_devotee_id = $input['devotee_id'];
				$lingwei->save();

						$lingWeitrans= new LingWeitrans;
						$lingWeitrans->devotee_from_id = $input['devotee_from_id'];
						$lingWeitrans->devotee_to_id = $input['devotee_to_id'];
						$lingWeitrans->lingweislot_id = $input['lingweislot_id'];

						$lingWeitrans->save();

						$request->session()->flash('success', 'Lingwei has been transfered!');

						return redirect()->back();
			}


			// Edit Lingwei
			public function getSettingBeiAdd($id)
			{
				$bei = Beislots::where('id', '=', $id)
																	 ->first();

						if (!$bei) {
								return view('errors.503');
						}

				return view('admin.add-setting-bei', [
								'bei' => $bei
						]);
			}

			// Delete Account
			public function deleteOtherOption($id)
			{
				$option = SelectionOption::where('id', '=', $id);

		        if (!$option) {
		            $request->session()->flash('error', 'Selected Other Option is not found.');
		            return redirect()->back();
		        }

		        $option->delete();
						$request->session()->flash('success', 'Selection Option has been deleted!');

		        return redirect()->back();
			}


			// Get AllOtheroption
			public function getAllOtheroption()
			{
				$selection_options = SelectionOption::get();


				return view('admin.all-otheroption', [
		            'selection_options' => $selection_options
		        ]);
			}


			// Get ChangeZuolingStatus
			public function getChangeZuolingStatus()
			{

			}


			// Get Report
			public function getReport()
			{

			}



			// Get PricesettingLingwei
			public function getPricesettingLingwei()
			{
					return view('admin.pricesetting-lingwei');
			}

			// Get SettingGst
			public function getSettingGst()
			{
				$setting_gst = Gst::first();


				return view('admin.setting-gst', [
								'setting_gst' => $setting_gst
						]);
			}


			public function postSettingGst(Request $request)
			{
				$input = array_except($request->all(), '_token');

				$validator = $this->validate($request, [
								'percentage' => 'required|numeric'
						]);

						if ($validator && $validator->fails()) {
								return redirect()->back()
										->withErrors($validator)
										->withInput();
						}

						//Save
						$gstrecord = Gst::find(1);
					$gstrecord->gst_amount = $input['percentage'];

					$gstrecord->save();

				$request->session()->flash('success', 'Gst Percentage successfully updated!');
				return redirect()->back();
			}

			public function postAddsettingBei(Request $request)
			{
				$input = array_except($request->all(), '_token');

				$validator = $this->validate($request, [
								'price' => 'required|numeric',
									'slot' => 'required|numeric'
						]);

						if ($validator && $validator->fails()) {
								return redirect()->back()
										->withErrors($validator)
										->withInput();
						}

						//Save
						$beislotrecord = Beislots::find($input['bei_id']);
					$beislotrecord->price = $input['price'];
					$beislotrecord->slot = $input['slot'];
					$beislotrecord->save();

				$request->session()->flash('success', '埕/碑 successfully updated!');
				return redirect()->back();
			}


			// Get SettingBei
			public function getSettingBei()
			{
				//
				$setting_bei = Beislots::get();



				return view('admin.setting-bei', [
								'setting_beis' => $setting_bei
						]);
			}






			// Get PricesettingShengzhupai
			public function getPricesettingShengzhupai()
			{
					return view('admin.pricesetting-shengzhupai');
			}



			// Get OneTimePricesettingShengzhupai
			public function getOneTimePricesettingShengzhupai()
			{
		return view('admin.onetimepricesetting-shengzhupai');
			}


			public function postOneTimePricesettingShengzhupai(Request $request)
			{
				$input = array_except($request->all(), '_token');

				$validator = $this->validate($request, [
									'percentage'	=> 'required|numeric'
						]);

						if ($validator && $validator->fails()) {
								return redirect()->back()
										->withErrors($validator)
										->withInput();
						}

						$Shengzhupaislots = Shengzhupaislots::where('status', '=', 'available')
										->get();
		//loop

							foreach ($Shengzhupaislots as $shengzhupaislot)
							{
					//if no exist then create whole record
					//if exist then update price only
						 $shengzhupaislotoldrecord = Shengzhupaislots::find($shengzhupaislot->id);
					 $shengzhupaislotoldrecord->price = $shengzhupaislot->price*(100+$input['percentage'])/100;
					 $shengzhupaislotoldrecord->select_price = $shengzhupaislot->select_price*(100+$input['percentage'])/100;
					 $shengzhupaislotoldrecord->save();

				}

				$request->session()->flash('success', '神主牌 slots price successfully updated!');
				return redirect()->back();
			}

			// Get OneTimePricesettingLingwei
			public function getOneTimePricesettingLingwei()
			{
		return view('admin.onetimepricesetting-lingwei');
			}


			public function postOneTimePricesettingLingwei(Request $request)
			{
				$input = array_except($request->all(), '_token');

				$validator = $this->validate($request, [
								'percentage'	=> 'required|numeric'
						]);

						if ($validator && $validator->fails()) {
								return redirect()->back()
										->withErrors($validator)
										->withInput();
						}

						$LingWeislots = LingWeislots::where('status', '=', 'available')
										->get();

						//loop

							foreach ($LingWeislots as $lingweislot)
							{
					//if no exist then create whole record
					//if exist then update price only
						 $lingweislotoldrecord = LingWeislots::find($lingweislot->id);
					 $lingweislotoldrecord->price = $lingweislot->price*(100+$input['percentage'])/100;
					 $lingweislotoldrecord->select_price = $lingweislot->select_price*(100+$input['percentage'])/100;
					 $lingweislotoldrecord->save();

				}

				$request->session()->flash('success', '灵位 slots price successfully updated!');
				return redirect()->back();
			}

	    // Get All Sheng Zhu Pai Slots
	    public function getAllShengzhuPaiSlots()
	    {
	        $Shengzhupaislots = Shengzhupaislots::where('status', '=', 'available')
	                ->get();



	        return view('admin.all-shengzhupaislots', [
	            'shengzhupaislots' => $Shengzhupaislots
	        ]);
	    }



}
