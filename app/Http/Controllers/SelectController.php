<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsType;
use App\Models\ProductType;
use App\Models\SparePartType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class SelectController extends Controller
{
    public function select(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'good_type_id' => 'required|numeric|min:0',
        ], [
            'good_type_id.required' => 'Поле Тип товара обязательно для заполнения.',
            'good_type_id.numeric' => 'Поле Тип товара должно быть числом.',
            'good_type_id.min' => 'Значение поля Тип товара не может быть отрицательным.',
        ]);

        if ($validator->fails()) {
            return $validator->fails();
        }

        $idType = $validator->validated()['good_type_id'];

        try {
            $goodsCategory = GoodsType::with('productType.sparePartType')->findOrFail($idType);

            $goodsCategory->productType->pluck('sparePartType', 'id');

            return response()->json($goodsCategory);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e], 404);
        }
    }
}
