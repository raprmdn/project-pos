<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleDetail;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
{
    public function index()
    {
        return view('dashboard.sales.index');
    }

    public function show(Sale $sale)
    {
        if ($sale->status !== 'completed') {
            return redirect()->route('sales.index')->with('error', "The transaction for invoice $sale->invoice is not completed");
        }
        $sale = $sale->load('user');

        return view('dashboard.sales.show', compact('sale'));
    }

    public function salesDetailTable(Sale $sale)
    {
        $products = SaleDetail::with(['product' => function($product) {
            return $product->select('id', 'barcode', 'name', 'stock', 'category_id')->with('category:id,name');
        }])->where('sale_id', $sale->id)->latest()->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->editColumn('barcode', function ($product) {
                return $product->product->barcode ?? null;
            })
            ->editColumn('product_name', function ($product) {
                return $product->product->name ?? null;
            })
            ->editColumn('category', function ($product) {
                return $product->product->category->name ?? null;
            })
            ->editColumn('unit_price', function ($product) {
                return 'Rp. ' . Helper::rupiahFormat($product->unit_price) . ',-';
            })
            ->editColumn('total', function ($product) {
                return 'Rp. ' . Helper::rupiahFormat($product->total) . ',-';
            })
            ->rawColumns(['unit_price', 'total'])
            ->make();
    }

    public function salesTable()
    {
        $sales = Sale::with(['user:id,name', 'sale_details'])->latest()->get();

        return DataTables::of($sales)
            ->addIndexColumn()
            ->editColumn('subtotal', function ($sale) {
                return 'Rp. ' . Helper::rupiahFormat($sale->subtotal) . ',-';
            })
            ->editColumn('discount', function ($sale) {
                return $sale->discount . '%';
            })
            ->editColumn('total', function ($sale) {
                return 'Rp. ' . Helper::rupiahFormat($sale->total) . ',-';
            })
            ->editColumn('created_at', function ($sale) {
                return $sale->created_at->format('d M Y, H:i');
            })
            ->editColumn('status', function ($sale) {
                return $sale->status === 'completed' ? '<span class="badge badge-success">Completed</span>' : '<span class="badge badge-danger">Pending</span>';
            })
            ->addColumn('cashier', function ($sale) {
                return $sale->user->name;
            })
            ->addColumn('action', function ($sale) {
                return view('dashboard.actions.sales', compact('sale'));
            })
            ->rawColumns(['subtotal', 'discount', 'total', 'created_at', 'status', 'action'])
            ->make();
    }
}
