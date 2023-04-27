<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// use Illuminate\Database\Query\Builder;
// use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    /**
     * Update selected resources per action
     *
     * @return \Illuminate\Http\Response
     */
    public function index_action(Request $request)
    {
// Log::debug(__METHOD__." : request : ".print_r($request->all(),true));
        $action      = $request->input('action','');
        $product_ids = $request->input('product_id',[]);

        $message = '';
        if ($action && $product_ids) {
            if (in_array($action, ['active','inactive'])) {
                foreach ($product_ids as $id) {
                    $product = Product::find($id);
                    $product->status = $action;
                    $product->save();

                    $message .= (empty($message)) ? "Products set '".ucfirst($action)."' [" : ", ";
                    $message .= $product->isbn;
                }
                $message .= "]";
                $request->session()->flash('success', $message);
            }
            if ($action == 'delete') {
                $messages = [];
                foreach ($product_ids as $id) {
                    $product = Product::find($id);
                    $product->delete();

                    $message .= (empty($message)) ? "Products deleted [" : ", ";
                    $message .= $product->isbn;
                }
                $message .= "]";
                $request->session()->flash('success', $message);
            }
        }
        return redirect()->route('products.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
// Log::debug(__METHOD__." : request : ".print_r($request->all(),true));
// Log::debug(__METHOD__." : session('products_index') : ".print_r(session('products_index'),true));

        if (session()->missing('products_index')) {
            session(['products_index' => [
                'search' => '',
                'status' => '',
                'sort' => 'id',
                'order' => 'asc',
                'limit' => '10',
                ]]);
        }

        $session_data = session('products_index');
        $request_data = $request->all();

        if (array_key_exists('search', $request_data)) {
            $session_data['search'] = trim($request_data['search']);
        }
        if (array_key_exists('status', $request_data)) {
            $newval = (in_array($request_data['status'], array_keys(config('constants.products.status_options')))) ? $request_data['status'] : '';
            $session_data['status'] = $newval;
        }
        if (!empty($request_data['sort'])) {
            $session_data['sort'] = $request_data['sort'];
        }
        if (!empty($request_data['order'])) {
            $newval = (in_array($request_data['order'], array_keys(config('constants.products.sortorder_options')))) ? $request_data['order'] : 'asc';
            $session_data['order'] = $request_data['order'];
        }
        if (!empty($request_data['limit']) && int($request_data['limit'])) {
            $session_data['limit'] = int($request_data['limit']);
        }
        session(['products_index' => $session_data]);

        // sort+order
        $products = ($session_data['order'] == 'desc')
                ? Product::orderByDesc($session_data['sort'])
                : Product::orderBy($session_data['sort']);
        // status
        if ($session_data['status']) {
            $products = $products->where('status', $session_data['status']);
        }
        // search
        if ($session_data['search']) {
            $products = $products->where(function (Builder $query) use ($session_data) {
               $query->where('slug', 'like', '%'.$session_data['search'].'%')
                      ->orWhere('title', 'like', '%'.$session_data['search'].'%')
                      ->orWhere('subtitle', 'like', '%'.$session_data['search'].'%')
                      ->orWhere('isbn', 'like', $session_data['search'].'%')
                      ->orWhereFullText('description', $session_data['search']);
           });

        }
        // paginate(limit)
        $products = $products->paginate($session_data['limit']);

        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//         return view('products.create');

        $product_fake = Product::factory()->make();
        return view('products.create')
            ->with('product_fake', $product_fake);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
// Log::debug(__METHOD__." : request : ".print_r($request->all(),true));
// Log::debug(__METHOD__." : request->validated : ".print_r($request->validated(),true));

        $product = Product::create($request->all());

        return redirect()->route('products.index')
                        ->with('success',"Product created [".$product->isbn."]");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
// Log::debug(__METHOD__." : product : ".print_r($product,true));
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
// Log::debug(__METHOD__." : product : ".print_r($product,true));
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
// Log::debug(__METHOD__." : request : ".print_r($request->all(),true));
        $product->update($request->all());
        return redirect()->route('products.index')
                        ->with('success',"Product updated [".$product->isbn."]");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
// Log::debug(__METHOD__." : product : ".print_r($product,true));
        $product->delete();
        return redirect()->route('products.index')
                        ->with('success',"Product deleted [".$product->isbn."]");
    }
}
