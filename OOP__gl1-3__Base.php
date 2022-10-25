<?php

error_reporting(E_ALL|E_ERROR|E_WARNING|E_NOTICE|E_DEPRECATED|E_STRICT);

// Практика по книге - Объекты, шаблоны и методики программирования

// Клиентский код - код, который имеет, классы, методы, объекты

//--------------------------------------------------------------------------------------------------------------------------------------------//

   // Динамические св-ва, назначение св-в в объектах

class ShopProductJun
{
   public $title = 'Стандартынй товар';
   public $productName = 'Имя автора';
   public $productSubName = 'Фамилия автора';
   public $price = '0';
}

$product1 = new ShopProductJun();
$product1->productName = 'Александр';
$product1->productSurName = 'Пушкин';  // --->

   // В объекте назначено динамическое св-во (т.е., я написал св-во, которого нет в классе),
   // Не стоит писать св-ва таким образом, ведь в дальнейшем результат будет неожиданный
   // Поэтому, назначем и выведем св-ва непосредственно в самих методах

echo '<hr>' . '<br>Динамические св-ва' . '<br><br>' . 
     'Автор: ' . $product1->productName . ' ' .  $product1->productSurName; // --->

     // Таким способом не стоит пользоваться, т.к. для этого существуют методы

//--------------------------------------------------------------------------------------------------------------------------------------------//

   // Методы - функции объявленные в классе

   // __construct - специальный метод, который настраивает экземпляр класса

class ShopProductCons
{
   public $title;
   public $productName;
   public $productSubName;
   public $price;

   public function __construct($title, $name, $subName, $price) // Обязательные св-ва при создании экземпляра данного класса
   {
      $this->title = $title;
      $this->productName = $name;
      $this->productSubName = $subName;
      $this->price = $price;
   }

   public function getPrint() //Функция вывода св-в класса
   {
      return '<hr>' . '<br>Юзабельность конструктора' . '<br><br>' . 'Книга:' . ' ' . $this->title .
             '<br>' . 'Издатель:' . ' ' . $this->productName . ' ' . $this->productSubName .
             '<br>' .  'Цена:' . ' ' . $this->price;
   }
}

$product1 = new ShopProductCons(
   'Удалец', 
   'Сергей', 
   'Есенин', 
   '499'); // Аргументы св-в конструктора
echo $product1->getPrint(); // Вывод св-в класс с введёнными аргументами в конструкторе

   /**   Во-первых, мы экономим время
     *   Во-вторых, лучше читаемость
     *   В-третьих, не будут неинициализированные св-ва в объекте
   **/
//--------------------------------------------------------------------------------------------------------------------------------------------//

// __construct - объяевление св-в в конструторе и вписание аргументов по умолчанию

class ShopProductCons2
{
   
   public function __construct(
      public $title,
      public $name = '',
      public $subName = '',
      public $price = 0
   ) // Обязательные св-ва при создании экземпляра данного класса
   {
   }

   public function getPrints() //Функция вывода св-в класса
   {
      return '<hr>' . '<br>Объявление св-в в конструкторе с аргументами по умолчанию' . '<br><br>' . 'Книга:' . ' ' . $this->title .
             '<br>' . 'Издатель:' . ' ' . $this->name . ' ' . $this->subName .
             '<br>' .  'Цена:' . ' ' . $this->price;
   }
}

$product1 = new ShopProductCons2(
   title: 'Книги', 
   price: 499  // Синатаксис конструтора, если св-ва назначаются в нём, а не в классе
); 
echo $product1->getPrints();

   /**   Во-первых, мы код становиться короче
     *   Во-вторых, лучше читаемость по сравнению с предыдущим вариантом
     *   В-третьих, аргументы стоят по умолчанию и если они не назначены в объекте   --->
     *   и не нужно будет их назначать в объекте следующим образом ---> $object = new class('...', '', '', '...')
   **/

//--------------------------------------------------------------------------------------------------------------------------------------------//

