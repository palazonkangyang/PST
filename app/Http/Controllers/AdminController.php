<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Staff;
use App\Models\User;
use App\Models\SelectionOption;
use App\Models\Shengzhupaislots;
use Auth;
use DB;
use Hash;
use Mail;
use Input;
use Session;
use View;
use URL;

class AdminController extends Controller
{

	public function index()
	{

		$staff = Staff::get()->first();

		// dd($staff->toArray());

		return view('admin/homepage');
	}

    public function dashboard()
    {


        return view('admin/dashboard');
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

		}

		// Get All Ling Wei
		public function getAllLingwei()
		{

		}

		// Get Setting Shengzhupai
		public function getSettingShengzhupai()
		{

		}

		// Get AllShengzhupai
		public function getAllShengzhupai()
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




		// Edit Other Option
		public function getEditOtherOption($id)
		{
	        $staff = User::find($id);

	        if (!$staff) {
	            return view('errors.503');
	        }

			return view('admin.edit-account', [
	            'staff' => $staff
	        ]);
		}

		public function changeOtherOption(Request $request)
		{
			$input = Input::except('_token');

	        $validator = $this->validate($request, [
	            'first_name' => 'required|string',
	            'last_name' => 'required|string',
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

	        if ($input['password'] != $input['confirm_password']) {

	            $request->session()->flash('error', "Password don't match. Please Try Again");
	            return redirect()->back()->withInput();
	        }

	        $staff = User::find($input['staff_id']);

	        $staff->first_name = $input['first_name'];
	        $staff->last_name = $input['last_name'];
	        $staff->user_name = $input['user_name'];
	        $staff->password = Hash::make($input['password']);
	        $staff->role = $input['role'];
	        $staff->save();

	        $request->session()->flash('success', 'User account has been updated!');

	        return redirect()->back();
		}


		// Delete Account
		public function deleteOtherOption($id)
		{
			$staff = User::where('id', '=', $id);

	        if (!$staff) {
	            $request->session()->flash('error', 'Selected Account is not found.');
	            return redirect()->back();
	        }

	        $staff->delete();

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

		}

		// Get SettingGst
		public function getSettingGst()
		{

		}

		// Get PricesettingShengzhupai
		public function getPricesettingShengzhupai()
		{

		}

		// Get PricesettingBei
		public function getPricesettingBei()
		{

		}

		// Get OneTimePricesettingShengzhupai
		public function getOneTimePricesettingShengzhupai()
		{

		}

		// Get OneTimePricesettingLingwei
		public function getOneTimePricesettingLingwei()
		{

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

	// Get All Accounts
	public function getAllAccounts()
	{
		$users = User::select("id", "role", "first_name", "last_name", "user_name")
				->where('role', '!=', 1)
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
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

        if ($input['password'] != $input['confirm_password']) {

            $request->session()->flash('error', "Password don't match. Please Try Again");
            return redirect()->back()->withInput();
        }

		$input['password'] = Hash::make($input['password']);

		Staff::create($input);

		$request->session()->flash('success', 'New User successfully added!');
		return redirect()->back();
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

	public function changeAccount(Request $request)
	{
		$input = Input::except('_token');

        $validator = $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
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

        if ($input['password'] != $input['confirm_password']) {

            $request->session()->flash('error', "Password don't match. Please Try Again");
            return redirect()->back()->withInput();
        }

        $staff = User::find($input['staff_id']);

        $staff->first_name = $input['first_name'];
        $staff->last_name = $input['last_name'];
        $staff->user_name = $input['user_name'];
        $staff->password = Hash::make($input['password']);
        $staff->role = $input['role'];
        $staff->save();

        $request->session()->flash('success', 'User account has been updated!');

        return redirect()->back();
	}


	// Delete Account
	public function deleteAccount($id)
	{
		$staff = User::where('id', '=', $id);

        if (!$staff) {
            $request->session()->flash('error', 'Selected Account is not found.');
            return redirect()->back();
        }

        $staff->delete();

        return redirect()->back();
	}


	// Admin Login
	public function login()
	{
		return view('admin.login');
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
}
