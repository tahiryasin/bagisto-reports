<?php

namespace Tahiryasin\Reports\DataGrids;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webkul\Sales\Models\OrderAddress;
use Webkul\Ui\DataGrid\DataGrid;

class RefundReport extends DataGrid
{
    protected $index = 'refunds.id';

    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $from = request()->post('report_from');
        $to = request()->post('report_to');
        $report_from = Carbon::createFromFormat('Y-m-d', $from)->startOfDay();
        $report_to = Carbon::createFromFormat('Y-m-d', $to)->endOfDay();

        $queryBuilder = DB::table('refunds')
            ->whereBetween('refunds.created_at', [$report_from, $report_to])
            ->select('refunds.id as refund_id', 'orders.increment_id', 'refunds.state', 'refunds.base_grand_total as refund_amount', 'refunds.created_at as refund_date')
            ->leftJoin('orders', 'refunds.order_id', '=', 'orders.id')
            ->leftJoin('addresses as order_address_billing', function($leftJoin) {
                $leftJoin->on('order_address_billing.order_id', '=', 'orders.id')
                    ->where('order_address_billing.address_type', OrderAddress::ADDRESS_TYPE_BILLING);
            })
            ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'order_address_billing.last_name) as billed_to'));

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
    }

}