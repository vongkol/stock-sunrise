<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
use QrCode;
use Excel;
class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('products.active', 1)
            ->orderBy('id', 'desc')
            ->select('products.*', 'categories.name  as cname', 'units.name as uname')
            ->paginate(config('app.row'));
        return view('products.index', $data);
    }
    public function create()
    {
        $data['cats'] = DB::table('categories')
            ->where('active', 1)
            ->get();
        $data['units'] = DB::table('units')
            ->where('active', 1)
            ->get();
        return view('products.create', $data);
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required|min:2|max:120'
        ]);
        $data = $request->except('_token', 'photo');
        if($request->photo)
        {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
          
            $file_name = md5(date('Y-m-d-H-i-s')) . ".".$ext;

            $new_img = Image::make($file->getRealPath())->resize(450, null, 
                function ($con) {
                    $con->aspectRatio();
                });
            
            $new_img->save('uploads/products/' . $file_name , 80);

            $data['photo'] = 'uploads/products/' . $file_name;
        }
        $i = DB::table('products')->insertGetId($data);
        if($i)
        {
            $qr = "uploads/products/qrcodes/". $i . "-qrcode.png";
            QrCode::format('png');
            QrCode::size(350);
            QrCode::generate(url('product/check/'. $i), public_path($qr));
            DB::table('products')->where('id', $i)
                ->update(['qrcode'=>$qr]);
            return redirect('product/create')->with('success', 'Data has been saved!');
        }
        else{
            session()->flash('error', 'Fail to save data!');
            return redirect('product/create')->withInput();
        }
    }
    public function detail($id)
    {
        $pro = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('products.id', $id)
            ->select('products.*', 'categories.name as cname', 'units.name as uname')
            ->first();
        
        return view('products.detail', compact('pro'));
    }

    public function delete($id)
    {
        DB::table('products')
            ->where('id', $id)
            ->update(['active'=>0]);
        session()->flash('success', 'Data has been removed!');
        return redirect('product');
    }
    public function edit($id)
    {
        $data['cats'] = DB::table('categories')
            ->where('active', 1)
            ->get();
        $data['units'] = DB::table('units')
            ->where('active', 1)
            ->get();
        $data['pro'] = DB::table('products')->find($id);
        return view('products.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method', 'photo');
        if($request->photo)
        {
            $p = DB::table('products')->find($id);
            $data['photo'] = $request->file('photo')
                ->store('uploads/products', 'custom');
            unlink($p->photo);
        }
        $i = DB::table('products')
            ->where('id', $id)
            ->update($data);
        if($i)
        {
            return redirect('product/detail/'.$id);
        }
        else{
            session()->flash('error', 'Fail to update data!');
            return redirect()->route('product.edit', $id);
        }
    }


    public function import(Request $r)
	{
        // return "Import";

        $path = $r->file('import_file')->getRealPath();
     

        $data = Excel::load($path, function($reader) {

            })->get();

        // return $data->count();
        
        if(!empty($data) && $data->count()){
            foreach ($data as $key => $value) {
                
                $insert = [
                    'name' => $value->name,
                    'code' => $value->code,
                    'barcode' => $value->barcode,
                    'cost' => $value->cost,
                    'category_id' => $value->category_id,
                    'unit_id' => $value->unit_id,
                    'brand' => $value->brand,
                    'description' => $value->description
                ];
                $id = DB::table('products')->insert($insert);
              
            }

            if(!empty($insert))
            {
                // DB::table('products')->insert($insert);
                session()->flash('success', 'Data has been imported successfully!');
                return redirect('product');
            }
            else 
            {
                session()->flash('error', 'Cannot import data, please check again!');
                return redirect('product');
            }
        }
			
    }

    public function save_category(Request $r)
    {
        $id = DB::table('categories')
            ->insertGetId(['name'=>$r->name]);

        $cat = DB::table('categories')->find($id);
        return json_encode($cat);
    }
    public function save_unit(Request $r)
    {
        $id = DB::table('units')
            ->insertGetId(['name'=>$r->name]);

        $cat = DB::table('units')->find($id);
        return json_encode($cat);
    }
}
