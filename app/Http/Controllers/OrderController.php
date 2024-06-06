<?php

namespace App\Http\Controllers;

use App\Models\FruitCategory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderDetails' => function ($query) {
            return $query
                ->join('fruit_category_notes', 'order_details.fruit_category_note_id', '=', 'fruit_category_notes.id')
                ->join('fruit_categories', 'fruit_category_notes.fruit_category_id', '=', 'fruit_categories.id')
                ->select(
                    'fruit_category_notes.fruit_category_id',
                    'order_details.order_id',
                    'order_details.fruit_category_note_id',
                    'order_details.quantity as order_quantity',
                    'fruit_category_notes.name as fruit_category_note_name',
                    'fruit_category_notes.unit as fruit_category_note_unit',
                    'fruit_category_notes.price as fruit_category_note_price',
                    'fruit_categories.name as fruit_category_name',
                    DB::raw('(fruit_category_notes.price * order_details.quantity) as order_amount'),
                );
        }])->get();

        return Inertia::render('Order/OrderList', ['orders' => $orders]);
    }

    public function create()
    {
        $fruitCategories = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'children' => array_map(function ($it) {
                    return [
                        'id' => $it['id'],
                        'name' => $it['name'],
                    ];
                }, $item['fruit_category_notes'] ?? [])
            ];
        }, FruitCategory::with('fruitCategoryNotes')->get()->toArray());

        return Inertia::render('Order/OrderCreate', [
            'fruitCategories' => $fruitCategories
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_name' => $data['customer_name'],
            ]);
            $orderDetailData = array_map(function ($item) use ($order) {
                return [
                    'fruit_category_note_id' => $item['value'],
                    'quantity' => $item['quantity'] ?? 0,
                ];
            }, $data['fruit_category_notes']);
            $order->orderDetails()->createMany($orderDetailData);
            DB::commit();
            return redirect('/orders');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back();
        }
    }

    public function edit(int $id)
    {
        $fruitCategories = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'children' => array_map(function ($it) {
                    return [
                        'id' => $it['id'],
                        'name' => $it['name'],
                    ];
                }, $item['fruit_category_notes'] ?? [])
            ];
        }, FruitCategory::with('fruitCategoryNotes')->get()->toArray());


        $order = Order::with('orderDetails')->find($id);
        return Inertia::render('Order/OrderUpdate', [
            'order' => $order,
            'fruitCategories' => $fruitCategories
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $order->customer_name = $data['customer_name'];
            $order->save();
            $order->orderDetails()->delete();
            $orderDetailData = array_map(function ($item) use ($order) {
                return [
                    'fruit_category_note_id' => $item['value'],
                    'quantity' => $item['quantity'] ?? 0,
                ];
            }, $data['fruit_category_notes']);
            $order->orderDetails()->createMany($orderDetailData);
            DB::commit();
            return redirect('/orders');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->orderDetails()->delete();
            $order->delete();
            DB::commit();
            return redirect('/orders');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
