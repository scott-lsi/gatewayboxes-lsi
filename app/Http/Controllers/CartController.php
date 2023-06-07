<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use App\Order;
use App\Company;

class CartController extends Controller
{
    public function index(){
        $basket = Cart::content();

        $companyOrders = Company::find(auth()->user()->company_id)->orders->count();
        $freeOrders = 10;
        $companyOrders = $freeOrders - $companyOrders;

        $basket_quantity_total = 0;
        foreach($basket as $row){
            $basket_quantity_total += $row->qty;
        }

        $free_orders_remaining = $companyOrders - $basket_quantity_total;

        $free_items = $basket->sortByDesc('price')->take($companyOrders);
        $free_item_value = 0;
        foreach($free_items as $row){
            $free_item_value += $row->price;
        }

        // dd($basket);
        return view('basket.index', [
            'basket' => $basket,
            'countries' => \App\Country::orderBy('langEN')->pluck('langEN', 'alpha2'),
            'companyOrders' => $companyOrders,
            'free_orders_remaining' => $free_orders_remaining,
        ]);

        
    }
    
    public function add(Request $request, $gatewaymultiId = null){
        // get what's been typed in
        $textInputs = array_filter(json_decode($_POST['data'], true), function($key){
            return strpos($key, 'userText') === 0 && !strpos($key, '_');
        }, ARRAY_FILTER_USE_KEY);
        ksort($textInputs);
        
        // artwork
        $gateway = $this->gatewayAdd($_POST['data']);
        /* 
        • if the product is set up with aspects, it will return the sku of that aspect rather than the parent product in $gateway->sku.
        • however, it also returns a $gateway->extra->state array, which contains the parent's product_id (what is stored as `gateway`
            in the db), so it can be fetched by that.
        • products without aspects don't return $gateway->extra->state, so this isset() looks for it, does it if it's there but gets
            the product via the sku if not.
        */
        if(isset($gateway->extra->state->product_id)){
            $product = Product::where('gateway', $gateway->extra->state->product_id)->first();
        } else {
            $product = Product::where('sku', $gateway->sku)->first();
        }

        // quantity
        $quantity = $gateway->quantity;

        // aspects
        $aspects = [];
        if(isset($gateway->extra->state->aspects[0]->aspect_id)){
            $aspects = [
                'aspect_id' => $gateway->extra->state->aspects[0]->aspect_id,
                'option_id' => $gateway->extra->state->aspects[0]->option_id,
            ];
        }

        // options
        $options = [];
        $options['printjobid'] = $gateway->printJobId;
        $options['printjobref'] = $gateway->printJobRef;
        $options['imageurl'] = $gateway->thumburl;
        $options['textinputs'] = $textInputs;
        $options['aspects'] = $aspects;
        
        Cart::add(
            $product->id, 
            $product->name, 
            $quantity, 
            $product->price, 
            $options
        );
        
        if($gatewaymultiId){
            // it's a gatewaymulti product
            $gatewaymultiProduct = Product::find($gatewaymultiId);
            $gatewaymultiGateways = json_decode($gatewaymultiProduct->gatewaymulti, true);
            
            $thisId = array_search($product->id, $gatewaymultiGateways);
        
            if(array_key_exists($thisId+1, $gatewaymultiGateways)){
                return redirect()->action('CartController@gatewayRedir', [$gatewaymultiGateways[$thisId+1], $gatewaymultiId]);
            }
        }
        
        return redirect()->action('CartController@gatewayRedir');
    }
    
    public function gatewayRedir($id = null, $gatewaymultiId = null){
        if($id && $gatewaymultiId){
            return view('basket.gatewaymulti_redir', [
                'redirUrl' => action('ProductController@personaliser', [$id, $gatewaymultiId]),
            ]);
        } else {
            return view('basket.gateway_redir');
        }
    }
    
    public function destroy(){
        Cart::destroy();
        
        return redirect()->back();
    }
	
	public function getRemoveItem($rowId){
		// get the row & remove it
		\Cart::remove($rowId);
		
		// message
		\Session::flash('message', 'Item removed');
		\Session::flash('alert-class', 'alert-success');
		
		// go to the basket
		return redirect()->back();
	}
    
    public function postUpdateQty(Request $request, $rowId){
		Cart::update($rowId, [
			'qty' => $request->input('qty'),
		]);
        
        return redirect()->back();
    }
    
