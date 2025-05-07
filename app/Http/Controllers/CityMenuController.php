<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CityMenu;
use App\Models\MenuRelation;
use Illuminate\Support\Facades\DB;

class CityMenuController extends Controller
{
    public array $menuIDs = [
        8 =>    ['name' => "Генераторы", 'typeId' => '16-829'],
        7 =>    ['name' => "Стартеры", 'typeId' => '16-829'],
        63 =>   ['name' => "Компрессоры кондиционера", 'typeId' => '16-842'],
        65 =>   ['name' => "Осушители кондиционера", 'typeId' => '16-842'],
        66 =>   ['name' => "Радиаторы кондиционера", 'typeId' => '16-521'],
        615 =>   ['name' => "Испарители", 'typeId' => '16-521'],
        51 =>   ['name' => "Бензонасосы", 'typeId' => '11-627'],
        252 =>  ['name' => "ТНВД и ТННД", 'typeId' => '11-627'],
        155 =>  ['name' => "Форсунки", 'typeId' => '11-627'],
        221 =>   ['name' => "Датчик уровня топлива", 'typeId' => '11-627'],
        9 =>  ['name' => "Насосы", 'typeId' => '11-627'],
        547 =>  ['name' => "Актуаторы", 'typeId' => '16-842'],
        153 =>   ['name' => "Картриджи", 'typeId' => '16-842'],
        39 =>   ['name' => "Турбокомпрессоры", 'typeId' => '16-842'],
        61 =>  ['name' => "Катушки зажигания", 'typeId' => '16-831'],
        98 =>  ['name' => "Коммутаторы", 'typeId' => '16-831'],
        41 =>   ['name' => "Рулевые рейки", 'typeId' => '11-624'],
        113 =>  ['name' => "Редукторы ГУР", 'typeId' => '11-624'],
        70 =>   ['name' => "Насосы ГУР и ЭГУР", 'typeId' => '11-624'],
        71 =>   ['name' => "Вентилятор отопителя", 'typeId' => '11-630'],
        545 =>  ['name' => "Насос гидравлический", 'typeId' => '11-624'],
        516 =>  ['name' => "Сцепление", 'typeId' => '11-62900'],
        518 =>  ['name' => "Ведомый диск", 'typeId' => '11-62900'],
        519 =>  ['name' => "Нажимной диск", 'typeId' => '11-62900'],
        560 =>  ['name' => "Ролики обводные ГРМ", 'typeId' => '16-841'],
        34 =>  ['name' => "Натяжители Ремня ГРМ", 'typeId' => '16-841'],
        489 =>  ['name' => "Пневмобаллоны", 'typeId' => '11-623'],
        490 =>  ['name' => "Компрессоры", 'typeId' => '11-623'],
        // 487 =>  ['name' => "Пневмоподвеска", 'typeId' => '11-623'],
    ];

    private array $typeIdMap = [
        "16-829" => "6-406100",
        "11-627" => "11-62700",
        "16-831" => "16-83100",
        "11-624" => "11-62400",
        "16-842" => "16-84200",
        "11-629" => "11-62900",
        "11-630" => "11-63000",
        "16-841" => "16-84100",
        "16-521" => "16-52100",
    ];


