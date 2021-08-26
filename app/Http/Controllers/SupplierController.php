<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;

class SupplierController extends Controller
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
        $suppliers=Supplier::where('supplier_status',1)->orderBy('id','DESC')->get();
        return view('admin.suppliers.all',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.add');
    }


    public function view($slug){
        $suppliers=Supplier::where('supplier_status',1)->where('supplier_slug',$slug)->firstOrFail();
        return view('admin.suppliers.view',compact('suppliers'));
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
            'supplier_name'=>'required|min:3',
            'supplier_brand'=>'required',
            'phone'=>'required|min:11|max:15',
            'email'=>'required',
        ],[

        ]);

        $supplier_slug = Str::of($request->supplier_name)->slug('-');

        $insert = Supplier::insertGetId([
            'supplier_name'=>$request->supplier_name,
            'supplier_brand'=>$request->supplier_brand,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'supplier_slug'=>$supplier_slug,
            'created_at'=>Carbon::now()->toDateTimeString(),

        ]);

        if($request->hasFile('supplier_img')){
            $image = $request->file('supplier_img');
            $image_name = $supplier_slug.'('.$insert.')'.'-'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(250,250)->save(base_path('public/uploads/suppliers/'.$image_name));
            
            Supplier::where('id',$insert)->update([
                'supplier_img'=>$image_name,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }
        
        if($insert){
            Session::flash('success','New supplier adder successfully.');
            return redirect('/admin/suppliers/create');
        }
        else{
            Session::flash('error','Something were wrong!');
            return redirect('/admin/suppliers/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier,$slug)
    {
        $suppliers = Supplier::where('supplier_status',1)
                    ->where('supplier_slug',$slug)->firstOrFail();
        return view('admin.suppliers.edit',compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        // return $request->all();

        $request->validate([
            'supplier_name'=>'required|min:3',
            'supplier_brand'=>'required',
            'phone'=>'required|min:11|max:15',
            'email'=>'required',
        ],[

        ]);
        $url_slug = Str::of($request->supplier_name)->slug('-');
        $data = [
            'supplier_name'=>$request->supplier_name,
            'supplier_brand'=>$request->supplier_brand,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'supplier_slug'=>$url_slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ];

        //image file update

        if($request->hasFile('supplier_img')){
            $image = $request->file('supplier_img');
            $image_name = $url_slug.'('.$request->id.')'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(250,250)->save(base_path('public/uploads/suppliers/'.$image_name));
            $data['supplier_img'] = $image_name;
        }
        $update = Supplier::where('supplier_status',1)
                    ->where('id',$request->id)->update($data);

        if($update){
            Session::flash('update_success','Suppliers Information Updated Successfully !');
            return redirect('/admin/suppliers/view/'.$url_slug);
        }
        else{
            Session::flash('update_error','Something were wrong');
            return redirect('/admin/suppliers/view/'.$url_slug);
        }

    }


    public function soft_delete($slug){
        $soft_delete = Supplier::where('supplier_status',1)
                        ->where('supplier_slug',$slug)->update([
                            'supplier_status'=>0,
                            'updated_at'=>Carbon::now()->toDateTimeString(),
                        ]);
        if($soft_delete){
            Session::flash('delete_success','This Supplier has been deleted.');
            return redirect('/admin/suppliers');
        }
        else{
            Session::flash('delete_error','This Supplier can not be deleted!');
            return redirect('/admin/suppliers');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier,$slug)
    {
        $del = Supplier::where('supplier_status',0)->where('supplier_slug',$slug)->delete();
        if($del){
            Session::flash('delete_success','This supplier is deleted permanently');
            return redirect('/admin/restore/suppliers');
        }
        else{
            Session::flash('delete_error','Something were wrong!');
            return redirect('/admin/restore/suppliers');
        }
    }

    public function trash_supplier(){
        $suppliers = Supplier::where('supplier_status',0)->get();
        return view('admin.restore.supplier',compact('suppliers'));
    }

    public function restore_supplier($slug){
        $restore_supplier=Supplier::where('supplier_status',0)->where('supplier_slug',$slug)
        ->update([
            'supplier_status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($restore_supplier){
            Session::flash('success','This Supplier is Restored');
            return redirect('/admin/restore/suppliers');
        }
        else{
            Session::flash('error','Something went wrong!');
            return redirect('/admin/restore/suppliers');
        } 
    }
}
