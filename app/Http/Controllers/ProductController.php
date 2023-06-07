<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Company;
use App\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::active()->get();
        $company_id = auth()->user()->company_id;

        $freeBudget = Company::where('id', auth()->user()->company_id)->value('free_budget');
        
        //$rob = \App\User::find(2); // company id 3. user rob has placed 47 orders so company 3 has 47 orders
        //$companyOrders = Company::find($rob->company_id)->orders->count();
        //$scott = \App\User::find(4); // company id 1. user scott has placed 0 orders so company 1 has 0 orders
        //$companyOrders = Company::find($scott->company_id)->orders->count();
        //$realtest = \App\User::find(27); // company id 2. user realtest has placed 1 order so company 2 has 1 order
        // $companyOrders = Company::find($realtest->company_id)->orders->count();
        
        
        // if($companyOrders <= 0) {
        //     dd('No free orders left - $companyOrders is ' . $companyOrders);
        // } else {
        //     dd('You have ' . $companyOrders . ' free orders remaining - $companyOrders is ' . $companyOrders);
        // }

        return view('product.index', [
            'products' => $products,
            'freeBudget' => $freeBudget,
        ]);
    }

    public function getTrashed()
    {
        // gets all the products that have been soft deleted
        $products = Product::onlyTrashed()->get();
        $inactiveProducts = Product::inactive()->get();

        return view('product.trashed', [
            'products' => $products,
            'inactiveProducts' => $inactiveProducts,
            'title' => 'Discontinued and Hidden Products'
        ]);
    }
    
    public function getProductsByType($type)
    {
        $products = Product::where('category', 'like', '%%' . $type . '%%')->orderBy('id')->get();
        $title = $this->camelToNice($type);

        return view('product.productcat', [
            'products' => $products,
            'title' => $title,
        ]);
    }

    /*public function getProductsByCat($cat)
    {
        $nbProducts = Product::where('category', 'like', '%%' . $cat . '%%')->orderBy('name')->get();
        
        return view('product.notebooks', [
            'nbProducts' => $nbProducts,
        ]);
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        // https://g3d-app.com/s/app/mobile3/en_GB/
        // default.html
        // #
        // p=2075844
        // &r=2d-canvas
        // &d=25266
        // &pc=
        // &_usePs=1
        // &_pav=3]

        $mobileUrl = 'https://g3d-app.com/s/app/mobile3/en_LSI/';
        $mobileUrl .= 'default.html';
        $mobileUrl .= '#';
        $mobileUrl .= 'p=' . $product->gateway;
        $mobileUrl .= '&guid=' . env('GATEWAY_COMPANY');
        $mobileUrl .= '&r=multi';
        $mobileUrl .= '&epa=' . action('ProductController@getExternalPricingAPI', [$product->id]);
        $mobileUrl .= '&ep3dUrl=' . action('CartController@add');
        
        return view('product.show', [
            'product' => $product,
            'mobileUrl' => $mobileUrl,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function personaliser($id, $gatewaymultiId = null){
        $product = Product::find($id);
        
        $iframeUrl = 'https://g3d-app.com/s/app/acp3_2/en_LSI/';    
        $iframeUrl .= env('GATEWAY_CONFIG') . '.html';
        $iframeUrl .= '#p=' . $product->gateway;
        $iframeUrl .= '&guid=' . env('GATEWAY_COMPANY');
        $iframeUrl .= '&r=2d-canvas';
		$iframeUrl .= '&epa=' . action('ProductController@getExternalPricingAPI', $product->id);
        $iframeUrl .= '&ep3dUrl=' . action('CartController@add', [$gatewaymultiId]);
        

        return view('product.personaliser', [
            'product' => $product,
            'iframeUrl' => $iframeUrl,
        ]);
    }
	
	public function getExternalPricingAPI($id){
		$callback = $_GET['callback'];
		$callback = preg_replace("/[^0-9a-zA-Z\$_]/", "", $callback); // XSS prevention
		
		$product = Product::find($id);
		
		$epaArray = [
			'name' => $product->name,
			'description' => strip_tags($product->description),
		];
		$epaJson = json_encode($epaArray);
		
		header('Content-type: application/javascript'); // this was text/plain as per the docs, but on poshop digitalocean server it requires application/javascript in chrome
		echo "{$callback}({$epaJson})";
		exit;
	}

    private function camelToNice($str) {
        $output = preg_replace('/(?<=\\w)(?=[A-Z])/', " $1", $str);
        $output = trim($output);
        return ucwords($output);
    }
}