    public $groupAvito = [
        "6-401" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для мототехники',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "6-411" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для водного транспорта',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "6-406" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-618" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Автосвет',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-619" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Аккумуляторы',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-623" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Подвеска',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-624" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Рулевое управление',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-625" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Салон',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-626" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Стекла',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-627" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Топливная и выхлопная системы',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-628" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Тормозная система',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-629" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Трансмиссия и привод',
            'TransmissionSparePartType' => 'Сцепление',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-62900" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => 'Трансмиссия',
            'TransmissionSparePartType' => 'Сцепление',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-630" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Электрооборудование',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-63000" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => 'Двигатели и комплектующие',
            'TechnicSparePartType' => 'Система кондиционирования и отопления',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-521" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => 'Система охлаждения',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-52100" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатели и комплектующие',
            'TechnicSparePartType' => 'Система кондиционирования и отопления',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "19-2855" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Автомобиль на запчасти',
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-805" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Балки, лонжероны',
            'DeviceType' => null,
        ],
        "16-806" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Бамперы',
            'DeviceType' => null,
        ],
        "16-807" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Брызговики',
            'DeviceType' => null,
        ],
        "16-808" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Двери',
            'DeviceType' => null,
        ],
        "16-809" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Заглушки',
            'DeviceType' => null,
        ],
        "16-810" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Замки',
            'DeviceType' => null,
        ],
        "16-811" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Защита',
            'DeviceType' => null,
        ],
        "16-812" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Зеркала',
            'DeviceType' => null,
        ],
        "16-813" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Кабина',
            'DeviceType' => null,
        ],
        "16-814" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Капот',
            'DeviceType' => null,
        ],
        "16-815" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Крепления',
            'DeviceType' => null,
        ],
        "16-816" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Крылья',
            'DeviceType' => null,
        ],
        "16-817" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Крыша',
            'DeviceType' => null,
        ],
        "16-818" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Крышка, дверь багажника',
            'DeviceType' => null,
        ],
        "16-819" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Кузов по частям',
            'DeviceType' => null,
        ],
        "16-820" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Кузов целиком',
            'DeviceType' => null,
        ],
        "16-821" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Лючок бензобака',
            'DeviceType' => null,
        ],
        "16-822" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Молдинги, накладки',
            'DeviceType' => null,
        ],
        "16-823" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Пороги',
            'DeviceType' => null,
        ],
        "16-824" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Рама',
            'DeviceType' => null,
        ],
        "16-825" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Решетка радиатора',
            'DeviceType' => null,
        ],
        "16-826" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Кузов',
            'EngineSparePartType' => null,
            'BodySparePartType' => 'Стойка кузова',
            'DeviceType' => null,
        ],
        "16-827" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Блок цилиндров, головка, картер',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-828" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Вакуумная система',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-829" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Генераторы, стартеры',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-830" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Двигатель в сборе',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-831" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Катушка зажигания, свечи, электрика',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-832" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Клапанная крышка',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-833" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Коленвал, маховик',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-834" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Коллекторы',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-835" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Крепление двигателя',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-836" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Масляный насос, система смазки',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-837" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Патрубки вентиляции',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-838" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Поршни, шатуны, кольца',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-839" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Приводные ремни, натяжители',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-840" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Прокладки и ремкомплекты',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-841" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Ремни, цепи, элементы ГРМ',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-84100" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => 'Двигатели и комплектующие',
            'TechnicSparePartType' => 'ГРМ',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-842" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Турбины, компрессоры',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-84200" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => 'Двигатели и комплектующие',
            'EngineSparePartType' => 'Турбины, компрессоры',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-843" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Электродвигатели и компоненты',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-844" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Двигатель',
            'EngineSparePartType' => 'Впускная система',
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "10-044" => [
            'GoodsType' => 'Шины, диски и колёса',
            'ProductType' => 'Колпаки',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "10-045" => [
            'GoodsType' => 'Шины, диски и колёса',
            'ProductType' => 'Колёса',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "10-046" => [
            'GoodsType' => 'Шины, диски и колёса',
            'ProductType' => 'Диски',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "10-047" => [
            'GoodsType' => 'Шины, диски и колёса',
            'ProductType' => 'Мотошины',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "10-048" => [
            'GoodsType' => 'Шины, диски и колёса',
            'ProductType' => 'Легковые шины',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "28-49575" => [
            'GoodsType' => 'Шины, диски и колёса',
            'ProductType' => 'Шины для грузовиков и спецтехники',
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "4-942" => [
            'GoodsType' => 'Масла и автохимия',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "4-943" => [
            'GoodsType' => 'Аксессуары',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "4-963" => [
            'GoodsType' => 'Инструменты',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "4-964" => [
            'GoodsType' => 'Багажники и фаркопы',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "4-965" => [
            'GoodsType' => 'Прицепы',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "6-416" => [
            'GoodsType' => 'Экипировка',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "20" => [
            'GoodsType' => 'Аудио- и видеотехника',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "21" => [
            'GoodsType' => 'GPS-навигаторы',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "22" => [
            'GoodsType' => 'Тюнинг',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-631" => [
            'GoodsType' => 'Противоугонные устройства',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => 'Автосигнализации',
        ],
        "11-632" => [
            'GoodsType' => 'Противоугонные устройства',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => 'Иммобилайзеры',
        ],
        "11-633" => [
            'GoodsType' => 'Противоугонные устройства',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => 'Механические блокираторы',
        ],
        "11-634" => [
            'GoodsType' => 'Противоугонные устройства',
            'ProductType' => null,
            'SparePartType' => null,
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => 'Спутниковые системы',
        ],

        "33-545" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидромоторы и гидронасосы",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-542" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидромоторы и гидронасосы",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-54200" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидромоторы и гидронасосы",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-887" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидроцилиндры и баки",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-88700" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидроцилиндры и баки",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-896" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидроцилиндры и баки",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-89600" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидроцилиндры и баки",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-891" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидрораспределители",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-89100" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидрораспределители",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-972" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидромоторы и гидронасосы",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "33-97200" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => "Для грузовиков и спецтехники",
            'SparePartType' => "Гидравлические и пневмосистемы",
            'TechnicSparePartType' => "Гидромоторы и гидронасосы",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],

        "6-406100" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => "Двигатели и комплектующие",
            'TechnicSparePartType' => "Стартеры и генераторы",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],

        "11-62700" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => "Двигатели и комплектующие",
            'TechnicSparePartType' => "Топливная система",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "16-83100" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => "Двигатели и комплектующие",
            'TechnicSparePartType' => "Система зажигания",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-62300" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для автомобилей',
            'SparePartType' => 'Подвеска и рулевое управление',
            'TechnicSparePartType' => "Амортизаторы и пружины",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
        "11-62400" => [
            'GoodsType' => 'Запчасти',
            'ProductType' => 'Для грузовиков и спецтехники',
            'SparePartType' => "Подвеска и рулевое управление",
            'TechnicSparePartType' => "Рулевые рейки и усилители",
            'EngineSparePartType' => null,
            'BodySparePartType' => null,
            'DeviceType' => null,
        ],
    ];

    /**
     * Метод добавления записей для города через массивы
     * @param $token
     * @param $address
     * @param $region
     * @param $phone
     * @return bool
     */
    public function addToDatabase($token = 'V78783U8IgfEUMwUKIoSmbVEBXMbmuD5', $address = '196105, г. Санкт-Петербург, ул. Кузнецовская, д. 31', $region = 'Санкт-Петербург', $phone = '+7 (921) 888-14-86')
    {
        DB::beginTransaction();

        try {
            //Заполняем данные для таблиц city и city_menu
            $cityModel = new City();
            $cityModel->region = $region;
            $cityModel->token = $token;
            $cityModel->phone = $phone;
            $cityModel->address = $address;
            $cityModel->save();

            $cityId = $cityModel->id;

            //Заполняем таблицу отношений меню и городов
            foreach ($this->menuIDs as $key => $value) {
                $cityMenuModel = new CityMenu();
                $cityMenuModel->city_id = $cityId;
                $cityMenuModel->menuId = $key;
                $cityMenuModel->name = $value['name'];
                $cityMenuModel->save();
            }

            //Формируем массив для заполнения таблицы menu_relations
            $array = [];
            foreach ($this->menuIDs as $k => $v) {
                $array[$k]['items'][] = $this->groupAvito[$v['typeId']];
                if(array_key_exists($v['typeId'], $this->typeIdMap)) {
                    $array[$k]['items'][] = $this->groupAvito[$this->typeIdMap[$v['typeId']]];
                }
            }

            //Заполняем таблицу отношений url и товара
            foreach ($array as $item => $items) {
                foreach ($items['items'] as $k => $val){
                    $relationModel = new MenuRelation();
                    foreach ($val as $i => $value){
                        $relationModel->menuId = $item;
                        $relationModel->setAttribute($i, $value);
                    }
                        $relationModel->save();
                }
            }

        DB::commit();
        return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
