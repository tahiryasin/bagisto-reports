<?php

namespace Tahiryasin\Reports\Http\Controllers\Admin;


use Webkul\Shop\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Excel;
use Webkul\Admin\Exports\DataGridExport;

class ReportsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    public function generate()
    {
        $criteria = request()->all();

        $format ='xls';

        $path = $criteria['gridName'];
        $gridName = explode("\\", $criteria['gridName']);
        $fileName = sprintf("%s_%s", last($gridName), time());

        $gridInstance = app($path);
        $records = $gridInstance->export();

        if (! count($records)) {
            session()->flash('warning', trans('admin::app.export.no-records'));
            return redirect()->back();
        }

        if ($format == 'csv') {
            return Excel::download(new DataGridExport($records), $fileName.'.csv');
        }

        if ($format == 'xls') {
            return Excel::download(new DataGridExport($records), $fileName.'.xlsx');
        }
    }

}
