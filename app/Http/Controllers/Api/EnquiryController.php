<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Client\Client;
use Validator;
use DB;
use Excel;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use App\Models\LeadFollowUp;
use App\Models\Status;
use App\Models\AssignedLead;

class EnquiryController extends Controller
{
	protected $danger_message = '';
	protected $success_message = '';
	protected $warning_message = '';
	protected $info_message = '';
	protected $redirectTo = '/business-owners';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request)
	{

	}




	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function followUp(Request $request, $id)
	{
		if ($request->ajax()) {

			$clientID = auth()->guard('clients')->user()->id;
			$lead = DB::table('leads')
				->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
				->select('leads.*', 'assigned_leads.client_id', 'assigned_leads.lead_id', 'assigned_leads.created_at as created')
				->orderBy('assigned_leads.created_at', 'desc')
				->where('assigned_leads.client_id', $clientID)->where('leads.id', $id)->first();

			$leadLastFollowUp = DB::table('lead_follow_ups as lead_follow_ups')
				->where('lead_follow_ups.lead_id', '=', $id)
				->where('lead_follow_ups.client_id', '=', $clientID)
				->select('lead_follow_ups.*')
				->orderBy('lead_follow_ups.id', 'desc')
				->first();

			$statuses = DB::table('status')->where('lead_follow_up', 1)->get();

 			$statusHtml = '';
			$disabled = '';
			$dateValue = '';
			if (count($statuses) > 0) {
				foreach ($statuses as $status) {
					if (strcasecmp($status->name, 'new lead')) {
						$selected = '';
						if (isset($leadLastFollowUp->status) && $leadLastFollowUp->status == $status->id) {
							$selected = 'selected';

							if ($leadLastFollowUp->expected_date_time != NULL) {
								$dateValue = date_format(date_create($leadLastFollowUp->expected_date_time), 'd-F-Y g:i A');
							}

						}
						$statusHtml .= '<option data-value="' . $status->show_exp_date . '" value="' . $status->id . '" ' . $selected . '>' . $status->name . '</option>';
					}
				}
			}

			$html = '<div class="row">
						<div class="x_content" style="padding:0">';
			$number = $lead->mobile;
			$html .= '<form class="form-label-left" method="post" onsubmit="return enquiryController.storeFollowUp(' . $id . ',this)">
				 
					 
				    <div class="row">
                        <div class="col-md-4" style="display:flex;">
                        <label for=" " class="col-md-3 col-lg-3 col-form-label">Name :</label>
                        
                        <p name="name" type="text" class="form-control-static" > ' . $lead->name . '</p>
                        </div>
                        	
                        <div class="col-md-4" style="display:flex;">
                        <label for="" class="col-md-3 col-lg-3 col-form-label">Email :</label>
                         	 <p name="email" type="text" class="form-control-static" > ' . $lead->email . '</p>
                        </div>
                        
                         <div class="col-md-4" style="display:flex;">
                         <label for=" " class="col-md-3 col-lg-3 col-form-label">Mobile :</label>
                         <p name="mobile" type="tel" class="form-control-static" > ' . $lead->mobile . '</p>
                        </div>
                        
                    </div>
				 					 
				     <div class="row">
                           <div class="col-md-4" style="display:flex;">
                         <label for="" class="col-md-3 col-lg-3 col-form-label">City :</label>
                         	 <p name="city name" type="text" class="form-control-static" > ' . $lead->city_name . '</p>
                        </div>
                       
                        <div class="col-md-4" style="display:flex;">
                         <label for="" class="col-md-3 col-lg-4 col-form-label">Keyword :</label>
                         	 <p name="keyword" type="text" class="form-control-static" > ' . $lead->kw_text . '</p>
                        </div>
                        
                         <div class="col-md-4" style="display:flex;">
                         <label for="" class="col-md-3 col-lg-3 col-form-label">Date :</label>
                         	 <p name="date" type="text" class="form-control-static" > ' . date('d M Y', strtotime($lead->created)) . '</p>
                        </div>                        
                    </div>
								 
                <div class="row mb-3">
                
                <div class="col-md-4">
                <label for="" class="">Status :</label>
                <select class="select2_single form-control" name="status" tabindex="-1">
                <option value="">-- SELECT STATUS --</option> 
                ' . $statusHtml . '
                </select>
                
                </div>
                
                <div class="col-md-4">
                <label for="expected_date_time">Expected Date &amp; Time <span class="required">*</span></label>
                <input type="text" id="expected_date_time" name="expected_date_time" class="form-control" value="' . $dateValue . '" placeholder="Expected Date &amp; Time" ' . $disabled . ' autocomplete="off">
                </div>
                
                <div class="col-md-4">
                <label for="remark">Counsellor Remark <span class="required">*</span></label>
                <textarea name="remark" rows="1" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
                </div>
                <div class="form-group" style="float:right;">
                <div class="col-md-11" style="float:right;">
                	<label style="visibility:hidden">Submit</label>
                	<button type="submit" class="btn btn-success btn-block" name="submit" value="Submit">Submit</button>
                </div>
                </div>
							</form>';

			$html .= '</div>
					</div> 
					<p style="margin-top:10px;margin-bottom:3px;"><strong>Follow Up Status</strong>  <select onchange="javascript:enquiryController.getAllFollowUps()" class="follow-up-count"><option value="5">Last 5</option><option value="all">All</option></select></p>
					<div class="" style="overflow-x: none;">
						<table id="datatable-enquiry-followups" class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>Date</th>
									<th>Counsellor Remark</th>
									<th>Status</th>
									<th>Expected Date</th>
								</tr>
							</thead>
						</table>
					</div>';

			return response()->json(['status' => 1, 'html' => $html], 200);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function storeFollowUp(Request $request, $id)
	{
		if ($request->ajax()) {
			$validator = Validator::make($request->all(), [

				'status' => 'required',
				'remark' => 'required',

			]);
			if ($validator->fails()) {
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status' => 1, 'errors' => $errorsBag], 400);
			}

			// check now expected date and time if status is not - not interested/location issue
			$statusModel = Status::find($request->input('status'));
			//if($statusModel->name!='Not Interested' && $statusModel->name!='Location Issue'){
			if ($statusModel->show_exp_date) {
				$validator = Validator::make($request->all(), [
					'expected_date_time' => 'required',
				]);
				if ($validator->fails()) {
					$errorsBag = $validator->getMessageBag()->toArray();
					return response()->json(['status' => 1, 'errors' => $errorsBag], 400);
				}
			}

			$lead = Lead::find($id);
			if (!empty($lead)) {
				$leadFollowUp = new LeadFollowUp;
				$status = Status::findorFail($request->input('status'));
				if (!strcasecmp($status->name, 'npup')) {
					$npupCount = LeadFollowUp::where('lead_id', $id)->where('status', $status->id)->count();
					if ($npupCount >= 15) {
						$status = Status::where('name', 'LIKE', 'Not Interested')->first();
						$leadFollowUp->status = $status->id;
					} else {
						$leadFollowUp->status = $request->input('status');
					}
				} else {
					$leadFollowUp->status = $request->input('status');
				}


				$leadFollowUp->remark = trim($request->input('remark'));
				$leadFollowUp->lead_id = $id;
				$leadFollowUp->client_id = auth()->guard('clients')->user()->id;
				$leadFollowUp->expected_date_time = NULL;
				if ($request->input('expected_date_time') != '') {
					$leadFollowUp->expected_date_time = date('Y-m-d H:i:s', strtotime($request->input('expected_date_time')));
				}
				if ($leadFollowUp->save()) {
					return response()->json(['status' => 1], 200);
				}
			} else {

				return response()->json(['status' => 0, '' => "Enquiry not found"], 200);
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function getFollowUps(Request $request, $id)
	{
		if ($request->ajax()) {

			$leads = DB::table('lead_follow_ups as lead_follow_ups')
				->join('status as status', 'status.id', '=', 'lead_follow_ups.status')
				->where('lead_follow_ups.lead_id', '=', $id)
				->where('lead_follow_ups.client_id', '=', auth()->guard('clients')->user()->id)
				->select('lead_follow_ups.*', 'status.name as status_name')
				->orderBy('lead_follow_ups.id', 'desc');
			if ($request->input('count') != 'all') {
				$leads = $leads->take($request->input('count'));
			} else {
				$leads = $leads->take(100);
			}
			$leads = $leads->paginate($request->input('length'));
		 

			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			foreach ($leads as $lead) {
				$data[] = [
					(date('d-m-y h:i:s', strtotime($lead->created_at))),
					$lead->remark,
					$lead->status_name,
					(isset($lead->expected_date_time) ? date('d-m-y h:i A', strtotime($lead->expected_date_time)) : "")
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		}
	}

	/**
	 * Pause Lead by client.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * pause Lead status true
	 * @return \Illuminate\Http\Response
	 */
	public function pauseLead(Request $request)
	{
		if(!Auth::guard('sanctum')->check()) {
				return response()->json([
					'status' => false,
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
		}

			// Check if user is active
		$user = auth('sanctum')->user();
			if (!$user) {
				return response()->json([
					'status' => false,
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
			}

		$client = Client::find($user->id);
		if (!$client) {
			$data['status'] = false;
			$data['message'] = 'Client not found';
		}

		if ($request->pauseLead == 'true') {
			$client->pauseLead = 1;
		} else {
			$client->pauseLead = 0;
		}
		if ($client->save()) {
			$data['status'] = true;
			$data['message'] = 'Pause lead updated';
			 
		} else {
			$data['status'] = false;
			$data['message'] = 'Not Pause lead';
		}


		 echo json_encode($data);


	}

	/*
	* scrapLead by client
	* input field leadId
	*/
	public function scrapLead(Request $request)
	{
		if(!Auth::guard('sanctum')->check()) {
				return response()->json([
					'status' => false,
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
		}
		// Check if user is active
		$user = auth('sanctum')->user();
			if (!$user) {
				return response()->json([
					'status' => false,
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
			}
	 
		
		$assignedLead = AssignedLead::find($request->leadId);
		$coinsLeads = DB::table('assigned_leads')->where('lead_id',$assignedLead->lead_id)->where('scrapPay','0')->get();
		$scrapStatusLeads = DB::table('assigned_leads')->where('lead_id',$assignedLead->lead_id)->where('scrapLead','1')->get()->count();

		if(!empty($assignedLead)){
			if($coinsLeads->count() == $scrapStatusLeads + 1){
				foreach($coinsLeads as $coinsLead){
				$client = Client::find($coinsLead->client_id);
				$client->coins_amt =  $client->coins_amt + $coinsLead->coins;
				$client->save();
				$assignedclnLead = AssignedLead::find($coinsLead->id);
				$assignedclnLead->scrapPay = '1';
				$assignedclnLead->save();
				}
			}
				
			$assignedLead->scrapLead = '1';
			$assignedLead->scrapValue = $request->scrapValue;
			if($assignedLead->save()){
				$data['status'] = true;
				$data['message'] = "Scrap update successfully";
				
			} else {
				$data['status'] = false;
				$data['message'] = "Scrap update successfully";
			}

		}
  		echo json_encode($data);
	}

	public function readLead(Request $request)
	{
		if(!Auth::guard('sanctum')->check()) {
				return response()->json([
					'status' => false,
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
		}
		// Check if user is active
		$user = auth('sanctum')->user();
			if (!$user) {
				return response()->json([
					'status' => false,
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
			}
		$assignedLead = AssignedLead::find($request->assingId);
		if (!$assignedLead) {
			$data['status'] = true;
			$data['message'] = 'Read Lead not found';
		}

		$assignedLead->readLead = '1';
		if ($assignedLead->save()) {
			$data['status'] = true;
			$data['message'] = 'Read Lead updated';
		} else {
			$data['status'] = false;
			$data['message'] = 'Read Lead not update';
		}
		echo json_encode($data);
	}

	public function favoritleads(Request $request)
	{
		if(!Auth::guard('sanctum')->check()) {
				return response()->json([
					'status' => false,
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
		}
		// Check if user is active
		$user = auth('sanctum')->user();
			if (!$user) {
				return response()->json([
					'status' => false,
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
			}

		$assignedLead = AssignedLead::find($request->assingId);

		if (!$assignedLead) {
			$data['status']= false;
			$data['message']= 'assignedLead not found';
			 
		}

		$assignedLead->favoriteLead = '1';
		if ($assignedLead->save()) {
			$data['status']= true;
			$data['message']= 'favorit leads updated';
		} else {
			$data['status']= true;
			$data['message']= 'favorit leads not updated';
		}
		echo json_encode($data);
	}
	/**
	 * Return paginated resources.
	 *
	 * @return JSON Payload.
	 */
	public function getLeads(Request $request)
	{
		 if (!Auth::guard('sanctum')->check()) {
			return response()->json([
				'status' => false,
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                ], 401);
        }

		$user = auth('sanctum')->user();
		if (!$user) {
			return response()->json([
				'status' => false,
				'message' => 'Unauthenticated: Token is missing or invalid',
				'error' => 'token_missing_or_invalid'
			], 401);
		}

		 

			$perPage = $request->query('per_page', 10);
			$leads = DB::table('leads')
				->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
				->select('leads.*', 'assigned_leads.client_id', 'assigned_leads.lead_id', 'assigned_leads.created_at as created')
				->orderBy('assigned_leads.created_at', 'desc')
				->where('assigned_leads.client_id', $user->id)
				->paginate($perPage);
   			if (!empty($leads)) {
                foreach ($leads->items() as $key => $val) {
					if (!empty($val->zone)) {
						$zonename = $val->zone;
					} else {
						$zonename = "";
					}
                    $leads_list[$key] = array(
                        'lead_id' => $val->lead_id,
                        'name' => $val->name,
                        'mobile' => $val->mobile,
                        'email' => $val->email,
                        'city_id' => $val->city_id,
                        'cityName' => $val->city_name,
                        'kw_id' => $val->kw_id,
                        'kw_text' => $val->kw_text,
                        'client_id' => $val->client_id,
                        'createdDate' => $val->created,
                    );
                }
                $data['leadslist'] = $leads_list;
            }
            return response()->json([
                'status' => true,
                'data' => $data,
                'pagination' => [
                        'current_page' => $leads->currentPage(),
                        'per_page' => $leads->perPage(),
                        'total' => $leads->total(),
                        'last_page' => $leads->lastPage(),
                    ],
            ], 200);



	}

	public function enquiry(Request $request)
	{
		try {

            if (!Auth::guard('sanctum')->check()) {
                return response()->json([
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                ], 401);
            }

            $currentUser = auth('sanctum')->user();
            if (!$currentUser) {
                return response()->json([
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                ], 401);
            }

            if (!$currentUser->active_status) {
                $currentUser->tokens()->delete();
                return response()->json(['status' => false, 'message' => 'User account is inactive',], 403);
            }
            // Fetch users with pagination
            // Fetch users with pagination
            $perPage = $request->query('per_page', 10); // Default to 15 users per page
            $leads = DB::table('leads')
                ->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
                ->leftjoin('citylists', 'leads.city_id', '=', 'citylists.id')
                ->leftjoin('areas', 'leads.area_id', '=', 'areas.id')
                ->leftjoin('zones', 'leads.zone_id', '=', 'zones.id')
                ->select('leads.*', 'assigned_leads.client_id', 'assigned_leads.lead_id', 'assigned_leads.created_at as created', 'areas.area', 'zones.zone')
                ->orderBy('assigned_leads.created_at', 'desc')
                ->where('assigned_leads.client_id', $currentUser->id)
                ->paginate($perPage);

            if (!empty($leads)) {
                foreach ($leads->items() as $key => $val) {
                    $leads_list[$key] = array(
                        'lead_id' => $val->lead_id,
                        'name' => $val->name,
                        'mobile' => $val->mobile,
                        'email' => $val->email,
                        'city_id' => $val->city_id,
                        'cityName' => $val->city_name,
                        'area_id' => $val->area_id,
                        'area' => $val->area,
                        'zone_id' => $val->zone_id,
                        'zone' => $val->zone,
                        'kw_id' => $val->kw_id,
                        'kw_text' => $val->kw_text,
                        'client_id' => $val->client_id,
                        'createdDate' => $val->created,
                    );
                }
                $data['leadslist'] = $leads_list;
            }
            return response()->json([
                'status' => true,
                'data' => $data,
                'pagination' => [
                        'current_page' => $leads->currentPage(),
                        'per_page' => $leads->perPage(),
                        'total' => $leads->total(),
                        'last_page' => $leads->lastPage(),
                    ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
            ], 500);
        }


	}



	public function newEnquiry(Request $request)
	{

		 if (!Auth::guard('sanctum')->check()) {
                return response()->json([
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                ], 401);
            }

            $currentUser = auth('sanctum')->user();
            if (!$currentUser) {
                return response()->json([
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                ], 401);
            }
	
  		$perPage = $request->query('per_page', 10); 
		$leads = DB::table('leads')
			->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
			->leftjoin('citylists', 'leads.city_id', '=', 'citylists.id')
			->leftjoin('areas', 'leads.area_id', '=', 'areas.id')
			->leftjoin('zones', 'leads.zone_id', '=', 'zones.id')
			->select('leads.*', 'assigned_leads.*', 'assigned_leads.client_id as clientId', 'assigned_leads.lead_id', 'assigned_leads.id as assignId', 'assigned_leads.created_at as created', 'areas.area', 'zones.zone')
			->orderBy('assigned_leads.created_at', 'desc')
			->where('assigned_leads.readLead', '0')
			->where('assigned_leads.client_id', $currentUser->id)->paginate($perPage);
			if (!empty($leads)) {
                foreach ($leads->items() as $key => $val) {
                    $leads_list[$key] = array(
                        'lead_id' => $val->lead_id,
                        'name' => $val->name,
                        'mobile' => $val->mobile,
                        'email' => $val->email,
                        'city_id' => $val->city_id,
                        'cityName' => $val->city_name,
                        'area_id' => $val->area_id,
                        'area' => $val->area,
                        'zone_id' => $val->zone_id,
                        'zone' => $val->zone,
                        'kw_id' => $val->kw_id,
                        'kw_text' => $val->kw_text,
                        'client_id' => $val->client_id,
                        'createdDate' => $val->created,
                    );
                }
                $data['leadslist'] = $leads_list;
            }
            return response()->json([
                'status' => true,
                'data' => $data,
                'pagination' => [
                        'current_page' => $leads->currentPage(),
                        'per_page' => $leads->perPage(),
                        'total' => $leads->total(),
                        'last_page' => $leads->lastPage(),
                    ],
            ], 200);

		 echo json_encode($data);
	}

	public function myLead(Request $request)
	{

		if (!Auth::guard('sanctum')->check()) {
			return response()->json([
				'message' => 'Unauthenticated: Token is missing or invalid',
				'error' => 'token_missing_or_invalid'
			], 401);
		}

		$currentUser = auth('sanctum')->user();
		if (!$currentUser) {
			return response()->json([
				'message' => 'Unauthenticated: Token is missing or invalid',
				'error' => 'token_missing_or_invalid'
			], 401);
		}
	 
		$data['leads'] = DB::table('leads')
			->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
			->leftjoin('citylists', 'leads.city_id', '=', 'citylists.id')
			->leftjoin('areas', 'leads.area_id', '=', 'areas.id')
			->leftjoin('zones', 'leads.zone_id', '=', 'zones.id')
			->select('leads.*', 'assigned_leads.*', 'assigned_leads.client_id as clientId', 'assigned_leads.lead_id', 'assigned_leads.id as assignId', 'assigned_leads.created_at as created', 'areas.area', 'zones.zone')

			->orderBy('assigned_leads.created_at', 'desc')
			->where('assigned_leads.favoriteLead', '!=', '1')

			->where('assigned_leads.client_id', $currentUser->id)->get();

			echo json_encode($data);
		 
	}

	public function favoriteEnquiry(Request $request)
	{
		if (!Auth::guard('sanctum')->check()) {
			return response()->json([
				'message' => 'Unauthenticated: Token is missing or invalid',
				'error' => 'token_missing_or_invalid'
			], 401);
		}

		$currentUser = auth('sanctum')->user();
		if (!$currentUser) {
			return response()->json([
				'message' => 'Unauthenticated: Token is missing or invalid',
				'error' => 'token_missing_or_invalid'
			], 401);
		}

		$data['leads'] = DB::table('leads')
			->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
			->leftjoin('citylists', 'leads.city_id', '=', 'citylists.id')
			->leftjoin('areas', 'leads.area_id', '=', 'areas.id')
			->leftjoin('zones', 'leads.zone_id', '=', 'zones.id')
			->select('leads.*', 'assigned_leads.*', 'assigned_leads.client_id as clientId', 'assigned_leads.lead_id', 'assigned_leads.id as assignId', 'assigned_leads.created_at as created', 'areas.area', 'zones.zone')

			->orderBy('assigned_leads.created_at', 'desc')
			->where('assigned_leads.favoriteLead', '1')
			->where('assigned_leads.client_id', $currentUser->id)->get();
			echo json_encode($data);
	}


	/**
	 * Return paginated resources.
	 *
	 * @return JSON Payload.
	 */
	public function getEnquiry(Request $request)
	{
			if (!Auth::guard('sanctum')->check()) {
				return response()->json([
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
			}

			$currentUser = auth('sanctum')->user();
			if (!$currentUser) {
				return response()->json([
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
			}
			 
			$leads = DB::table('leads')
				->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
				->select('leads.*', 'assigned_leads.client_id', 'assigned_leads.lead_id', 'assigned_leads.created_at as created')
				->orderBy('assigned_leads.created_at', 'desc')
				->where('assigned_leads.client_id', $currentUser->id);
			if ($request->input('search.leaddf') != '') {
				$leads = $leads->whereDate('assigned_leads.created_at', '>=', date_format(date_create($request->input('search.leaddf')), 'Y-m-d'));
			}
			if ($request->input('search.leaddt') != '') {
				$leads = $leads->whereDate('assigned_leads.created_at', '<=', date_format(date_create($request->input('search.leaddt')), 'Y-m-d'));
			}

			$leads = $leads->paginate($request->input('length'));
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			$returnLeads['recordCollection'] = [];
			foreach ($leads as $lead) {

				$action = '';
				$separator = '';
				$action .= $separator . '<a href="javascript:enquiryController.getfollowUps(' . $lead->id . ')" title="followUp"><i class="bi bi-eye" aria-hidden="true"></i></a>';
				$separator = ' | ';
				$data[] = [
					$lead->name,
					$lead->mobile,
					$lead->email,
					$lead->kw_text,
					$lead->city_name,
					date_format(date_create($lead->created), 'd M, Y H:i'),
					$action
				];
				$returnLeads['recordCollection'][] = $lead->id;
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		
	}


	 


	public function manageEnquiry(Request $request)
	{

		if (!Auth::guard('sanctum')->check()) {
				return response()->json([
					'message' => 'Unauthenticated: Token is missing or invalid',
					'error' => 'token_missing_or_invalid'
				], 401);
			}

		$currentUser = auth('sanctum')->user();
		if (!$currentUser) {
			return response()->json([
				'message' => 'Unauthenticated: Token is missing or invalid',
				'error' => 'token_missing_or_invalid'
			], 401);
		}
		 
		$data['leads'] = DB::table('leads')
			->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
			->leftjoin('citylists', 'leads.city_id', '=', 'citylists.id')
			->leftjoin('areas', 'leads.area_id', '=', 'areas.id')
			->leftjoin('zones', 'leads.zone_id', '=', 'zones.id')
			->select('leads.*', 'assigned_leads.*', 'assigned_leads.client_id as clientId', 'assigned_leads.lead_id', 'assigned_leads.id as assignId', 'assigned_leads.created_at as created', 'areas.area', 'zones.zone')

			->orderBy('assigned_leads.created_at', 'desc')
			->where('assigned_leads.client_id', $currentUser->id)->limit('200')->get();
		echo json_encode($data);
	}

}
