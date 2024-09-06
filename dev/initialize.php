<?php 
include 'models/product_model.php';

class Initialize {
    public static function GetArray() : array {
        $products = [];
        
        $description = 'Электрический духовой шкаф DEXP 1M70GNS с классической серебристой расцветкой лицевой панели будет уместно смотреться в интерьере любой кухни, а его дизайн является актуальным на все времена. Стильный внешний вид сочетается с широкими функциональными возможностями и солидным объемом 70 л. Модель с независимой установкой позволит готовить разнообразные блюда благодаря регулируемому термостату в диапазоне 50-250 градусов и четырем режимам работы, представляющим собой комбинацию друг с другом нижнего и верхнего нагрева.
        Электрический духовой шкаф DEXP 1M70GNS поддерживает традиционную очистку от загрязнений при помощи соответствующих средств бытовой химии. Панель управления из нержавеющей стали не вызовет сложностей в уходе. Два поворотных регулятора позволят легко настроить параметры работы прибора: выбрать режим и температуру нагрева. В камере имеется пять уровней установки противней, позволяющих добиться нужного результата запекания. В откидной дверце предусмотрено два стекла с возможностью извлечения внутреннего для более удобной очистки.';

        $products[] = new Product(0, "Программирование на языке PHP Васильев А.Н.", "../img/book1.jpg", 1300, $description);
        $products[] = new Product(1, "Computer Science Роберт Седжвик", "../img/book2.webp", 2500, $description);
        $products[] = new Product(2, "Изучаем C++ Майкл Доусон", "../img/book3.webp", 800, $description);
        $products[] = new Product(3, "Программирование на языке Python", "../img/book4.webp", 10, $description);
        $products[] = new Product(4, "Сам себе программист Кори Альтхофф", "../img/book5.jpeg", 1000, $description);
        $products[] = new Product(5, "Программирование для начинающих на C#", "../img/book6.jpg", 1500, $description);
        $products[] = new Product(6, "PHP объекты, шаблоны и методики программирования", "../img/book7.jpg", 3000, $description);
        $products[] = new Product(7, "CLR Via C# Джеффри Рихтер", "../img/book8.jpg", 8200, $description);
        $products[] = new Product(8, "Программирование на C++ Арнольд Виллемер", "../img/book9.webp", 420, $description);
        $products[] = new Product(9, "Самоучитель по C# Ишкова Э.А.", "../img/book10.jpg", 640, $description);
        $products[] = new Product(10, "Веб программирование для чайников Никхил Абрахам", "../img/book11.jpg", 200, $description);
        $products[] = new Product(11, "Программирование на C", "../img/book12.webp", 2000, $description);
        $products[] = new Product(12, "Объектно ориентированное программирование на JAVA", "../img/book13.jpg", 900, $description);
        return $products;
    }
}