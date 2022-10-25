<?php
namespace Book\gl5;

//--------------------------------------------------------------------------------------------------------------------------------------------//

// PHP и Пакеты

// Пакеты и пространства имён в PHP

/**
 *  Пространсто имён решают следующие проблемы:
 * 
 *  Конфликт имён между вашим кодом и внутренними классами/функциями/константами PHP или сторонними.
 *  Возможность создавать псевдонимы (или сокращения) для Ну_Очень_Длинных_Имён, чтобы облегчить первую проблему и улучшить 
 *  читаемость исходного кода.
*/


/**
 * Вызов кода из пространства имен
 * 
 * Неполное имя (Unqualified name)
 * Полное имя (Qualified name)
 * Абсолютное имя (Fully qualified name)
 */


//--------------------------------------------------------------------------------------------------------------------------------------------// 

// Неполное имя:

 class MyClass {
     public static function static_method()
     {
       echo 'Hello, world!';
     }
     
}

// Неполное имя, используется в текущем пространстве имен (MyProject\MyClass)
// MyClass:static_method();


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Полное имя

// namespace MyProject\Database;
 
# require 'myproject/fileaccess/input.php';
 
// Попытка доступа к MyProject\FileAccess\Input классу
// $input = new MyProject\FileAccess\Input();


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Абсолютное имя

// Если Вы хотите получить доступ к функции, классу или константе находящимся на более высоком уровне иерархии, 
// то вам нужно использовать полное имя — абсолютный путь, а не относительный. Вызов должен начинаться с обратного слэша. 

// Это позволяет PHP понять, что этот вызов должен быть осуществлен из глобального пространства, 
// а не обращаться к нему относительно Вашего текущего положения.

// namespace MyProject;
 
#  var_dump($query);  // Перегруженный
#  \var_dump($query); // Встроенный
 
// Мы хотим получить доступ к глобальному Exception классу
// Приведенный ниже код не будет работать, так как класса Exception нет в пространстве имен 
// MyProject\Database и неполное имя класса не имеет доступа к глобальному пространству
// throw new Exception('Query failed!');
 
// Вместо этого, мы используем обратный слеш, чтобы указать, что мы хотим работать с глобальным пространством
#  throw new \Exception('ailed!');
 
// function var_dump($dsf< 4) {
//     echo 'Overloaded global var_dump()!<br />';
// }


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Ключевое слово namespase

// Ключевое слово namespace используется не только для определения пространства имен, 
// оно также может быть использован для вызова в текущем пространстве имен, функционально аналогичный ключевому слову self для классов.

// namespace MyProject;
 
function run() 
{
    echo 'Running from a namespace!';
}
 
// Resolves to MyProject\run
#  run();
// Explicitly resolves to MyProject\run
#  namespace\run();

echo __NAMESPACE__;


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Ипорт ПИ

// Если директория в ПИ разная, то следует подключать директории


#   namespace OtherProject;
#    
#   require 'myproject/database/connection.php';
#    
#   use MyProject\Database\Connection as MyConnection;
#    
#   $connection = new MyConnection();
#    
#   use MyProject\Database as MyDatabase;
#    
#   $connection = new MyDatabase\Connection();


// Ипорт Exeption

#     namespace MyProject;
#      
#     // Fatal error: Class 'SomeProject\Exception' not found
#     throw new Exception('An exception!');
#      
#     // OK!
#     throw new \Exception('An exception!');
#      
#     // Импорт глобального Exception.
#     use Exception;
#      
#     // OK!
#     throw new Exception('An exception!');


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Иммитации пакетов с поомщью файловой системы

// Можно также употребить инструкцию include once (). Единственное различие инструкций require_once () и 
// include once () заключается в обработке ошибок. Файл, к которому происходит обращение с помощью инструкции r e q u i r e once (), 
// приведет к остановке всего процесса выполнения программы, если в нем возникнет ошибка.
// Аналогичная ошибка, обнаруженная в результате применения инструкции i n c l u d e once (), приведет лишь к выдаче предупреждения и прекращению 
// выполнения включаемого файла, после чего выполнение вызвавшего его кода будет продолжено. 
// Поэтому инструкции require () и require once () лучше выбирать для включения библиотечных файлов, а инструк- ции include () и include once () лучше подходят для выполнения та- ких действий, как шаблонная обработка.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Пути включения файлов

// requier_once __DIR__ '/../папка/файл'


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Исследование классов 

// Reflection API

interface bob
{
   public function testFunPub() : string; 
}

class reflections implements bob {
   
   public string $testString = '';
   protected int $testInt = 0;
   private static float $testFloat = 0.1;

   public function testFunPub() : string {
      return $this->testFloat;
   }

   protected function testFunProt() {
      return $this->testInt;
   }

   private function testFunPriv() {
      return $this->testString;
   }

   public function reflexions() {
      $reflectionClass = new \ReflectionClass($this);
      $base = array(
         'Interfaces' => $reflectionClass->getInterfaces(),
         'Methods' => $reflectionClass->getMethods(),
         'FileName' => $reflectionClass->getFileName(),
         'StaticMethod' => $reflectionClass->getStaticProperties(),
      );
      return $base;
   }

}

$ref = new reflections();
print_r($ref->reflexions());