// Типы данных в ОПП

// Нужно обязательно следить за типами данных в своём коде, иначе результат будет непредсказемым
// Допустим, нам из SimpleXML API для преобразования IP В доменное имя
// В параметр вписывается булевое значение <resolveddomains>false<resolveddomains/>
// При выполнение кода в методе, аргумент может принять значение true, то в этом случае метод выведет, как IP, так и домены

//Как лучше назначать типы данных в ООП?

class dataType {

   public function __construct(public $address = ['192.201.06.256'])
   {

   }

   public function outputAddressesPreg($resolve) {// Такой метод не имеет строгий интерфейс и двухсмысленнен, хоть и имеет на выходе логическое выражение
      if (is_string($resolve)) {
      $resolve = (preg_match ("/^ (false|noloff) $/i", $resolve)) ? false: true;
      }
   }

   /**
     * Вывести список адресов.
     * Если переменная $resolve содержит значение true, * то адрес преобразуется в эквивалентное имя хоста.
     * @param $resolve Boolean Преобразовать адрес? 
   **/
   public function outputAddressesComment($resolve) {
      // В этом слусае всё обстаит на много понятнее, но в таком случае, надо быть уверенным, что программисты прочтут инструкцию к применению метода
   }

   function outputAddresses ($resolve) {
      if (!is_bool($resolve)) {
         // Принять решительные меры
      }
   }
}

//--------------------------------------------------------------------------------------------------------------------------------------------//

// Объявление типов : объектные типы - 70 стр

class dataTypes
{
   
   public function __construct(
      public $title,
      public $name = '',
      public $subName = '',
      public $price = 0
   )
   {
   }
}

class dataTypesWrite
{

   public function write(dataTypes $shopProduct) //Функция вывода св-в класса dataTypes 
                                                //(при вызове этого метода других классов - fatal error)  ---> объектный тип
   {
      return '<hr>' . '<br>Разделение ответственности в классах' . '<br><br>' . 'Книга:' . ' ' . $shopProduct->title .
             '<br>' . 'Издатель:' . ' ' . $shopProduct->name . ' ' . $shopProduct->subName .
             '<br>' .  'Цена:' . ' ' . $shopProduct->price;
      // Аргумент назначается по той причине, что методу не от куда брать св-ва, т.к. он независем от другого. Поэтому $this->непрокатит;
   }
}

$write = new dataTypesWrite();
$product1 = new dataTypes(
   title: 'Книги',
   name: 'Marco',
   subName: 'Polo',
   price: 499
); 
$product2 = new dataTypes(
   title: 'Книги2',
   name: 'Marco2',
   subName: 'Polo2',
   price: 500
);
echo $write->write($product1);
     $write->write($product2); // Не приходиться даже создавать экземпляр для второго объекта (код сокращается и становиттся более читаемым)



//--------------------------------------------------------------------------------------------------------------------------------------------//

// Объявление типов: примитивные типы

class dataTypePrimary
{
   public $title;
   public $productName;
   public $productSubName;
   public $price;

   public function __construct(string $title, string $name, string $subName, float $price) // Обязательные св-ва при создании экземпляра данного класса
   {
      $this->title = $title;
      $this->productName = $name;
      $this->productSubName = $subName;
      $this->price = $price;
   }

   public function getPrint() //Функция вывода св-в класса
   {
      return '<hr>' . '<br>Объявление типов в св-вах' . '<br><br>' . 'Книга:' . ' ' . $this->title .
             '<br>' . 'Издатель:' . ' ' . $this->productName . ' ' . $this->productSubName .
             '<br>' .  'Цена:' . ' ' . $this->price . '<hr>';
   }
}

$product1 = new dataTypePrimary('Титул', 'Имя', 'Фамилия', '66.5');
echo $product1->getPrint();

//--------------------------------------------------------------------------------------------------------------------------------------------//

// Смешаные типы данных, объединения

class Mixeded {

