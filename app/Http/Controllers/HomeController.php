<?php

namespace App\Http\Controllers;


use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            
            $homeData = $this->homeData();
//             dd($homeData);
            
            // Return view
            return view('pages.home')
                ->with('offers', $homeData['offers'])
                ->with('applicantsCount', $homeData['applicantsCount'])
                ->with('applicantsViewsChartData', $homeData['applicantsViewsChartData'])
                ->with('minDate', $homeData['minDate'])
                ->with('maxDate', $homeData['maxDate'])
                ->with('viewsCount', $homeData['viewsCount'])
                ->with('kiwixCount', $homeData['kiwixCount'])
                ->with('hiringCount', $homeData['hiringCount'])
            ;
            
        } catch (RequestException $e) {
            dd($e);
            $this->handleError($e->getCode());
        }
    }
    
    public function getHomeData(Request $request)
    {
        $offerId = $request->offerId == 0?null:$request->offerId;
        return $this->homeData($request->initDate, $request->endDate, $offerId);
    }
    
    private function homeData($initDate=null, $endDate=null, $offerId=null)
    {
        // Get admin user list
        // Build request body
        $body = [
            'adminUserId'   => session('admin.id'),
            'initDate'      => $initDate,
            'endDate'       => $endDate,
            'offerId'       => $offerId,
        ];
        
        // Store admin user
        $res = $this->client->post(env('API_BASE_URL').'admin/search-home',['body'=> json_encode($body)]);
        
        // Parse response
        $body = json_decode($res->getBody(),true);
        $response = $body;
        $counters = $response['counters'];
        
        // Build applicants views chart data
        $applicantsViewsChartData = array();
        $minDate = null;
        $maxDate = null;
        foreach ($counters['viewsOvertime'] as $viewOvertime) {
            // Calculate min and max date in array
            $currentDate = strtotime($viewOvertime['date'])*1000;
            if ($minDate == null) $minDate = $currentDate;
            if ($maxDate == null) $maxDate = $currentDate;
            if ($currentDate < $minDate) $minDate = $currentDate;
            if ($currentDate > $maxDate) $maxDate = $currentDate;
            
            // Build array data
            $applicantsViewsChartData[$currentDate]['views'] = $viewOvertime['views'];
            $applicantsViewsChartData[$currentDate]['applicants'] = 0;
        }
        
        foreach ($counters['applicantsOvertime'] as $applicantOvertime) {
            // Calculate min and max date in array
            $currentDate = strtotime($applicantOvertime['date'])*1000;
            if ($minDate == null) $minDate = $currentDate;
            if ($maxDate == null) $maxDate = $currentDate;
            if ($currentDate < $minDate) $minDate = $currentDate;
            if ($currentDate > $maxDate) $maxDate = $currentDate;
            
            // Build array data
            $applicantsViewsChartData[$currentDate]['applicants'] = $applicantOvertime['applicants'];
            $applicantsViewsChartData[$currentDate]['views'] = isset($applicantsViewsChartData[$currentDate]['views']) ? $applicantsViewsChartData[$currentDate]['views'] : 0;
        }
        
        $homeData = array(
            'offers'                    => $counters['offers'],
            'applicantsCount'           => $counters['applicantsCount'],
            'applicantsViewsChartData'  => $applicantsViewsChartData,
            'minDate'                   => $minDate,
            'maxDate'                   => $maxDate,
            'viewsCount'                => $counters['viewsCount'],
            'kiwixCount'                => $counters['kiwixCount'],
            'hiringCount'               => $counters['hiringCount']
        );
        
        return $homeData;
    }
    
}
