<?php
error_reporting(E_ALL|E_ERROR|E_WARNING|E_NOTICE|E_DEPRECATED|E_STRICT);

//--------------------------------------------------------------------------------------------------------------------------------------------//

//  Расширенные возможности PHP


//  Статические методы и св-ва

//  Доступ к методам и свойствам можно получать в контексте класса, а не объекта. Такие методы и свойства являются статическими и должны быть объявлены с помощью ключевого слова static, как показано ниже:

//  Объявления статики происходят следующим образом:

//  Класс::метод или св-во

//  Использование метода или св-ва — (статического) в самом классе пишется следующим образом:

//  self::метод или св-во

//  Часто можно заметить что используют следующую конструкцию в справочниках и рук-ах:

//  Класс::метод (он может быть и не статическим, они просто показывают, что это св-во или метод есть в этом классе)

//  Статика нужна для того, что бы получить к ней доступ из других классов, при этом не наследовать


class shopStatic 
{
   public static float $des = 2;

   public static function echo() 
   {
      return 'Объявление статической функции и св-ва' . '<br>' . self::$des . '<br><br>' ;
   }
}

class shopStaticTest 
{
   public function echoStatic()
   {
      return shopStatic::echo();
   }
}
$shop = new shopStaticTest();
echo $shop->echoStatic();


//--------------------------------------------------------------------------------------------------------------------------------------------//


//  Константы
 
//  Во-первых, их нельзя передавать в объект.
//  Во-вторых, их нельзя переопределять
//  Синтаксис констант:

class constant
{
   const AVAILABLE = 0;
   const OUT_OF_STOCK = 1;
}

//  Константы следует использовать в тех случаях, когда свойство должно быть доступным для всех экземпляров класса.





//--------------------------------------------------------------------------------------------------------------------------------------------//


//  Абстрактные классы

//  Абстрактный класс отличается тем, что невозможно создать его экземпляр.

//  Вместо этого в нем определяется (и, возможно, частично реализуется) интерфейс для любого класса, который может его расширить.

//  Абстрактный метод не может быть
//  реализован в абстрактном классе. Он объявляется как обычный метод, но объявление завершается точкой с запятой, а не телом метода.


abstract class shopAbstract
{
   protected array $product = [];

   function addProduct($shopProduct) 
   {
      $this->product = $shopProduct;
   }

   abstract public function productWrite(); //Переназначаем этот метод под свои цели в наследуемые классы, к примеру в один файл запис. XML в др. txt
}

//  После чего мы переназначаем этот метод в наследуемых классах


//--------------------------------------------------------------------------------------------------------------------------------------------//


//  Интерфейсы

//  Как известно, в абстрактном классе допускается реализация некоторых методов, не объявленных абстрактными.

//  В отличие от них, интерфейсы - это чистые шаблоны. С помощью интерфейса можно только определить функциональность, но не реализовать ее.

//  Для объявления интерфейса используется ключевое слово i n t e r f a c e . В интерфейсе только объявления, но не тела методов.

interface carInterface
{
   public function getBodywork() : string; 
}

class car implements carInterface
{
   public function __construct(
                              public string $bodywork = ''
                              )
   {
      
   }

   public function getBodywork() : string {
      return  '<br>' . 'Интерфейсы:' . '<br>' . $this->bodywork . '<br><br>';
   } 
}

$interface = new car(
   bodywork: 'Bodywork'
);
echo $interface->getBodywork();

//  Интерфейс очень похож на абстрактный класс. В любом классе, поддерживающем этот интерфейс, необходимо реализовать все
//  определенные в нем методы. В противном случае класс должен быть обьявлен как абстрактный.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Трейты основы

// По существу, трейты это классы, экзмепляры которых нельзя получить, но можно включить в др. классы
// Трейты изменяют структуру класса, но не меняют его тип

interface shopInterface
{
   public function calculateTex(int $price);
   public function genarateId(int $price);
}

trait priceUtilit 
{
   private int $taxrate = 20;

   public function calculateTex(int $price) : string
   {
      return 'Ваша скидка составляет:' . ' ' . (($this->taxrate / 100) * $price) . '<br>';
   }
}

trait uniqueId
{
   public function genarateId(int $price)  : string
   {
      return 'Ваш id:' . ' ' . $price . '<br><br>';   
   }
}

class shopProductTrait implements shopInterface
{
   use priceUtilit;  // вызов трейта
   use uniqueId;     // вызов трейта

   public function __construct(
      public $title,
      public $name = '',
      public $subName = '',
      public $price = 0
   )
   {
   }

