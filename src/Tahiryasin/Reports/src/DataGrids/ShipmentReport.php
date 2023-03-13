<?php

namespace Tahiryasin\Reports\DataGrids;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webkul\Sales\Models\OrderAddress;
use Webkul\Ui\DataGrid\DataGrid;

class ShipmentReport extends DataGrid
{
    protected $index = 'shipment_id';

    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $from = request()->post('report_from');
        $to = request()->post('report_to');
        $report_from = Carbon::createFromFormat('Y-m-d', $from)->startOfDay();
        $report_to = Carbon::createFromFormat('Y-m-d', $to)->endOfDay();

        $queryBuilder = DB::table('shipments')
            ->whereBetween('shipments.created_at', [$report_from, $report_to])
            ->leftJoin('addresses as order_address_shipping', function($leftJoin) {
                $leftJoin->on('order_address_shipping.order_id', '=', 'shipments.order_id')
                    ->where('order_address_shipping.address_type', OrderAddress::ADDRESS_TYPE_SHIPPING);
            })
            ->leftJoin('orders as ors', 'shipments.order_id', '=', 'ors.id')
            ->leftJoin('inventory_sources as is', 'shipments.inventory_source_id', '=', 'is.id')
            ->select('shipments.id as shipment_id', 'ors.increment_id as order_id', 'shipments.total_qty as shipment_qty', 'ors.created_at as order_date', 'shipments.created_at as shipment_date')
            ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'order_address_shipping.last_name) as shipped_to'))
            ->selectRaw('IF(' . DB::getTablePrefix() . 'shipments.inventory_source_id IS NOT NULL,' . DB::getTablePrefix() . 'is.name, ' . DB::getTablePrefix() . 'shipments.inventory_source_name) as inventory_source');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
    }

}