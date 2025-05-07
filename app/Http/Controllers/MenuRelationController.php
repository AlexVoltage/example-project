<?php

namespace App\Http\Controllers;

use App\Models\MenuRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\CityMenu;
use Illuminate\Support\Facades\Validator;

class MenuRelationController extends Controller
{

    /**
     * Метод создавался для добавления одичной записи в таблицу через postman
     * @param Request $request
     * @return MenuRelation|string
     */
    public function create(Request $request)
    {

         $validatedData = $request->validate([
            'menuId' => 'required|numeric|min:0',
            'GoodsType' => 'required|string|max:255',
            'ProductType' => 'required|string|max:255',
            'SparePartType' => 'nullable|string|max:255',
            'DeviceType' => 'nullable|string|max:255',
            'key.*' => 'nullable|string|max:255',
            'value.*' => 'nullable|string|max:255'
        ]);

        $counts = MenuRelation::where('menuId', $validatedData['menuId'])->get();
        $counts = count($counts->toArray());

        //Собираем массив ключей и значений для добавления (недобавления в таблицу)
        $array  = [];
        if(!empty($validatedData['key'])) {
            for ($i = 0; $i < count($validatedData['key']); $i++) {
                $array[$validatedData['key'][$i]] = $validatedData['value'][$i];
            }
        }

        if ($counts >= 2) {
            return  'Больше двух одинаковых menuId';
        } else {
                $productTable = new MenuRelation();
                $productTable->menuId = $validatedData['menuId'];
                $productTable->GoodsType = $validatedData['GoodsType'];
                $productTable->ProductType = $validatedData['ProductType'];
                $productTable->SparePartType = $validatedData['SparePartType'] == 'null' ? null :  $validatedData['SparePartType'];
                if(!empty($array)) {
                    foreach ($array as $key => $value) {
                        $productTable->setAttribute($key, $value);
                    }
                }
                $productTable->save();

            return $productTable;
        }
    }

    /**
     * Метод для отображения всех записей через токен
     * @param Request $request
     * @return array|bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getAll(Request $request)
    {
        //Массив для смены наименования ключей
        $changeKeyName = [
            'Для автомобилей' => 'avto',
            'Для грузовиков и спецтехники' => 'truck'
        ];

        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ], [
            'token.required' => 'Поле город обязательно для заполнения.',
            'token.string' => 'Поле город должно быть текстом.'
        ]);

        if ($validator->fails()) {
            return $validator->fails();
        }

        $city = City::with('cityMenus.menuRelations')
        ->where('token', $validator->validated()['token'])->firstOrFail();

        $array = [];
        $array['info'] = ['region' => $city->region, 'address' => $city->address, 'phone' => $city->phone];
        foreach ($city->cityMenus as $menu) {
            $menuId = $menu->menuId;
            $menuName = $menu->name;

            foreach ($menu->menuRelations->toArray() as $relation) {
                $productType = $relation['ProductType'];

                $newRelation = array_merge($relation, ['name' => $menuName]);

               $array['items'][$menuId][$changeKeyName[$productType]][] = $newRelation;
            }
        }

        return $array;
    }
}