   public function getPrints()
   {
      return '<br>Использование нескольких трейтов с интерфейсом' . '<br>' . 'Книга:' . ' ' . $this->title .
             '<br>' . 'Издатель:' . ' ' . $this->name . ' ' . $this->subName .
             '<br>' .  'Цена:' . ' ' . $this->price . '<br>'; 
   }
}

$product1 = new shopProductTrait(
   title: 'Книги', 
   price: 499
); 

echo $product1->getPrints();
echo $product1->calculateTex(78);
echo $product1->genarateId(1);

//--------------------------------------------------------------------------------------------------------------------------------------------//

// Использование статики в трейтах 

trait priceUtilitStatic 
{
   private static int $taxrate = 20;

   public static function calculateTex(int $price) : string
   {
      return 'Ваша скидка составляет:' . ' ' . ((self::$taxrate / 100) * $price) . '<br><br>';
   }
}

class shopProductTraitStatic
{
   use priceUtilitStatic;     // вызов трейта

   public function __construct(
      public $title,
      public $name = '',
      public $subName = '',
      public $price = 0
   )
   {
   }

   public function getPrints()
   {
      return '<br>Использование статики в трейтах' . '<br>' . 'Книга:' . ' ' . $this->title .
             '<br>' . 'Издатель:' . ' ' . $this->name . ' ' . $this->subName .
             '<br>' .  'Цена:' . ' ' . $this->price . '<br>'; 
   }
}

$product2 = new shopProductTraitStatic(
   title: 'Книги', 
   price: 499
); 

echo $product2->getPrints();
echo shopProductTraitStatic::calculateTex(2); // статический вызов


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Доступ к св-вам

#        class shopProductHost
#        {
#           use priceUtilitStatic;     // вызов трейта
#           public $taxrate = 20;
#        }

// Далеко не самое лучшее решение назаначать св-ва трейта в классах, ведь никто не даёт гарантии, что св-ва будут объявленны в др
// Классах, поэтому так делать категорически не рекомендуется!!!


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Определение абстрактных методов к трейтах

trait priceUtilitAbstract
{
   public function calculateTex(int $calc, int $price) : string
   {
      return 'Ваша скидка составляет:' . ' ' . (($calc / 100) * $price + $this->numpad()) . '<br>';
   }
   abstract public function numpad();
}

class shopProductTraitAbstract
{
   use priceUtilitAbstract;     // вызов трейта

   public function __construct(
      public $title,
      public $name = '',
      public $subName = '',
      public $price = 0
   )
   {
   }

   public function numpad()
   {
      echo '';
   }

   public function getPrints()
   {
      return '<br>Использование абстрактного метода в трейтах' . '<br>' . 'Книга:' . ' ' . $this->title .
             '<br>' . 'Издатель:' . ' ' . $this->name . ' ' . $this->subName .
             '<br>' .  'Цена:' . ' ' . $this->price . '<br>'; 
   }
}

$product = new shopProductTraitAbstract(
   title: 'abstraction'
);
echo $product->getPrints();
echo $product->calculateTex(40, 4);


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Исключения (excaption)

// Исключения - это объект, который является экземпляром класса exception, класс в свою очередь хранит информацию об ошибках и выдачи msg о них

/**
  *      Exception::__construct — Создать исключение
  *      Exception::getMessage — Получает сообщение исключения
  *      Exception::getPrevious — Возвращает предыдущий объект, реализующий Throwable
  *      Exception::getCode — Получает код исключения
  *      Exception::getFile — Получает файл, в котором возникло исключение
  *      Exception::getLine — Получает строку, в которой возникло исключение
  *      Exception::getTrace — Получает многомерный массив отслеживаещий вызовы метода, кот. првели к исключ.
  *      Exception::getTraceAsString — Получает строковый вариант getTrace
  *      Exception::__toString — Строковое представление исключения
**/

// Генерация исключений

use Exception;

class ex {

   public function __construct(public string $file)
   {
      try{
         if(!file_exists($file)) {
            throw new Exception("Файл:" . ' ' .  $file . ' ' . 'не существует');
         }
      }
      catch(Exception $set){
         echo $set->getMessage();
      }
   }
   public function readTXT($file){
      return fopen($file, 'r');
   }
}
$ex = new ex('exeption.txt'); // Файл не существует

//--------------------------------------------------------------------------------------------------------------------------------------------//

// Магические методы (перехватчики)

// __get и __set - преднозначены для работы со св-ми, которые не были объявлены в классе (и в родительских классах), get - читает, set - пишет
// __isset и __unset - преднозначены для работы с функциями isset, unset, которые в неопределённых св-вах
// __call и __callStatic - преднозначены для работы с функциями статич. и не статич; которые не были объявлены


