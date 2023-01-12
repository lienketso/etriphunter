<?php
namespace Modules\Flight\Controllers;

use App\Http\Controllers\Controller;
use Modules\Flight\Models\SeatType;
use Modules\Location\Models\LocationCategory;
use Modules\Flight\Models\Flight;
use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Review\Models\Review;
use Modules\Core\Models\Attributes;
use DB;

class FlightController extends Controller
{
    protected $flightClass;
    protected $locationClass;
    /**
     * @var string
     */
    private $locationCategoryClass;

    public function __construct()
    {
        $this->flightClass = Flight::class;
        $this->locationClass = Location::class;
    }

    public function callAction($method, $parameters)
    {
        if(!Flight::isEnable())
        {
            return redirect('/');
        }
        return parent::callAction($method, $parameters); // TODO: Change the autogenerated stub
    }

    public function index(Request $request)
    {

        $is_ajax = $request->query('_ajax');
        $list = call_user_func([$this->flightClass,'search'],$request);
        $markers = [];
        if (!empty($list)) {
            foreach ($list as $row) {
                $markers[] = [
                    "id"      => $row->id,
                    "title"   => $row->title,
                    "lat"     => (float)$row->map_lat,
                    "lng"     => (float)$row->map_lng,
                    "gallery" => $row->getGallery(true),
                    "infobox" => view('Flight::frontend.layouts.search.loop-grid', ['row' => $row,'disable_lazyload'=>1,'wrap_class'=>'infobox-item'])->render(),
                    'marker' => get_file_url(setting_item("flight_icon_marker_map"),'full') ?? url('images/icons/png/pin.png'),
                ];
            }
        }
        $limit_location = 15;
        if( empty(setting_item("flight_location_search_style")) or setting_item("flight_location_search_style") == "normal" ){
            $limit_location = 1000;
        }
        //location detail search
        $location_detail = $this->locationClass::where('id',$request->to_where)->first();
        if(!empty($location_detail->trip_ideas)){
            $trip_ideas = $location_detail->trip_ideas;
        }else{
            $trip_ideas = [];
        }
        $data = [
            'rows'               => $list,
            'list_location'      => $this->locationClass::where('status', 'publish')->limit($limit_location)->with(['translations'])->get()->toTree(),
            'seatType'           => SeatType::get(),
            'flight_min_max_price' => $this->flightClass::getMinMaxPrice(),
            'markers'            => $markers,
            "blank" => setting_item('search_open_tab') == "current_tab" ? 0 : 1 ,
            "seo_meta"           => $this->flightClass::getSeoMetaForPageList(),
            'trip_ideas'        =>$trip_ideas
        ];
        $layout = setting_item("flight_layout_search", 'normal');
        if ($request->query('_layout')) {
            $layout = $request->query('_layout');
        }
        if ($is_ajax) {
            return $this->sendSuccess([
                'html'    => view('Flight::frontend.layouts.search-map.list-item', $data)->render(),
                "markers" => $data['markers']
            ]);
        }
        $data['attributes'] = Attributes::where('service', 'flight')->orderBy("position","desc")->with(['terms'=>function($query){
            $query->withCount('flight');
        },'translations'])->get();

        if ($layout == "map") {
            $data['body_class'] = 'has-search-map';
            $data['html_class'] = 'full-page';
            return view('Flight::frontend.search-map', $data);
        }
        return view('Flight::frontend.search', $data);
    }

    public function getData(Request $request,$id){
        $row = $this->flightClass::with(['flightSeat.seatType','airportFrom','airportTo','airline','bookingPassengers'])->find($id);
        if ( empty($row)) {
            return $this->sendError('no found');
        }else{
            if(!empty($row->airline)){
                $row->airline->append(['image_url']);
            }
            $bookingPassengers = $row->bookingPassengers->countBy('seat_type')->toArray();
            if(!empty($row->flightSeat)){
                foreach ($row->flightSeat as &$value){
                    if(!empty($bookingPassengers[$value->seat_type])){
                        $value->max_passengers = $value->max_passengers - $bookingPassengers[$value->seat_type];
                        if($value->max_passengers <0){
                            $value->max_passengers = 0;
                        }
                    }
                    $value->price_html = format_money($value->price);
                    $value->number = 0;
                }
            }
            $row->departure_time_html = $row->departure_time->format('H:i');
            $row->departure_date_html = $row->departure_time->format('D, d M y');
            $row->arrival_time_html = $row->arrival_time->format('H:i');
            $row->arrival_date_html = $row->arrival_time->format('D, d M y');

            return $this->sendSuccess(['data'=>$row->toArray()],'founded');
        }
    }
}
