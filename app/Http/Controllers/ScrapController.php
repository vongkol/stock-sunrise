<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ScrapController extends Controller
{
    public function index()
    {
        $data['scraps'] =  DB::table('scraps')
            ->join('warehouses', 'scraps.warehouse_id', 'warehouses.id')
            ->where('scraps.active', 1)
            ->select('scraps.*', 'warehouses.name')
            ->paginate(config('app.row'));
        return view('scraps.index', $data);
    }
    public function create()
    {
        $data['ws'] = DB::table('warehouses')
            ->where('active', 1)
            ->get();
        $data['products'] = DB::table('products')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('products.active', 1)
            ->select('products.*', 'units.name as uname')
            ->get();
        return view('scraps.create', $data);
    }
    public function save(Request $r)
    {
        $m = json_encode($r->master);
        $m = json_decode($m);
        $data = array(
            'scrap_date' => $m->scrap_date,
            'reference' => $m->reference,
            'description' => $m->description,
            'warehouse_id' => $m->warehouse_id,
            'scrap_by' => Auth::user()->id
        );
        $i = DB::table('scraps')->insertGetId($data);
       
        if($i)
        {
            $items = json_encode($r->items);
            $items = json_decode($items);
            foreach($items as $item)
            {
                $in = array(
                    'scrap_id' => $i,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'warehouse_id' => $m->warehouse_id
                );
                $x = DB::table('scrap_details')->insert($in);
                if($x)
                {
                    // update onhand
                    Helper::subOnhand($item->product_id, $item->quantity);
                    Helper::subWarehouse($m->warehouse_id, $item->product_id, 
                        $item->quantity);
                }
            }
           
        }
       return $i;
    }
}