//--------------------------------------------------------------------------------------------------------------------------------------------//

//__destructor - сохраняет данные экземпляры класса и удаляет его из ОЗУ

class personal
{
   private int $id = 0;

   public function __construct(
                              protected string $name = '',
                              private int $age = 0
   )
   {
      $this->name = $name;
      $this->age = $age;
   }

   public function setID(int $id)
   {
      $this->id = $id;
   }
   
   public function __destruct()
   {
      if(!empty($this->id)) 
      {
         // Записываем в бд по id
         echo '<br><br>' . 'Деструктор' . '<br>' . 'Записаны данные в класс personal' . '<br><b>';
      }
   }
}


$pers = new personal();
$pers->setID(32);
unset($pers);

//Reflection API

//--------------------------------------------------------------------------------------------------------------------------------------------//

// __clone - клонирование объектов

// При реализации метода клон, нужно знать содержимое в котором реализуется данный метод, этот метод реализуется для копируемого объекта
// а не для исходного

#        class Account 
#        {
#           public function __construct(public float $balance)
#           {
#              
#           }
#        }
#        
#        class personas
#        {
#           private int $id = 0;
#        
#           public function __construct(
#                                      private string $name = '',
#                                      private int $age = 0,
#                                      public Account $account 
#           )
#           {
#           }
#        
#           public function setID(int $id)
#           {
#              return '<br><br>' . 'Клонирование объектов' . '<br>' . 'ID:' . ' ' . $this->id = $id;
#           }
#           
#           public function __clone()
#           {
#              return '<br><br>' . 'Деструктор' . '<br>' . 'ID:' . ' ' . $this->id = 0;
#           }
#        }
#        
#        $pers = new personas('Дмитрий Жмыхов', 17, new Account(200));
#        $pers->setID(132);
#        $pers2 = clone $pers;
#        $pers->account->balance += 20;
#        echo $pers2->account->balance;


//--------------------------------------------------------------------------------------------------------------------------------------------//

// __toString 

// Метод для записи информации в файлы регистрации и выдачи ошибок, а так же для классов, цель которых, передавать информацию


//--------------------------------------------------------------------------------------------------------------------------------------------//

// callback, анонимнеые функции и функции замыкания

class Product   // задаёт св-ва для класса productSale
{
   public function __construct(
                              public string $name, 
                              public float $price
   )
   {
   }
}

class productSale
{
   private array $callbacks;
   
   public function regCallback(callable $callback) : void
   {
      $this->callbacks[] = $callback;
   }

   public function sale(Product $product)
   {
      echo '<br><br>' . 'Функция обратного вызова (анонимная)' . '<br>' . $product->name . ' ' . 'обрабатывается!' . '<br>';

      foreach ($this->callbacks as $callback) // перебирает массив и ссылается на callable
      {
         call_user_func($callback, $product); // объявление функции callback, ключ
      }
   }
}

class total
{
   public static function totalPrice() : callable
   {
      return function(Product $product) // Анонимная функция, которая проверяет прайс, не привышает ли он цену и выводи сообщение
      {
         if($product->price > 5)
         {
            echo '<br>' . 'Высокая средняя цена на товар: ' . $product->price;
         }
      };
   }
}

// Пример анонимной функции в объекте

$sale = function($product)   // Наша анонимная функция sale, которая помещается в массив
{
   echo 'Записываем:' . ' ' . "категория ($product->name)" . '<br>' . "Средняя цена: $product->price";
};

$product = new productSale;
$product->regCallback($sale);
$product->sale(new Product('Обувь', 499));

// Пример анонимной - стрелочной функции в объекте

$saleCursor = fn($product) => print 'Записываем:' . ' ' . "категория ($product->name)" . '<br>' . "Средняя цена: $product->price";
$product2 = new productSale;
$product2->regCallback($saleCursor);
$product2->regCallback(total::totalPrice()); // Обращение к анонимной функции
$product2->sale(new Product('Запчасти', 499));

//    Создаётся класс Product, который хранит данные о товаре

//    Создаётся класс productSale, который вызывает callback function

//    regCallback - содержит аргумент callback $callback, который ссылкается на массив и назначется callback массивом

//    sale - анонимная функция, которая св-ва берёт из класса Product
//    и выводит данные, перебирает массив callbacks
//    ЗАМУДРИЛИ ХУЖЕ НЕКУДА!!!


//--------------------------------------------------------------------------------------------------------------------------------------------//