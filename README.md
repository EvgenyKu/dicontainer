```php
use App\Classes\Lower;
use App\Classes\LowerTwo;
use App\Classes\Upper;
use App\Container\Container;

require dirname(__FILE__).'/vendor/autoload.php';

$container = new Container();//Создаём контейнер

try {

//Добавляем сервис, который будет реализовывать instance через ф-цию
    $container->add('lower', function () {
        return new Lower();
    });
    $lower = $container->get('lower');

    /** @var Lower $lower */
    $lower->printText(); //Привет я объект класса Lower
    echo "<br>";
//////////////////////////////////////////////////////////////////////


//Добавялем сервис, уже реализованный instance
    $container->add('lower-two', new LowerTwo());
    $lowerTwo = $container->get('lower-two');
    /** @var LowerTwo $lowerTwo */
    $lowerTwo->printText(); //Привет я объект класса Lower Two
    echo "<br>";
/////////////////////////////////////////////////////////////////////


//добавляем сервис, как имя класса (который содрежит зависимости)
    $upper = $container->add(Upper::class);
    $upper = $container->get(Upper::class);
    /** @var Upper $upper */
    $upper->printLowerText(); //Привет я объект класса Lower
////////////////////////////////////////////////////////////////////
}catch (\App\Container\Exceptions\ContainerException $exception){
    echo $exception->getMessage(); 
}
```
