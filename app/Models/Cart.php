<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    private $query;

    protected $fillable = [
        'id',
        'product_id',
        'quantity',
        'status'
    ];

    public function checkProductID($product_id) {
        $dataValues = array(
            'status' => '1',
            'product_id' => $product_id
        );
        $this->query = DB::table('carts')
             ->select('*')
             ->where($dataValues)
             ->get();

        return $this->query;
    }

    public function cartProductModel() {
        $this->query = DB::table('products')
             ->select('*')
             ->join('carts','carts.product_id','=','products.id')
             ->where('status','1')
             ->get();

        return $this->query;
    }

    public function cartProductHistoryModel() {
        $this->query = DB::table('carts')
             ->select('*')
             ->join('products','carts.product_id','=','products.id')
             ->where('status','2')
             ->get();

        return $this->query;
    }

    

}
