<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleDetailResource;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Services\TransactionService;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Sale $sale)
    {
        if ($sale->status === 'completed') {
            return redirect()->route('sales.index')->with('error', "The transaction for invoice $sale->invoice has been completed");
        }

        $sale = $sale->load('user');

        return view('dashboard.transactions.index', compact('sale'));
    }

    public function create()
    {
        $sale = $this->transactionService->createTransaction();

        return redirect()->route('transactions.index', $sale->uuid);
    }

    public function getSaleDetail(Sale $sale)
    {
        $sale = $sale->load('user');

        return response()->json([
            'status' => 200,
            'message' => 'Successfully get sale detail',
            'data' => new SaleDetailResource($sale),
        ]);
    }

    public function saveTransaction(Sale $sale)
    {
        request()->validate([
            'notes' => 'max:255',
        ]);

        if ($sale->received < $sale->total) {
            return response()->json([
                'status' => 400,
                'message' => 'Received amount is less than total amount',
            ]);
        }

        if (!$sale->sale_details->count()) {
            return response()->json([
                'status' => 400,
                'message' => "This transaction doesn't have any product, please add product first",
            ]);
        }
        $sale = $this->transactionService->saveTransaction($sale, request('notes'));

        return response()->json([
            'status' => 200,
            'message' => "Cool! Transaction for invoice $sale->invoice has been completed",
            'url' => route('sales.index'),
        ]);
    }

    public function addProduct(Sale $sale)
    {
        $product = Product::find(request('product_id'));
        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Cannot find that product.',
            ]);
        }

        if ($product->stock < 1) {
            return response()->json([
                'status' => 404,
                'message' => 'Product stock is not enough.',
            ]);
        }

        try {
            $this->transactionService->addProduct($sale, $product);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "There's an issue, please try again later.",
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Successfully add product',
        ]);
    }

    public function updateProduct(Sale $sale)
    {
        $product = Product::find(request('product_id'));
        $saleDetail = SaleDetail::find(request('sale_detail_id'));
        $isIncreaseStock = request('qty') > $product->stock + $saleDetail->qty;

        if (!$product || !$saleDetail || $saleDetail->sale_id !== $sale->id) {
            return response()->json([
                'status' => 404,
                'message' => 'Cannot find that product or sale detail.',
            ]);
        }

        if ($isIncreaseStock) {
            return response()->json([
                'status' => 404,
                'message' => 'Product stock is not enough.',
            ]);
        }

        try {
            $this->transactionService->updateProduct($sale, $product, $saleDetail);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "There's an issue, please try again later.",
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Successfully update qty',
        ]);
    }

    public function deleteProduct(Sale $sale)
    {
        $product = Product::find(request('product_id'));
        $saleDetail = SaleDetail::find(request('sale_detail_id'));

        if (!$product || !$saleDetail || $saleDetail->sale_id !== $sale->id) {
            return response()->json([
                'status' => 404,
                'message' => 'Cannot find that product or sale detail.',
            ]);
        }

        try {
            $this->transactionService->deleteProduct($sale, $product, $saleDetail);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "There's an issue, please try again later.",
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Successfully delete product',
        ]);
    }

    public function applyDiscount(Sale $sale)
    {
        $discount = request('discount');
        if (!$sale->sale_details()->exists()) {
            return response()->json([
                'status' => 404,
                'message' => "Cannot apply the discount. Please add product first.",
            ]);
        }

        try {
            $this->transactionService->applyDiscount($sale, $discount);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "There's an issue, please try again later.",
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Successfully apply the discount',
        ]);
    }

    public function applyCash(Sale $sale)
    {
        $cash = (int) str_replace('.', '', request('cash'));
        if ($cash < $sale->total) {
            return response()->json([
                'status' => 404,
                'message' => "Cash is not enough.",
            ]);
        }

        try {
            $this->transactionService->applyCash($sale, $cash);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "There's an issue, please try again later.",
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Successfully apply the cash',
        ]);
    }

    public function resetTransaction(Sale $sale)
    {
        try {
            $this->transactionService->resetTransaction($sale);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "There's an issue, please try again later.",
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Successfully reset transaction',
        ]);
    }

    public function cancelTransaction(Sale $sale)
    {
        $this->transactionService->cancelTransaction($sale);

        return response()->json([
            'status' => 200,
            'message' => 'Your transaction has been canceled',
            'url' => route('sales.index')
        ]);
    }

    public function getSaleProductDetail(Sale $sale)
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
            ->addColumn('action', function ($saleDetail) {
                return view('dashboard.actions.sale-detail', compact('saleDetail'));
            })
            ->rawColumns(['unit_price', 'total', 'action'])
            ->make();
    }
}