   public function addMix(string $key, mixed $value) 
   {
      //mixed принимает значение всех типов данных (для того, что бы не вводить заблуждение программистов), применяется для любых значений
   }

   // объеденение

   public function addAttach(string $key, bool $value) 
   { // Типизация данных
      if (!is_bool($key) && !is_string($value)) 
      { // Валидация и ограничение на тип данных
         echo 'Значение должно быть не строкой и не булевым значением, а не ' . gettype($key) . ' ' . gettype($value);
         return false;
      }
      echo 'Молодца';
   }
}

//--------------------------------------------------------------------------------------------------------------------------------------------//

// Наследование

// Давайте представим, если не существовало наследования, каким объёмом были бы классы и какие были бы ньюансы?

class productNotInherit
{
   public $title;
   public $productName;
   public $productSubName;
   public $price;
   public $page;    // кол-во страниц
   public $length;  // время проигрования пластины


   public function __construct(string $title, 
                               string $name, 
                               string $subName, 
                               float $price,
                               int $page,
                               float $length) // Обязательные св-ва при создании экземпляра данного класса
   {
      $this->title = $title;
      $this->productName = $name;
      $this->productSubName = $subName;
      $this->price = $price;
      $this->page = $page;
      $this->length = $length;
   }

   public function getPrint() // Таким случаем пользоваться не вариант, если в одном классе будут содержаться разные по св-вам объекты
   {
      return '<hr>' . '<br>Класс без наследования' . '<br><br>' . 'Книга:' . ' ' . $this->title . // А может быть и не книга
             '<br>' . 'Издатель:' . ' ' . $this->productName . ' ' . $this->productSubName .      // А может быть и не издатель
             '<br>' .  'Цена:' . ' ' . $this->price;                                              // Ладно
   }

   public function getPage() : int
   {
      return '<br>' . 'Номер страницы: ' . $this->page;
   }

   public function getLength() : float
   {
      return '<br>' . 'Время проигрывания: ' . $this->length;
   }
   
   public function getProducer() : string
   {
      return '<br>' . 'Автор: ' . $this->productName . ' ' . $this->productSubName;
   }
   
}

// Во-первых, избыток методов и св-в
// Во-вторых, в объекте для конструктора надо будет указывать все значения
// Можно создать и два класса, но некоторые методы будут повторяться, а это уже выходит за рамки принципа SOLID


//Применение наследования и логически правильно спроектированное ООП

class productInherit
{

   public function __construct(
      $title,
      $name,
      $subName,
      $price
   )
   {
      $this->title = $title;
      $this->name = $name;
      $this->subName = $subName;
      $this->price = $price;
   }

   public function getWrite() // Перекрытый метод
   {
            $base =  $this->title;
            $base .= '<br>' . 'Издатель:' . ' ' . $this->name . ' ' . $this->subName;
            $base .= '<br>' .  'Цена:' . ' ' . $this->price . '<br>';
            return $base;
   }
}

class productInheritBook extends productInherit
{
   public $numPage;

   public function __construct
   (
     string $title,
     string $name,
     string $subName,
     float $price,
     int $numPage
   )
   {
      parent::__construct($title, $name, $subName, $price);
      $this->numPage = $numPage;
   }

   public function getNum()
   {
      return 'Количество страниц:' . ' ' . $this->numPage . '<hr>';
   }

   public function getWrite() : string
   {
            $base = '<br>' . 'Класс productBook' . '<br><br>';
            $base .= parent::getWrite(); // Вызов перекрытого метода
            $base .= $this->getNum();
            return $base;
   }
}

class productInheritAudio extends productInherit
{
   public $audio;

   public function __construct(
     string $title,
     string $name,
     string $subName,
     float $price,
     float $audio
   )
   {
      parent::__construct($title, $name, $subName, $price, $audio);
      $this->audio = $audio;
   }

   public function getAudio()
   {
      return 'Время исполнения:' . ' ' . $this->audio  . '<hr>';
   }

