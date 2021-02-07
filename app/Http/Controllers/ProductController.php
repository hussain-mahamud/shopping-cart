<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
    	$products=Product::all();
    	return view('product',['products'=>$products]);
    }
    public function cart(){
    	return view('cart');
    }

    public function addToCart(Product $product){
    	$cart=session()->get('cart');
    	//dd($cart);
    	if(!$cart){
    		$cart=[
    			$product->id=>$this->sessionData($product)
    		];
    	return	$this->setSessionAndResponse($cart);
    	}
    	if(isset($cart[$product->id])){
    		$cart[$product->id]['quantity']++;
    	return	$this->setSessionAndResponse($cart);

    	}
    	$cart[$product->id]=$this->sessionData($product);
    	return $this->setSessionAndResponse($cart);
    }



    public function removeItem($id){
    	$cart=session()->get('cart');
    	if(isset($cart[$id])){
    		unset($cart[$id]);
    		session()->put('cart',$cart);
    	}
    	return redirect()->back()->with('success', 'Remove From Cart');
    }

    protected function sessionData(Product $product){
    	return [
    		'name' 		=>$product->name,
    		'quantity'	=>1,
    		'price'		=>$product->price,
    		'image'		=>$product->image
    	];
    }

    protected function setSessionAndResponse($cart){
    	session()->put('cart',$cart);
    	return redirect()->route(route:'cart')->with('success', 'Added to Cart');
    }
}
