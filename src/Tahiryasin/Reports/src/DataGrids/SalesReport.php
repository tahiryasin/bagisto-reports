<?php

namespace Tahiryasin\Reports\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Sales\Models\OrderAddress;
use Webkul\Ui\DataGrid\DataGrid;
use Carbon\Carbon;

class SalesReport extends DataGrid
{
    protected $index = 'status';
    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $from = request()->post('report_from');
        $to = request()->post('report_to');
        $report_from = Carbon::createFromFormat('Y-m-d', $from)->startOfDay();
        $report_to = Carbon::createFromFormat('Y-m-d', $to)->endOfDay();

        $queryBuilder = DB::table('orders')
            ->whereBetween('orders.created_at', [$report_from, $report_to])
            ->leftJoin('addresses as order_address_billing', function ($leftJoin) {
                $leftJoin->on('order_address_billing.order_id', '=', 'orders.id')
                    ->where('order_address_billing.address_type', OrderAddress::ADDRESS_TYPE_BILLING);
            })
            ->addSelect('orders.increment_id','base_grand_total_invoiced as invoiced_amount', 'base_grand_total_refunded as refund_amount')
            ->selectRaw('base_grand_total_invoiced - base_grand_total_refunded as net_sales')
            ->addSelect('orders.created_at', 'channel_name', 'status')
            ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'order_address_billing.last_name) as billed_to'));

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {

    }

}