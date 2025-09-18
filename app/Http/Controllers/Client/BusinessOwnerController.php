<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Client\Client; //model
use Validator;
use Illuminate\Support\Facades\Input;
use Image;
use DB;
use Mail;
use Excel;
use session;
use App\Models\Keyword;
use App\Http\Controllers\SitemapsController as SMC;

class BusinessOwnerController extends Controller
{
	protected $danger_msg = '';
	protected $success_msg = '';
	protected $warning_msg = '';
	protected $info_msg = '';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$clients = Client::get()->count();
		$keyword = Keyword::get()->count();

		return view('client.business-owners', ['clients' => $clients, 'keyword' => $keyword]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function dashboard()
	{
		//
		return view('business.dashboard');
	}

 	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{		 
		if ($request->has('initial_form_submit')) {
			$client = new Client;
			$messages = ['mobile.regex' => 'Mobile number cannot start with 0.'];
			$validator = Validator::make($request->all(), [
				'business_name' => 'required|regex:/[A-Za-z0-9 ]+/',
				'mobile' => 'required|numeric|digits:10|regex:/^[1-9]+/|unique:clients,mobile,NULL,id',
		 
				'email' => 'required|email|unique:clients,email,NULL,id'
			], $messages);
			if ($validator->fails()) {
				return redirect("/business-owners")
					->withErrors($validator)
					->withInput();
			} else {


				$business_slug = NULL;
				$string = $request->input('business_name');
				$string = filter_var($string, FILTER_SANITIZE_STRING);
				$string = preg_replace('/[^A-Za-z0-9]/', ' ', $string);
				$businessName = preg_replace('/\s+/', ' ', str_replace('&', '', trim($string)));
				$business_slug = trim(generate_slug(trim($businessName)));

				if (is_null($business_slug)) {
					return redirect("/business-owners")
						->withErrors($validator)
						->withInput();
				}
				$slugExists = DB::table('clients')
					->select(DB::raw('business_slug'))
					->where('business_slug', 'like', '%' . $business_slug . '%')
					->orderBy('id', 'desc')
					->get();
				if (!empty($slugExists) && $slugExists->count() > 0) {
					$business_slug = $slugExists[0]->business_slug;
					$business_slug = explode("-", $business_slug);
					$end = end($business_slug);
					reset($business_slug);
					if (!is_numeric($end)) {
						$business_slug[] = 1;
					} else {
						++$end;
						$business_slug[count($business_slug) - 1] = $end;
					}
					$business_slug = implode("-", $business_slug);
				}
			}

			$client->business_name = $businessName;
			$client->business_slug = $business_slug;
			$pass = rand(000001, 999999);
			$client->password = bcrypt($pass);
			$client->mobile = $request->input('mobile');
			$client->email = $request->input('email');
			$client->max_kw = 30;

			if ($client->save()) {
				$client = Client::find($client->id);
				$emailname = $request->input('email');
				$clientIDToAppend = $clientID = $client->id;
				if (strlen((string) $clientID) < 4) {
					$clientIDToAppend = str_pad($clientIDToAppend, 4, '0', STR_PAD_LEFT);
				}
				$client->username = $usr = strtoupper(substr($emailname, 0, 2)) . $clientIDToAppend;
				$client->save();
				$client = Client::find($clientID);

				$smsMessage = "Thanks for registering with QuickDials.
				%0D%0ALogin %26 Update your profile to get more leads to grow your business.
				%0D%0A%0D%0ABusiness Name:" . $client->business_name . "
				%0D%0AURL:www.quickdials.com
				%0D%0AUID:" . $client->username . "
				%0D%0APassword:" . $pass . "
				%0D%0A--
				%0D%0ARegards
				%0D%0AQuickDials Team";
				sendSMS($client->mobile, $smsMessage);
				$this->success_msg .= 'Business registered successfully!';
				$request->session()->flash('success_msg', $this->success_msg);
			 
				return redirect("/business-owners");
			} else {
				$this->danger_msg .= 'Business not registered!';
				$request->session()->flash('danger_msg', $this->danger_msg);
				return redirect("/business-owners");
			}
		} else if ($request->has('first_form_submit')) {
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');
			$messages = ['mobile.regex' => 'Mobile number cannot start with 0.'];
			$validator = Validator::make($request->all(), [
				'business_name' => 'required|unique:clients,business_name,' . $id . ',id,city,' . $request->input('city'),
				'landmark' => 'regex:/[a-zA-z ]$/',
				'city' => 'required|regex:/[a-zA-z ]+$/',
				'state' => 'required|regex:/[a-zA-z ()]+$/',
				'country' => 'required|regex:/[a-zA-z ]+$/',

			]);
			if ($validator->fails()) {
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status' => 1, 'errors' => $errorsBag], 400);
			}

			$string = $request->input('business_name');
			$string = filter_var($string, FILTER_SANITIZE_STRING);
			$string = preg_replace('/[^A-Za-z0-9]/', ' ', $string);
			$string = preg_replace('/\s+/', ' ', str_replace('&', '', trim($string)));	
			$client->business_name = $string;
			$client->address = $request->input('address');
			$client->landmark = $request->input('landmark');
			$client->city = $request->input('city');
			$client->state = $request->input('state');
			$client->country = $request->input('country');

			if ($client->save()) {
				$client = Client::find($id);

				$resulsu = "Location Information Updated Successfully";
				return response()->json(['status' => 1, 'result' => $resulsu]);
			} else {

				return response()->json(['status' => 0, 'result' => 'Location Information not assigned']);
			}
		} else if ($request->has('second_form_submit')) {
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');
			$messages = [
				'contact_person.regex' => 'Name allowed alphabets and space only.',
				'mobile.regex' => 'Mobile number cannot start with 0.',
				'sec_mobile.regex' => 'Secondary mobile number cannot start with 0.',
			];
			$validator = Validator::make($request->all(), [
				'contact_person' => 'regex:/^[a-zA-Z ]*$/',
				'mobile' => 'required|numeric|digits:10|regex:/^[1-9]+/',
				'sec_mobile' => 'numeric|digits:10|regex:/^[1-9]+/',
				'stdcode' => 'numeric',
				'landline' => 'numeric',
				'fax' => 'numeric',
				'tollfree' => 'numeric',
				'email' => 'required|email',
				'website' => ['regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],

			]);
			if ($validator->fails()) {
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status' => 1, 'errors' => $errorsBag], 400);
			}

		 
			$name = '';
			if ($request->input('contact_person') != '') {
				$name = explode(' ', $request->input('contact_person'));
			}
			$client->first_name = reset($name);
			$client->last_name = end($name);
			$client->mobile = $request->input('mobile');
			$client->sec_mobile = $request->input('sec_mobile');
			if ($request->input('stdcode') != '' && $request->input('landline') != '') {
				$client->stdcode = $request->input('stdcode');
				$client->landline = $request->input('landline');
			}
			$client->fax = $request->input('fax');
			$client->tollfree = $request->input('tollfree');
			$client->email = $request->input('email');
			$client->website = $request->input('website');

			if ($client->save()) {
				$client = Client::find($id);
				$resulsu = "Contact Information Updated Successfully";
				return response()->json(['status' => 1, 'result' => $resulsu]);
			} else {
				return response()->json(['status' => 0, 'result' => 'Location Information not assigned']);
			}
		} else if ($request->has('third_form_submit')) {
		 
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');
			$validator = Validator::make($request->all(), [
				'image' => 'mimes:jpeg,jpg|max:2048',
				'profile_pic' => 'mimes:jpeg,jpg|max:2048|dimensions:min_width=1137,min_height=319'
			], [
				'profile_pic.dimensions' => 'Please upload profile pic of given size -> [Minimum Height:319px] &amp; [Minimum Width:1137px].'
			]);
			if ($validator->fails()) {
				$request->session()->flash('registration_status', 1);
				$request->session()->flash('show_third_form', 1);
				return redirect("/business-owners")
					->withErrors($validator)
					->withInput();
			}
			$client->display_hofo = $request->input('display_hofo');
			$client->business_intro = $request->input('business_intro');
			$client->time = (null !== $request->input('time')) ? serialize($request->input('time')) : "";

			$client->year_of_estb = $request->input('year_of_estb');
			$client->certifications = (!empty($request->input('certifications'))) ? serialize(explode(',', $request->input('certifications'))) : "";


			if ($request->hasFile('image')) {
				$image = [];
				$filePath = getFolderStructure();
				$file = $request->file('image');
				$filename = str_replace(' ', '_', $file->getClientOriginalName()); // $file->getClientOriginalName();
				$destinationPath = public_path($filePath);
				$nameArr = explode('.', $filename);
				$ext = array_pop($nameArr);
				$name = implode('_', $nameArr);
				if (file_exists($destinationPath . '/' . $filename)) {
					$filename = $name . "_" . time() . '.' . $ext;
				}
				$file->move($destinationPath, $filename);

				$image['large'] = array(
					'name' => $filename,
					'alt' => $filename,
					'width' => '150px',
					'height' => '150px',
					'src' => $filePath . "/" . $filename
				);

				if (!empty($client->logo)) {
					$oldImages = unserialize($client->logo);
				}
				$client->logo = serialize($image);
			}

			// PROFILE PICTURE
			// ***************
			if ($request->hasFile('profile_pic')) {
				$image = [];
				$filePath = getFolderStructure();
				$file = $request->file('profile_pic');
				$filename = str_replace(' ', '_', $file->getClientOriginalName());
				$destinationPath = public_path($filePath);
				$nameArr = explode('.', $filename);
				$ext = array_pop($nameArr);
				$name = implode('_', $nameArr);
				if (file_exists($destinationPath . '/' . $filename)) {
					$filename = $name . "_" . time() . '.' . $ext;
				}
				$file->move($destinationPath, $filename);

				$image['large'] = array(
					'name' => $filename,
					'alt' => $filename,
					'width' => '150px',
					'height' => '150px',
					'src' => $filePath . "/" . $filename
				);

				if (!empty($client->profile_pic)) {
					$oldProfileImages = unserialize($client->profile_pic);
				}
				$client->profile_pic = serialize($image);
			}

			if ($client->save()) {
				if (isset($oldImages)) {
					foreach ($oldImages as $oldImage) {
						try {
							if (!unlink(public_path($oldImage['src'])))
								throw new Exception("Old files not deleted...");
						} catch (Exception $e) {
							echo $e->getMessage();
						}
					}
				}
				if (isset($oldProfileImages)) {
					foreach ($oldProfileImages as $oldImage) {
						try {
							if (!unlink(public_path($oldImage['src'])))
								throw new Exception("Old profile image not deleted...");
						} catch (Exception $e) {
							echo $e->getMessage();
						}
					}
				}
				$client = Client::find($id);

				$this->success_msg = 'Other Information successfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				return redirect("/business-owners");
			} else {
				return redirect("/business-owners");
			}
		} else if ($request->has('fourth_form_submit')) {
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');


			$image = [];
			if (!empty($client->pictures)) {
				$oldImages = unserialize($client->pictures);
			}
			$filePath = getFolderStructure();
			for ($i = 0; $i < 12; $i++) {
				if ($request->hasFile('image' . ($i + 1))) {
					$file = $request->file('image' . ($i + 1));
					if ($file->getClientSize() != null) {
						$filename = str_replace(' ', '_', $file->getClientOriginalName());
						$destinationPath = public_path($filePath);
						$nameArr = explode('.', $filename);
						$ext = array_pop($nameArr);
						$name = implode('_', $nameArr);
						if (file_exists($destinationPath . '/' . $filename)) {
							$filename = $name . "_" . time() . '.' . $ext;
						}
						$file->move($destinationPath, $filename);

						$image[$i]['large'] = array(
							'name' => $filename,
							'alt' => $filename,
							'width' => '150px',
							'height' => '150px',
							'src' => $filePath . "/" . $filename
						);

					}

				} else if (isset($_FILES['image' . ($i + 1)]) && $_FILES['image' . ($i + 1)]['size'] == 0) {
				} else {
					if (isset($oldImages)) {
						if (array_key_exists($i, $oldImages)) {
							$image[$i] = $oldImages[$i];
						}
						unset($oldImages[$i]);
					}
				}
			}
			if (count($image) > 0) {
				$client->pictures = serialize($image);
			} else {
				$client->pictures = '';
			}

			if ($client->save()) {
				if (isset($oldImages)) {
					foreach ($oldImages as $oldImage) {
						try {
							if (!unlink(public_path($oldImage['large']['src'])))
								throw new Exception("Old files not deleted...");
							if (!unlink(public_path($oldImage['thumbnail']['src'])))
								throw new Exception("Old files not deleted...");
						} catch (Exception $e) {
							echo $e->getMessage();
						}
					}
				}
				$client = Client::find($id);


				$this->success_msg = 'Profile gallary Pic successfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				return redirect("/business-owners");
			} else {
				return redirect("/business-owners");
			}
		}
	}


	/**
	 * Send client registration mail to client containing user name password.
	 *
	 * @param  object  $client
	 */
	public function sendUandP($client, $usr, $pass)
	{
		Mail::send('emails.register', ['client' => $client, 'usr' => $usr, 'pass' => $pass], function ($m) use ($client) {
			$m->from('care@quickdials.in', 'Quick Dials');
			$m->to($client->email, $client->first_name . " " . $client->last_name)->subject('Quick Dials Login Credentials')->cc('clients@quickdials.in');
		});
	}

	/**
	 * Return Paginated Assigned Keywords
	 *
	 * @param $request - Request class instance
	 * @param $id - ClientID
	 * @return JSON object containing payload
	 */
	public function getPaginatedAssignedKeywords(Request $request)
	{
		if ($request->ajax()) {
			$clientID = auth()->guard('clients')->user()->id;
			$leads = DB::table('assigned_kwds')
				->join('citylists', 'assigned_kwds.city_id', '=', 'citylists.id')
				->join('parent_category', 'assigned_kwds.parent_cat_id', '=', 'parent_category.id')
				->join('child_category', 'assigned_kwds.child_cat_id', '=', 'child_category.id')
				->join('keyword', 'assigned_kwds.kw_id', '=', 'keyword.id')
				->select('assigned_kwds.*', 'citylists.city', 'parent_category.parent_category', 'child_category.child_category', 'keyword.keyword')
				->orderBy('assigned_kwds.created_at', 'desc')
				->where('assigned_kwds.client_id', $clientID)
				->paginate($request->input('length'));

			$returnLeads = $data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			foreach ($leads as $lead) {
				$data[] = [
					$lead->keyword,
					$lead->parent_category,
					$lead->child_category,
					$lead->city,

				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);

		}
	}


	/**
	 * Get paginated leads.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function getPaginatedPaymentHistory(Request $request)
	{
		$clientID = auth()->guard('clients')->user()->id;
		$payments = DB::table('payment_histories')
			->where('client_id', $clientID)
			->orderBy('created_at', 'desc')
			->paginate($request->input('length'));

		$returnLeads = $data = [];
		$returnLeads['draw'] = $request->input('draw');
		$returnLeads['recordsTotal'] = $payments->total();
		$returnLeads['recordsFiltered'] = $payments->total();
		foreach ($payments as $payment) {
			$action = '';
			$separator = '';
			$action .= $separator . '<a href="javascript:void(0)" data-toggle="popover" title="Invoice PDF" id="paymentPrint" data-trigger="hover" data-placement="left" data-sid="' . $payment->id . '"><i aria-hidden="true" class="fa fa-file-pdf-o"></i></a>';

			$data[] = [
				date_format(date_create($payment->created_at), 'd M Y'),
				$payment->paid_amount,
				$payment->gst_tax,
				$payment->total_amount,
				$payment->payment_mode,


			];
		}
		$returnLeads['data'] = $data;
		return response()->json($returnLeads);

	}



	/**
	 * Return paginated resources.
	 *
	 * @return JSON Payload.
	 */
	public function getLeads(Request $request)
	{
		if ($request->ajax()) {

			$clientID = auth()->guard('clients')->user()->id;


			$leads = DB::table('leads')
				->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
			 	->select('leads.*', 'assigned_leads.client_id', 'assigned_leads.lead_id', 'assigned_leads.created_at as created')
				->orderBy('assigned_leads.created_at', 'desc')
				->where('assigned_leads.client_id', $clientID)
				->paginate($request->input('length'));

			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			foreach ($leads as $lead) {
				$data[] = [
					$lead->name,
					$lead->mobile,
					$lead->email,
					$lead->kw_text,
					$lead->city_name,
					date_format(date_create($lead->created), 'd-m-Y H:i:s')
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);

		}
	}


	/**
	 * Return paginated resources.
	 *
	 * @return JSON Payload.
	 */
	public function getDiscussion(Request $request)
	{
		if ($request->ajax()) {

			$clientID = auth()->guard('clients')->user()->id;
			$discussion = DB::table('client_discussion')
				->orderBy('id', 'desc')
				->where('client_id', $clientID)
				->paginate($request->input('length'));

			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $discussion->total();
			$returnLeads['recordsFiltered'] = $discussion->total();

			foreach ($discussion as $lead) {
				$data[] = [
					date_format(date_create($lead->createdate), 'd-m-Y H:i:s'),
					$lead->discussion,
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);

		}
	}

	/**
	 * Export assigned leads.
	 */
	public function getLeadsExcel(Request $request)
	{
		$clientID = auth()->guard('clients')->user()->id;

		$assignedKWDS = DB::table('leads')
			->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
			->join('cities', 'leads.city_id', '=', 'cities.id')
			->select('leads.*', 'assigned_leads.client_id', 'assigned_leads.lead_id', 'cities.city')
			->orderBy('leads.created_at', 'desc')
			->where('assigned_leads.client_id', $clientID)
			->get();

		$arr = [];
		foreach ($assignedKWDS as $assKWDS) {
			$arr[] = [
				'Name' => $assKWDS->name,
				'Mobile' => $assKWDS->mobile,
				'Email' => $assKWDS->email,
				'Course' => $assKWDS->kw_text,
				'City' => $assKWDS->city,
				'Date' => date_format(date_create($assKWDS->created_at), 'd-m-Y H:i:s'),
			];
		}
		$excel = \App::make('excel');
		Excel::create('assigned_leads', function ($excel) use ($arr) {
			$excel->sheet('Sheet 1', function ($sheet) use ($arr) {
				$sheet->fromArray($arr);
			});
		})->export('csv');
	}


	/**
	 * Handling client remark
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function discussion(Request $request)
	{

		if ($request->input('discussion_form_submit') == 'Submit') {

			$admin_id = $request->input('admin-id');
			$client_id = $request->input('client-id');
			$discussion = $request->input('clientremark');
			$add_data = array(
				'client_id' => $client_id,
				'admin_id' => $admin_id,
				'name' => auth()->guard('clients')->user()->business_name,
				'discussion' => $discussion,
			);
			$add = DB::table('client_discussion')->insert($add_data);
			if ($add) {

				$resulsu = "Discussion Information Successfully";
				return response()->json(['status' => 1, 'result' => $resulsu]);
			} else {

				return response()->json(['status' => 0, 'result' => 'discussion Information not assigned']);
			}

		}
	}
}
