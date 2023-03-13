<?php

namespace Tahiryasin\Reports\DataGrids;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class InvoiceReport extends DataGrid
{
    /**
     * Index.
     *
     * @var string
     */
    protected $index = 'invoices.id';

    /**
     * Sort order.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $dbPrefix = DB::getTablePrefix();

        $from = request()->post('report_from');
        $to = request()->post('report_to');
        $report_from = Carbon::createFromFormat('Y-m-d', $from)->startOfDay();
        $report_to = Carbon::createFromFormat('Y-m-d', $to)->endOfDay();

        $queryBuilder = DB::table('invoices')
            ->whereBetween('invoices.created_at', [$report_from, $report_to])
            ->leftJoin('orders as ors', 'invoices.order_id', '=', 'ors.id')
            ->selectRaw("CASE WHEN {$dbPrefix}invoices.increment_id IS NOT NULL THEN {$dbPrefix}invoices.increment_id
                ELSE {$dbPrefix}invoices.id END AS invoice_id,
                invoices.state as state,invoices.total_qty as invoiced_qty, invoices.base_grand_total as invoice_total, invoices.created_at as invoice_date");

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
