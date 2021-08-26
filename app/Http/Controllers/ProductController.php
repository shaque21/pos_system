<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Picqer;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProducts=Product::where('product_status',1)->orderBy('id','DESC')->get();
        return view('admin.products.all',compact('allProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'=>'required|max:70|min:5',
            'brand'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'alert_stock'=>'required',
            'product_img'=>'required|mimes:png,jpg,jpeg',
        ],[
            'alert_stock.required'=>'The Stock Field is Required!',
            'product_img.required'=>'The Product Image Field is Required!',
        ]);
        //image file upload

        $image=$request->file('product_img');
        $ext=$image->extension();
        $file=time().'.'.$ext;
        $image->storeAs('/public/productImages',$file);

        $slug = Str::of($request->product_name)->slug('-');
        $product_code = 'PC-'.rand(105423,100000);
        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents('contents/admin/products/barcode/'.$slug.'-'.$product_code.'.jpg',
                $generator->getBarcode('$product_code,$request->product_name, $request->brand',
                $generator::TYPE_CODE_128, 2, 60));
        
        $insert=Product::insert([
            'product_name'=>$request->product_name,
            'brand'=>$request->brand,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'product_code'=>$product_code,
            'barcode'=>$slug.'-'.$product_code.'.jpg',
            'alert_stock'=>$request->alert_stock,
            'description'=>$request->description,
            'product_img'=>$file,
            'product_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $request->session()->flash('success', 'New Product Added Successfully!');
            return redirect('/admin/products/create');
        }
        else{
            $request->session()->flash('error', 'New Product is not Added!');
            return redirect('/admin/products/create');
        }
    }

    public function view($slug){
        $data=Product::where('product_status',1)->where('product_slug',$slug)->get();
        return view('admin.products.view',compact('data'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$slug)
    {
        $data=Product::where('product_status',1)->where('product_slug',$slug)->firstOrFail();
        return view('admin.products.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //return $request->all();
        $request->validate([
            'product_name'=>'required|max:70|min:5',
            'brand'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'alert_stock'=>'required',
            'product_img'=>'mimes:png,jpg,jpeg',
        ],[
            'alert_stock.required'=>'The Stock Field is Required!',
        ]);

        
        $url_slug = Str::of($request->product_name)->slug('-');
        $product_code = $request->product_code;
        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents('contents/admin/products/barcode/'.$url_slug.'-'.$product_code.'.jpg',
                $generator->getBarcode('$product_code,$request->product_name, $request->brand',
                $generator::TYPE_CODE_128, 2, 60));
        $data=array(
            'product_name'=>$request->product_name,
            'brand'=>$request->brand,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'product_code'=>$product_code,
            'barcode'=>$url_slug.'-'.$product_code.'.jpg',
            'alert_stock'=>$request->alert_stock,
            'description'=>$request->description,
            'product_slug'=>$url_slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        );
        //image file upload

        if($request->hasFile('product_img')){
            $image=$request->file('product_img');
            $ext=$image->extension();
            $file=time(). '-' . $request->product_name . '.' .$ext;
            $image->storeAs('/public/productImages',$file);
            $data['product_img']=$file;
        }
        $update = DB::table('products')->where('id',$request->id)->where('product_status',1)->update($data);
        if($update){
            Session::flash('update_success','Product Information Updated Successfully !');
            return redirect('/admin/products/view/'.$url_slug);
        }
        else{
            Session::flash('update_error','The Product Information is not Updated !');
            return redirect('/admin/products/edit/'.$url_slug);
        }


    }

    // Soft Delete that moves specified data to restore

    public function soft_delete($slug){
        $soft_delete=Product::where('product_status',1)->where('product_slug',$slug)
        ->update([
            'product_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($soft_delete){
            Session::flash('delete_success','This product moves to Restore');
            return redirect('/admin/products');
        }
        else{
            Session::flash('delete_error','This product can not moves to Restore');
            return redirect('/admin/products');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$slug)
    {
        $del = Product::where('product_slug',$slug)->delete();
        if($del){
            Session::flash('delete_success','This product successfully deleted');
            return redirect('/admin/restore/products');
        }
        else{
            Session::flash('delete_error','This product is not delete');
            return redirect('/admin/restore/products');
        }
    }
    public function barcode(){
        $products = Product::select('product_code','barcode','product_name')
        ->where('product_status',1)
        ->orderBy('id','DESC')
        ->get();
        return view('admin.products.barcode',compact('products'));
    }
    public function trash_product(){
        $products = Product::where('product_status',0)->paginate(5);
        return view('admin.restore.product',compact('products'));
    }
    public function restore_product($slug){
        $restore_product=Product::where('product_status',0)->where('product_slug',$slug)
        ->update([
            'product_status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($restore_product){
            Session::flash('success','This product is Restored');
            return redirect('/admin/restore/products');
        }
        else{
            Session::flash('error','This product is not Restored');
            return redirect('/admin/restore/products');
        } 
    }
}
