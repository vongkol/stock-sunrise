<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ReportController extends Controller
{
    public function stock_balance()
    {
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();
        $data['pid'] = '';
        $data['result'] = [];
        return view('reports.balance', $data);
    }
    public function stock_balance_search(Request $r)
    {
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->get();
        $data['pid'] = $r->product;
        $query  = DB::table('products')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('products.active', 1);
        if($r->product!='all')
        {
            $query = $query->where('products.id', $r->product);
        }
        $data['result'] = $query->select('products.*', 'categories.name as cname', 'units.name as uname')
        ->get();
        return view('reports.balance', $data);
    }
    public function stock_balance_print(Request $r)
    {
        
        $query  = DB::table('products')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->where('products.active', 1);
        if($r->pid!='all')
        {
            $query = $query->where('products.id', $r->pid);
        }
        $data['result'] = $query->select('products.*', 'categories.name as cname', 'units.name as uname')
            ->get();
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.balance-print', $data);
    }
    // balance by warehouse
    public function stock_balance_warehouse()
    {
        $data['whs'] = DB::table('warehouses')
            ->where('active', 1)
            ->get();
        $data['warehouse'] = "";
        
        return view('reports.balance-warehouse', $data);
    }
    public function stock_balance_warehouse_print()
    {
        $data['whs'] = DB::table('warehouses')
            ->where('active', 1)
            ->get();
        $data['warehouse'] = "";
        $data['com'] = DB::table('companies')->find(1);
        return view('reports.balance-warehouse-print', $data);
    }
    // stock in report
    public function in()
    {
        $data['whs'] = DB::table('warehouses')
            ->where('active', 1)
            ->get();
        $data['warehouse'] = '';
        $data['result'] = [];
        $data['from'] = date('Y-m-d');
        $data['to'] = date('Y-m-d');
        return view('reports.in', $data);
    }
    public function in_search(Request $r)
    {
        $data['whs'] = DB::table('warehouses')
            ->where('active', 1)
            ->get();
        $data['warehouse'] = $r->warehouse;
        $data['from'] = $r->from;
        $data['to'] = $r->to;
        $query = DB::table('stock_in_details')
            ->join('stock_ins', 'stock_in_details.stock_in_id', 'stock_ins.id')
            ->join('products', 'stock_in_details.product_id', 'products.id')
            ->join('units', 'products.unit_id', 'units.id')
            ->join('warehouses', 'stock_ins.warehouse_id', 'warehouses.id')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.active', 1)
            // ->whereDate('stock_ins.in_date','>=', $r->from)
            ->whereBetween('stock_ins.in_date',[$r->from, $r->to]);
        if($r->warehouse!='all')
        {
            $query = $query->where('stock_in_details.warehouse_id', $r->warehouse);
        }
        $data['result'] = $query->select('stock_in_details.*', 'products.name', 'products.code', 
            'units.name as uname', 
            'categories.name as cname', 'warehouses.name as wname')
            ->get();

        return view('reports.in', $data);
    }
     // stock out report
     public function out()
     {
         $data['whs'] = DB::table('warehouses')
             ->where('active', 1)
             ->get();
         $data['warehouse'] = '';
         $data['result'] = [];
         $data['from'] = date('Y-m-d');
         $data['to'] = date('Y-m-d');
         return view('reports.out', $data);
     }
}
