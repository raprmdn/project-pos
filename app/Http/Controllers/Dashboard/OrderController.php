<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Resources\OrderDetailResource;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\OrderProductsDetail;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index()
    {
        $supplier = Supplier::all();
        return view('dashboard.orders.index', compact('supplier'));
    }

    public function create(OrderProduct $order)
    {
        if ($order->status == "completed") {
            return redirect()->route('orders.index');
        }
        return view('dashboard.orders.create', compact('order'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Silakan pilih supplier dahulu'
            ]);
        }
        $validated = $validator->validated();
        $invoice = 'ORD' . date('Ymd') . Str::upper(Str::random(4));
        $uuid = Str::uuid();
        try {
            $order = OrderProduct::create([
                'supplier_id' => $validated['supplier_id'],
                'invoice' => $invoice,
                'uuid' => $uuid
            ]);
            return response()->json([
                'status' => 200,
                'data' => $order,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => 'error',
                'data' => $th,
            ]);
            //throw $th;
        }
    }

    public function show(OrderProduct $order)
    {
        return view('dashboard.orders.show', compact('order'));
    }

    public function getDetailOrder(OrderProduct $order)
    {
        $order = $order->load('supplier:id,name');

        return response()->json([
            'status' => 200,
            'data' => new OrderDetailResource($order),
        ]);
    }

    public function postDetailOrder(Request $request, OrderProduct $order)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'data tidak lengkap'
            ]);
        }
        $validated = $validator->validated();

        $product = Product::findOrFail($validated['product_id']);
        try {
            if ($order->order_product_details()->where('product_id', $product->id)->exists()) {
                $order->order_product_details()->where('product_id', $product->id)->increment('qty', + 1);
                $order->order_product_details()->where('product_id', $product->id)->update([
                    'total' => $product->price * $order->order_product_details()->where('product_id', $product->id)->first()->qty
                ]);
            } else {
                $order->order_product_details()->create([
                    'product_id' => $product->id,
                    'qty' => 1,
                    'total' => $product->price
                ]);
            }

            $order->update([
                'total' => $order->order_product_details()->sum('total'),
                'total_items' => $order->order_product_details()->sum('qty'),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Successfully added product to order',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => $th
            ]);
        }
    }

    public function updateDetailOrder(OrderProduct $order, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qty' => 'required|numeric',
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'data tidak lengkap'
            ]);
        }
        $validated = $validator->validated();

        $product = Product::findOrFail($validated['product_id']);
        try {
            $orderProductDetails = $order->order_product_details()->where('product_id', $product->id)->first();
            $orderProductDetails->update([
                'qty' => $validated['qty'],
                'total' => $product->price * $validated['qty']
            ]);

            $order->update([
                'total' => $order->order_product_details()->sum('total'),
                'total_items' => $order->order_product_details()->sum('qty'),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'sukses'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => $th
            ]);
        }
    }

    public function deleteDetailOrder(OrderProduct $order, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'data tidak lengkap'
            ]);
        }
        $validated = $validator->validated();

        try {
            $order->order_product_details()->where('product_id', $validated['product_id'])->first()->delete();
            $order->update([
                'total' => $order->order_product_details()->sum('total'),
                'total_items' => $order->order_product_details()->sum('qty'),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Successfully deleted product from order',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 401,
                'message' => $th
            ]);
        }
    }

    public function saveOrder(Request $request, OrderProduct $order)
    {
        $order->order_product_details()->get()->each(function ($orderDetail) {
            $product = Product::find($orderDetail->product_id);
            $product->update([
                'stock' => $product->stock + $orderDetail->qty,
            ]);
        });
        $order->update([
            'notes' => $request->notes,
            'status' => 'completed'
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'sukses'
        ]);
    }

    public function resetOrder(OrderProduct $order)
    {
        $order->order_product_details()->delete();
        $order->update([
            'total_items' => 0,
            'total' => 0
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'sukses'
        ]);
    }

    public function cancelOrder(OrderProduct $order)
    {
        $order->order_product_details()->delete();
        $order->delete();
        return response()->json([
            'status' => 200,
            'message' => 'sukses'
        ]);
    }

    public function ordersTable()
    {
        $orders = OrderProduct::with('supplier:id,name')->latest()->get();

        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('supplier', function ($order) {
                return $order->supplier->name;
            })
            ->editColumn('subtotal', function ($order) {
                return 'Rp. ' . Helper::rupiahFormat($order->subtotal) . ',-';
            })
            ->editColumn('discount', function ($order) {
                return $order->discount . '%';
            })
            ->editColumn('total', function ($order) {
                return 'Rp. ' . Helper::rupiahFormat($order->total) . ',-';
            })
            ->editColumn('status', function ($order) {
                return view('dashboard.actions.order-status', compact('order'));
            })
            ->editColumn('created_at', function ($order) {
                return $order->created_at->format('d M Y, H:i');
            })
            ->addColumn('action', function ($order) {
                return view('dashboard.actions.order', compact('order'));
            })
            ->rawColumns(['action', 'subtotal', 'discount', 'total', 'status', 'supplier', 'created_at'])
            ->make();
    }

    public function getDetailOrderProduct(OrderProduct $order)
    {
        $products = OrderProductsDetail::with(['product' => function ($product) {
            return $product->select('id', 'barcode', 'name', 'category_id')->with('category:id,name');
        }])->where('order_product_id', $order->id)->latest()->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->editColumn('barcode', function ($product) {
                return $product->product->barcode ?? null;
            })
            ->editColumn('product', function ($product) {
                return $product->product->name ?? null;
            })
            ->editColumn('category', function ($product) {
                return $product->product->category->name ?? null;
            })
            ->editColumn('subtotal', function ($product) {
                return 'Rp. ' . Helper::rupiahFormat($product->total) . ',-';
            })
            ->addColumn('action', function ($order) {
                return view('dashboard.actions.order-detail', compact('order'));
            })
            ->rawColumns(['barcode', 'product', 'category', 'subtotal', 'action'])
            ->make();
    }
}
