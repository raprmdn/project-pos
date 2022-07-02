<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now();

        if (request()->has('filter')) {
            $startAndEndDate = explode(' - ', request('filter'));
            try {
                $startDate = Carbon::parse($startAndEndDate[0]);
                $endDate = Carbon::parse($startAndEndDate[1]);
            } catch (\Exception $e) {
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now();
            }
        }

        return view('dashboard.reports.index', compact('startDate', 'endDate'));
    }

    public function reportsTable($startDate, $endDate)
    {
        $data = $this->getDataReports($startDate, $endDate);

        return DataTables::of($data)->make();
    }

    public function exportPDF($startDate, $endDate)
    {
        $data = $this->getDataReports($startDate, $endDate);
        $startDate = Carbon::parse($startDate)->format('d F Y');
        $endDate = Carbon::parse($endDate)->format('d F Y');
        $pdf = Pdf::loadView('dashboard.reports.pdf', compact('data', 'startDate', 'endDate'));

        return $pdf->download('Reports ' . $startDate . ' - ' . $endDate . '.pdf');
    }

    public function getDataReports($startDate, $endDate)
    {


        $no = 1;
        $data = [];
        $totalIncome = 0;

        while ($startDate <= $endDate) {
            $date = $startDate;
            $startDate = Carbon::parse($startDate)->addDays()->format('Y-m-d');

            $totalSales = Sale::whereBetween('created_at', [$date, $startDate])->sum('total');
            $totalOrders = OrderProduct::whereBetween('created_at', [$date, $startDate])->sum('total');

            $income = $totalSales - $totalOrders;
            $totalIncome += $income;

            $data[] = [
                'DT_RowIndex' => $no++,
                'date' => Carbon::parse($date)->format('d F Y'),
                'orders' => "Rp. " . Helper::rupiahFormat($totalOrders),
                'sales' => "Rp. " . Helper::rupiahFormat($totalSales),
                'income' => "Rp. " . Helper::rupiahFormat($income),
            ];
        }

        $data[] = [
            'DT_RowIndex' => '',
            'date' => '',
            'orders' => '',
            'sales' => 'Total Pendapatan',
            'income' => "Rp. " . Helper::rupiahFormat($totalIncome),
        ];

        return $data;
    }
}