	public function postToPrint(Request $request){
        // prepare the artwork
        $g3d = $this->gatewayPrepare($request, $request->input('compname')); 
        
        // create a new order for the db        
        $order = new Order;
        $order->user_id = $request->input('user_id');
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->compname = $request->input('compname');
        $order->jobref = $request->input('jobref');
        $order->telenum = $request->input('telenum');
        $order->addline1 = $request->input('addline1');
        $order->addline2 = $request->input('addline2');
        $order->postcode = $request->input('postcode');
        $order->city = $request->input('city');
        $order->county = $request->input('county');
        $order->basket = json_encode(Cart::content());
        $order->g3d = $g3d;
        
        // email
        $view_data = [
            'email' => $request->email,
            'name' => $request->name,
            'compname' => $request->compname,
            'jobref' => $request->jobref,
            'telenum' => $request->telenum,
            'addline1' => $request->addline1,
            'addline2' => $request->addline2,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'county' => $request->county,
            'basket' => \Cart::Content(),
        ];
        $email_data = [
            'compname' => $request->compname,
            'email' => $request->email,
        ];
        
        // save it all and send things
        $order->save();
        $this->gatewaySend($g3d);
        $this->sendOrderEmail($view_data, $email_data);
        
        Cart::destroy();
        
        return view('basket.complete', [
            'order' => $order,
        ]);
    }
    
    private function gatewayAdd($data){
        $type = $_SERVER['CONTENT_TYPE'];
        switch($type)
        {
            case 'application/json':
                $json = file_get_contents('php://input');
                break;

            case 'application/x-www-form-urlencoded':
                $json = $data;
                break;

            default:
                throw new Exception('Invalid content-type');
        }

        return json_decode($json);
    }
    
    private function gatewayPrepare(Request $request, $compname){
        $rnd = str_random(8);
        $gatewayArray = [
            'external_ref' => $request->input('compname') . '-' . $rnd,
            'company_ref_id' => env('GATEWAY_COMPANY'),
            'sale_datetime' => date('Y-m-d H:i:s'),
            
            'customer_name' => $request->input('name'),
            'customer_email' => $request->input('email'),
            'customer_telephone' => $request->input('telenum'),
            
            'shipping_company' => $request->input('compname'),
			'shipping_address_1' =>	$request->input('addline1'),
			'shipping_address_2' =>	$request->input('addline2'),
			'shipping_address_3' =>	$request->input('city'),
            'shipping_address_4' =>	$request->input('county'),
            // Removed the jobref as this was going through to gateway as one of the shipping adresses
            // and in turn this meant was pulling through on the dispatch note. Maybe look at another field?
            // 'shipping_address_5' =>	$request->input('jobref'),
            'shipping_address_5' =>	'',
			'shipping_postcode' => $request->input('postcode'),
			'shipping_country' => '',
			'shipping_country_code' => 'GB',
			
			'shipping_method' =>	'',
			'shipping_carrier' =>	'',
			'shipping_tracking' =>	'',
			
			'billing_address_1' =>	'',
			'billing_address_2' =>	'',
			'billing_address_3' =>	'',
			'billing_address_4' =>	'',
			'billing_address_5' =>	'',
			'billing_postcode' =>	'',
			'billing_country' =>	'',
			
			'payment_trans_id' =>	'',
			
			'items' =>				[],
        ];
        
        $i = 1;
        $items = [];
        foreach(Cart::content() as $row){
            if($row->options->printjobid){
                $product = \App\Product::find($row->id);
                
                $productArray = [
                    'sku' => $product->sku,
                    'external_ref' => $compname . '-' . $rnd . '-' . $i,
                    'description' => $row->name,
                    'quantity' => $row->qty,
                    'type' => 2, // 2 = Print Job (http://developers.gateway3d.com/Print-iT_Integration#Item_Type_Codes)
                    'print_job_id' => $row->options->printjobid,
                    'print_job_ref' => $row->options->printjobref,
                    'unit_sale_price' => $row->price,
                    'aspects' => [$row->options->aspects],
                ];
				
				$items[] = $productArray;
				$i++;
            }
        }
        
        // put the items in the array
		$gatewayArray['items'] = array_merge($gatewayArray['items'], $items);
        
        // gateway wants it in json format
		return json_encode($gatewayArray);
    }
    
    private function gatewaySend($order){
        $gatewayUrl = env('GATEWAY_API_URL');
        
		$curl = curl_init($gatewayUrl);
		curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, true);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: Basic 24626:d70hxn0y03wyhq5g0d887r855p9';

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $order);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);

		$gatewayResponse = curl_exec($curl);

		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		if($status != 200) {
			die("Error: call to URL $gatewayUrl failed with status $status, response $gatewayResponse, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
		}

		curl_close($curl);
    }
    
    private function sendOrderEmail($view_data, $email_data){
        if(strpos(env('ORDER_MAIL_BCC', false), ',')){
            $bcc = explode(',', env('ORDER_MAIL_BCC', false));
        } else {
            $bcc = env('ORDER_MAIL_BCC', false);
        }
        
        \Mail::send('emails.order', $view_data, function($message) use($email_data, $bcc) {
            $message->to($email_data['email'], $email_data['compname'])
                    ->bcc($bcc)
                    ->subject(env('EMAIL_ORDER_SUBJECT'));
        });
    }
}