   public function getWrite() : string
   {
      $base = '<br>' . 'Класс productAudio' . '<br><br>';
      $base .= parent::getWrite(); // Вызов перекрытого метода
      $base .= $this->getAudio();
      return $base; 
   }
}

$product1 = new productInheritBook('Царь', 'Василий', 'Тёркин', '499', '128');
echo $product1-> getWrite();

$product2 = new productInheritAudio('Песня', 'Группа', 'Ленинград', '499', '1.28');
echo $product2-> getWrite();


//--------------------------------------------------------------------------------------------------------------------------------------------//

//Управление доступом - модификаторы: public, private, protected

#  !!! pubcic - можно получить достпуп из разных источников, из классов и подклассов  
#  !!! private - можно получить доступ исключительно в том классе, где он написан
#  !!! protected - можно получить доступ в классе, в котором он написан, и в подклассе, но нельзя подключиться  к нему из внешних источников

// Напримере напишем в закрепление полноценное семейство классов с применением модифтикаторов

class shopProduct
{

   public function __construct(
                              private string $title = '',
                              private string $name = '',
                              private string $subName = '',
                              private int|float $price = 0,
                              private int|float $discount = 0
                              )
   {
   }

   public function getDiscount() 
   {
      return '<br>' . 'Цена со скидкой:' . ' ' . $this->price - $this->discount . '<hr>' . '<br>';
   }
   
   protected function getWrite()
   {
      $base =  '<br>' . 'Категория:' . ' ' . $this->title;
      $base .= '<br>' . 'Издатель:' . ' ' . $this->name . ' ' . $this->subName;
      $base .= '<br>' . 'Цена:' . ' ' . $this->price;
      return $base;
   }
}

class shopProductBook extends shopProduct
{

   public function __construct(
                              string $title = '',
                              string $name = '',
                              string $subName = '',
                              int|float $price = 0,
                              int|float $discount = 0,
                              private int $numPage = 0
                              )
   {
      parent::__construct($title, $name, $subName, $price, $discount);
      $this->numPage = $numPage;
   }

   public function getNum()
   {
      return  '<br>' . 'Количество страниц:' . ' ' . $this->numPage;
   }

   public function getWrite() : string
   {
            $base = '<br>' . 'Класс shopProductBook' . '<br><br>';
            $base .= parent::getWrite(); // Вызов перекрытого метода
            $base .= $this->getNum();
            return $base;
   }
}

class shopProductAudio extends shopProduct
{

   public function __construct(
                              string $title = '',
                              string $name = '',
                              string $subName = '',
                              int|float $price = 0,
                              int|float $discount = 0,
                              private float $audio =  0
                              )
   {
      parent::__construct($title, $name, $subName, $price, $discount);
      $this->audio = $audio;
   }

   public function getAudio()
   {
      return  '<br>' . 'Время исполнения:' . ' ' . $this->audio;
   }

   public function getWrite() : string
   {
      $base = '<br>' . 'Класс shopProductAudio' . '<br><br>';
      $base .= parent::getWrite(); // Вызов перекрытого метода
      $base .= $this->getAudio();
      return $base; 
   }
}

// Объекты для книг

$productBook1 = new shopProductBook(
   title: 'Книга',
   name: 'Афанасий',
   subName: 'Фет',
   price: 499,
   discount: 100,
   numPage: 248
);
echo $productBook1->getWrite();
echo $productBook1->getDiscount();

// Объекты для аудио

$productAudio1 = new shopProductAudio(
   title: 'Аудиозапись',
   name: 'Максим',
   subName: 'Корж',
   price: 499,
   discount: 200,
   audio: 2.34
);
echo $productAudio1->getWrite();
echo $productAudio1->getDiscount();


//--------------------------------------------------------------------------------------------------------------------------------------------//

/** 
  * Вывод: 
  * Основы Конструктор и объяления переменных в нём
  * Типизация данных и смешивание
  * Модификаторы
  * Наследование
**/

