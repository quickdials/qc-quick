<?php

namespace App\Http\Controllers\Business;

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
use App\Http\Controllers\SitemapsController as SMC;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Zone;
use App\Models\Lead;
use App\Models\User;
use App\Models\Keyword;
use App\Models\LeadFollowUp;
use App\Models\Status;
use App\Models\AssignedLead;
use App\Models\AssigneddArea;
use App\Models\Citieslists;
use App\Models\AssignedZone;
use App\Models\State;
class ProfileController extends Controller
{
	protected $danger_msg = '';
	protected $success_msg = '';
	protected $warning_msg = '';
	protected $info_msg = '';
	protected $redirectTo = '/business-owners';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request)
	{

	}

	public function profileInfo(Request $request)
	{
		$clientID = auth()->guard('clients')->user()->id;
		$client = Client::find($clientID);
		$states = State::get();
		return view('business.profile', ['client' => $client,'states'=>$states]);
	}



	public function saveProfileInfo(Request $request, $id)
	{
		if ($request->ajax()) {

			$validator = Validator::make($request->all(), [

				'business_name' => 'required|max:255',
				'email' => 'required',
				'landmark' => 'required',
				'address' => 'required',
				'business_city' => 'required',
				'state' => 'required',
				'country' => 'required',
			]);

			if ($validator->fails()) {
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status' => 1, 'errors' => $errorsBag], 400);
			}


			$client = Client::find($id);
			$string = $request->input('business_name');
			$string = filter_var($string, FILTER_SANITIZE_STRING);
			$string = preg_replace('/[^A-Za-z0-9]/', ' ', $string);
			$string = preg_replace('/\s+/', ' ', str_replace('&', '', trim($string)));		
			$client->business_name = $string;
			$client->email = $request->input('email');
			$client->address = $request->input('address');
			$client->landmark = $request->input('landmark');
			$client->business_city = $request->input('business_city');
			$client->state = $request->input('state');
			$client->country = $request->input('country');
			$client->area = $request->input('area');
			$client->year_of_estb = $request->input('year_of_estb');
			$client->business_intro = $request->input('business_intro');
			$client->certifications = $request->input('certifications');
			$client->display_hofo = $request->input('display_hofo');

			if (!empty($request->input('time'))) {
				$client->time = serialize($request->input('time'));
			}

			if ($client->save()) {
				$status = 1;
				$msg = "Personal Details updated successfully !";
			} else {
				$status = 0;
				$msg = "Personal Details could not be successfully, Please try again !";
			}
			return response()->json(['status' => $status, 'msg' => $msg], 200);
		}

	}
	public function saveBusinessLocation(Request $request, $id)
	{
		if ($request->ajax()) {

			if ($request->input('zone_id') == "Other") {
				$validator = Validator::make($request->all(), [
					'state_id' => 'required|max:32',
					'cityiesid' => 'required|max:32',
					'other' => 'required|min:3|max:32|regex:/^(?!.*(.)\1{3,}).+$/',
				]);

			} else {
				$validator = Validator::make($request->all(), [
					//'city_id' 	=> 'required|max:35',
					//'zone_id' => 'required|max:35',
					'state_id' => 'required|max:32',
				]);
			}

			if ($validator->fails()) {
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status' => 1, 'errors' => $errorsBag], 400);
			}
			$client = Client::find($id);
			if (empty($request->input('zone_id')) && !empty($request->input('cityiesid')) && !empty($request->input('state_id'))) {

				$zones = Zone::where('city_id', $request->input('cityiesid'))->get();
				if (!empty($zones)) {
					foreach ($zones as $zone) {
						$assignedZone = new AssignedZone;
						$assignedZone->city_id = $request->input('cityiesid');
						$assignedZone->zone_id = $zone->id;
						$assignedZone->client_id = $client->id;
						$assignedZone->state_id = $request->input('state_id');
						$checkAssignedZone = AssignedZone::where('client_id', $client->id)->where('zone_id', $zone->id)->where('city_id', $request->input('cityiesid'))->where('state_id', $request->input('state_id'))->first();

						if (empty($checkAssignedZone)) {
							if ($assignedZone->save()) {

								$areas = DB::table('areas');
								$areas = $areas->where('areas.zone_id', '=', $zone->id);
								$areas = $areas->select('areas.id', 'areas.area');
								$areas = $areas->get();
								if (!empty($areas)) {
									foreach ($areas as $area) {
										$assigneddArea = new AssigneddArea;
										$assigneddArea->client_id = $client->id;
										$assigneddArea->state_id = $request->input('state_id');
										$assigneddArea->city_id = $request->input('cityiesid');
										$assigneddArea->assigned_zone_id = $zone->id;
										$assigneddArea->area_id = $area->id;
										$checkAssignedArea = AssigneddArea::where('client_id', $client->id)->where('assigned_zone_id', $zone->id)->where('city_id', $request->input('cityiesid'))->where('area_id', $area->id)->where('state_id', $request->input('state_id'))->first();
										if (empty($checkAssignedArea)) {
											$assigneddArea->save();
										} else {
											$already = 1;
										}

									}
								}
								$add = 1;
							}
						} else {
							$already = 1;

						}
					}
				}
				if (!empty($add)) {
					$status = true;
					$msg = 'Business Location add successfully';
					$code = 200;
				} else {
					if (!empty($already)) {
						$status = 0;
						$msg = "Already exists all City, Please add right city !";
						$code = 400;
					} else {
						$status = false;
						$msg = 'City not assigned';
						$code = 400;
					}

				}




			} else if (empty($request->input('zone_id')) && empty($request->input('cityiesid')) && !empty($request->input('state_id'))) {

				//state
				$states = State::where('id', $request->input('state_id'))->first();
				$cities = Citieslists::where('state_id', $states->id)->get();
				if (!empty($cities)) {
					foreach ($cities as $citis) {

						$zones = Zone::where('city_id', $citis->id)->get();
						if (!empty($zones)) {
							foreach ($zones as $zone) {
								$assignedZone = new AssignedZone;
								$assignedZone->city_id = $citis->id;
								$assignedZone->zone_id = $zone->id;
								$assignedZone->client_id = $client->id;
								$assignedZone->state_id = $states->id;
								$checkAssignedZone = AssignedZone::where('client_id', $client->id)->where('zone_id', $zone->id)->where('city_id', $citis->id)->where('state_id', $states->id)->first();

								if (empty($checkAssignedZone)) {
									if ($assignedZone->save()) {
										$areas = DB::table('areas');
										$areas = $areas->where('areas.zone_id', '=', $zone->id);
										$areas = $areas->select('areas.id', 'areas.area');
										$areas = $areas->get();
										if (!empty($areas)) {
											foreach ($areas as $area) {
												$assigneddArea = new AssigneddArea;
												$assigneddArea->client_id = $client->id;
												$assigneddArea->state_id = $states->id;
												$assigneddArea->city_id = $citis->id;
												$assigneddArea->assigned_zone_id = $zone->id;
												$assigneddArea->area_id = $area->id;
												$checkAssignedArea = AssigneddArea::where('client_id', $client->id)->where('assigned_zone_id', $zone->id)->where('city_id', $citis->id)->where('area_id', $area->id)->where('state_id', $states->id)->first();
												if (empty($checkAssignedArea)) {
													$assigneddArea->save();
												}
											}
										}
									}
									$add = 1;
								} else {
									$already = 1;
								}
							}
						}
					}
				}
				if (!empty($add)) {
					$status = true;
					$msg = 'Business Location add successfully';
					$code = 200;
				} else {
					if (!empty($already)) {
						$status = 0;
						$msg = "Already exists, Please add right city !";
						$code = 400;
					} else {
						$status = false;
						$msg = 'City not assigned';
						$code = 400;
					}
				}

			} elseif (!empty($request->input('zone_id')) && ($request->input('zone_id') != 'Other') && !empty($request->input('cityiesid')) && !empty($request->input('state_id'))) {
				//zone
				$assignedZone = new AssignedZone;
				$assignedZone->city_id = $request->input('cityiesid');
				$assignedZone->zone_id = $request->input('zone_id');
				$assignedZone->client_id = $request->input('client_id');
				$assignedZone->state_id = $request->input('state_id');
				$checkAssignedZone = AssignedZone::where('client_id', $request->input('client_id'))->where('zone_id', $request->input('zone_id'))->where('city_id', $request->input('cityiesid'))->first();

				if (empty($checkAssignedZone)) {
					if ($assignedZone->save()) {
						$areas = DB::table('areas');
						$areas = $areas->where('areas.zone_id', '=', $request->input('zone_id'));
						$areas = $areas->select('areas.id', 'areas.area');
						$areas = $areas->get();
						if (!empty($areas)) {
							foreach ($areas as $area) {
								$assigneddArea = new AssigneddArea;
								$assigneddArea->client_id = $request->input('client_id');
								$assigneddArea->state_id = $request->input('state_id');
								$assigneddArea->city_id = $request->input('cityiesid');
								$assigneddArea->assigned_zone_id = $request->input('zone_id');
								$assigneddArea->area_id = $area->id;
								$checkAssignedArea = AssigneddArea::where('client_id', $request->input('client_id'))->where('assigned_zone_id', $request->input('zone_id'))->where('city_id', $request->input('cityiesid'))->where('area_id', $area->id)->where('state_id', $request->input('state_id'))->first();
								if (empty($checkAssignedArea)) {
									$assigneddArea->save();

								}
							}
						}
						$add = 1;
					}
				} else {
					$already = 1;
				}


				if (!empty($add)) {
					$status = 1;
					$msg = "Business Location updated successfully !";
				} else {

					if (!empty($already)) {
						$status = 0;
						$msg = "Already exists, Please add right city !";
						$code = 400;
					} else {
						$status = false;
						$msg = "Business Location could not be successfully, Please try again !";
						$code = 400;
					}
				}
			} else if (!empty($request->input('zone_id') == 'Other') && !empty($request->input('cityiesid')) && !empty($request->input('state_id')) && !empty($request->input('other'))) {

				//Other
				$assignedZone = new AssignedZone;
				$assignedZone->city_id = $request->input('cityiesid');
				if ($request->input('zone_id') == "Other") {
					$checkZone = Zone::where('zone', $request->input('other'))->where('city_id', $request->input('cityiesid'))->first();
					if (empty($checkZone)) {
						$zone = new Zone;
						$zone->city_id = $request->input('cityiesid');
						$zone->zone = ucfirst($request->input('other'));
						$zone->save();
						$zone_id = $zone->id;
					} else {
						$zone_id = $checkZone->id;
					}

				} else {
					$zone_id = $request->input('zone_id');
				}
				$assignedZone->zone_id = $zone_id;
				$assignedZone->client_id = $request->input('client_id');
				$assignedZone->state_id = $request->input('state_id');
				$checkAssignedZone = AssignedZone::where('client_id', $request->input('client_id'))->where('zone_id', $zone_id)->where('city_id', $request->input('cityiesid'))->where('state_id', $request->input('state_id'))->first();
				if (empty($checkAssignedZone)) {
					if ($assignedZone->save()) {
						$status = 1;
						$msg = "Business Location updated successfully !";
					} else {
						$status = 0;
						$msg = "Business Location could not be successfully, Please try again !";
					}
				} else {
					$status = 0;
					$msg = "Already exists <strong>" . $request->input('other') . "</strong> Please add right zone !";
				}

			}


			return response()->json(['status' => $status, 'msg' => $msg], 200);
		}

	}
}
