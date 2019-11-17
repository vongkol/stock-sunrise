<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class Helper
{
    public static function addOnhand($pid, $qty)
    {
        $i = DB::table('products')
            ->where('id', $pid)
            ->increment('onhand', $qty);
        return $i;
    }
    public static function subOnhand($pid, $qty)
    {
        $i = DB::table('products')
            ->where('id', $pid)
            ->decrement('onhand', $qty);
        return $i;
    }
    public static function addWarehouse($wid, $pid, $qty)
    {
        $wh = DB::table('product_warehouses')
            ->where('warehouse_id', $wid)
            ->where('product_id', $pid)
            ->first();
        $i = 0;
        if($wh!=null)
        {
            $i = DB::table('product_warehouses')
                ->where('warehouse_id', $wid)
                ->where('product_id', $pid)
                ->increment('total', $qty);
        }
        else{
            $i = DB::table('product_warehouses')
                ->insert([
                    'warehouse_id' => $wid,
                    'product_id'   => $pid,
                    'total' => $qty
                ]);
        }
        return $i;
    }
    public static function subWarehouse($wid, $pid, $qty)
    {
        $wh = DB::table('product_warehouses')
            ->where('warehouse_id', $wid)
            ->where('product_id', $pid)
            ->first();
        $i = 0;
        if($wh!=null)
        {
            $i = DB::table('product_warehouses')
                ->where('warehouse_id', $wid)
                ->where('product_id', $pid)
                ->decrement('total', $qty);
        }
        else{
            $i = DB::table('product_warehouses')
                ->insert([
                    'warehouse_id' => $wid,
                    'product_id'   => $pid,
                    'total' => $qty
                ]);
        }
        return $i;
    }
    // function to convert arabic number to khmer number
    public static function get_kh_num($n)
    {
        $kh = ["០","១","២","៣","៤","៥","៦","៧","៨","៩"];
        $result = "";
        $n = $n . "";
        for($i=0;$i<strlen($n);$i++)
        {
            $index = (int)$n[$i];
            $result .= $kh[$index];
        }
        return $result;
    }
    public static function get_kh_date($date)
    {
        // $data = date_create($date);
        $y = date_format(date_create($date), 'Y');
        $m = date_format(date_create($date), 'm');
        $d = date_format(date_create($date), 'd');
        $result = Self::get_kh_num($d) . '-' . Self::get_kh_num($m) . '-' . Self::get_kh_num($y);
        return $result;
    }
}