<?php

namespace Tahiryasin\Reports\DataGrids;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webkul\Core\Models\Channel;
use Webkul\Core\Models\Locale;
use Webkul\Ui\DataGrid\DataGrid;

class InventoryReport extends DataGrid
{
    /**
     * Default sort order of datagrid.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Set index columns, ex: id.
     *
     * @var string
     */
    protected $index = 'product_id';


    /**
     * Locale.
     *
     * @var string
     */
    protected $locale = 'all';

    /**
     * Channel.
     *
     * @var string
     */
    protected $channel = 'all';

    /**
     * Contains the keys for which extra filters to show.
     *
     * @var string[]
     */
    protected $extraFilters = [
        'channels',
        'locales',
    ];

    /**
     * Create datagrid instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* locale */
        $this->locale = core()->getRequestedLocaleCode();

        /* channel */
        $this->channel = core()->getRequestedChannelCode();

        /* parent constructor */
        parent::__construct();
    }

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $report_from = request()->post('report_from');
        $report_to = request()->post('report_to');

        if($report_from)
            $report_from = Carbon::createFromFormat('Y-m-d', $report_to)->startOfDay();
        if($report_to)
            $report_to = Carbon::createFromFormat('Y-m-d', $report_to)->endOfDay();

        $whereInChannels = [$this->channel];
        $whereInLocales = [$this->locale];

        /* query builder */
        $queryBuilder = DB::table('product_flat')

            ->leftJoin('products', 'product_flat.product_id', '=', 'products.id')
            ->leftJoin('product_inventories', 'product_flat.product_id', '=', 'product_inventories.product_id')
            ->select(
                'product_flat.product_id',
                'products.sku as product_sku',
                DB::raw('CASE WHEN product_flat.name IS NOT NULL THEN product_flat.name ELSE "NULL" END as product_name'),
                DB::raw('CASE WHEN product_inventories.qty IS NOT NULL THEN SUM(' . DB::getTablePrefix() . 'product_inventories.qty) ELSE 0 END as quantity')
            );

        if($report_from && $report_to)
            $queryBuilder->whereBetween('product_flat.created_at', [$report_from, $report_to]);

        $queryBuilder->groupBy('product_flat.product_id', 'product_flat.locale', 'product_flat.channel');

        $queryBuilder->whereIn('product_flat.locale', $whereInLocales);
        $queryBuilder->whereIn('product_flat.channel', $whereInChannels);
        $queryBuilder->where('product_flat.status', 1);

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {


    }



}
