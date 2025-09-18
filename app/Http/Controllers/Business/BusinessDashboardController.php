<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class BusinessDashboardController extends Controller
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



	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function dashboard()
	{
		$clientID = auth()->guard('clients')->user()->id;
		$clientDetails = DB::table('clients')->where('id', $clientID)->first();
		$leads = DB::table('leads')
			->join('assigned_leads', 'leads.id', '=', 'assigned_leads.lead_id')
			->leftjoin('citylists', 'leads.city_id', '=', 'citylists.id')
			->leftjoin('areas', 'leads.area_id', '=', 'areas.id')
			->leftjoin('zones', 'leads.zone_id', '=', 'zones.id')
			->select('leads.*','assigned_leads.*','assigned_leads.client_id', 'assigned_leads.lead_id', 'assigned_leads.created_at as created', 'areas.area', 'zones.zone')

			->orderBy('assigned_leads.created_at', 'desc')
			->where('assigned_leads.client_id', $clientID)->get();
		return view('business.dashboard', ['leads' => $leads, 'clientDetails' => $clientDetails]);
	}
}
