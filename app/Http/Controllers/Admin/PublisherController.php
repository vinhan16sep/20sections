<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Repositories\Eloquents\OrmUserRepository;

class PublisherController extends Controller
{
    /**
     * @var OrmUserRepository
     */
    protected $ormUserRepository;

    /**
     * PublisherController constructor.
     * @param OrmUserRepository $ormUserRepository
     */
    public function __construct(OrmUserRepository $ormUserRepository)
    {
        $this->ormUserRepository = $ormUserRepository;
    }

    public function index(){
        $searchCriteria = [
            'name' => Input::get('search'),
            'dateRange' => Input::get('search_date'),
        ];

        $dateFrom = null;
        $dateTo = null;
        if($searchCriteria['dateRange'] != ''){
            $date = explode(' - ', $searchCriteria['dateRange']);
            if(count($date) == 2){
                $dateFrom = date('Y-m-d',strtotime($date[0]));
                $dateTo = date('Y-m-d 23:59:59',strtotime($date[1]));
            }
        }
        $publisher = $this->ormUserRepository->fetchAllWithPagination(10, $searchCriteria, $dateFrom, $dateTo, 99);
        $publisher->setPath('publisher?search='.$searchCriteria['name'].'&search_date='.$searchCriteria['dateRange']);

        return view('admin.publisher.index', ['publisher' => $publisher, 'dateRange' => $searchCriteria['dateRange'], 'keyword' => $searchCriteria['name']]);
    }
}
