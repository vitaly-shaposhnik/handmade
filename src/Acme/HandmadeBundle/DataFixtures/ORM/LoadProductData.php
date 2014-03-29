<?php

namespace Acme\HandmadeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use Acme\HandmadeBundle\Entity\Product;
use Acme\HandmadeBundle\Entity\Image;

class LoadProductData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $category = $manager->getRepository('AcmeHandmadeBundle:Category')->findAll();

        // product
        copy(__DIR__.'/ImagesVault/products/bon03.jpg', __DIR__.'/Images/bon03.jpg');
        $image1 = new Image();
        $image1->setName('Кексик');
        $image1->setImageFile(new File(__DIR__.'/Images/bon03.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Кексик');
        $product->setCategory($category[0]);
        $product->setDescription("Станет изящным комплиментом для Ваших гостей. Бонбоньерка имеет красивую шестиугольную форму и прикреплённую карточку благодарности.");
        $product->setImage($image1);
        $product->setPrice(8.5);
        $product->setSku('BI0001');
        $product->setQuantity(20);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon14.3.jpg', __DIR__.'/Images/bon14.3.jpg');
        $image1 = new Image();
        $image1->setName('Сундучок');
        $image1->setImageFile(new File(__DIR__.'/Images/bon14.3.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Сундучок');
        $product->setCategory($category[0]);
        $product->setDescription('Бонбоньер в виде сундучка с бантом представлен в 3х вариациях, подходит для крупных конфет. 8х4х6см');
        $product->setImage($image1);
        $product->setPrice(8.5);
        $product->setSku('BI0002');
        $product->setQuantity(10);
        $product->setShowOnHomepage(true);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon06.jpg', __DIR__.'/Images/bon06.jpg');
        $image1 = new Image();
        $image1->setName('Треугольничек');
        $image1->setImageFile(new File(__DIR__.'/Images/bon06.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Треугольничек');
        $product->setCategory($category[0]);
        $product->setDescription('Большой оригинальный бонбоньер с красивым орнаментом со всех сторон, необычной застежкой сверху, и в дополнении с красивыми словами благодарности покорит сердца Ваших гостей. 9х9х3 см');
        $product->setImage($image1);
        $product->setPrice(8.5);
        $product->setSku('BI0003');
        $product->setQuantity(14);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon05.jpg', __DIR__.'/Images/bon05.jpg');
        $image1 = new Image();
        $image1->setName('Трюфеле');
        $image1->setImageFile(new File(__DIR__.'/Images/bon05.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Трюфеле');
        $product->setCategory($category[0]);
        $product->setDescription('Простой небольшой, но очень милый бонбоньер. Отличная мини коробочка для того ,что бы порадовать ваших дорогих гостей. 6х6х5см');
        $product->setImage($image1);
        $product->setPrice(82.5);
        $product->setSku('BI0004');
        $product->setQuantity(17);
        $product->setShowOnHomepage(true);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon16.jpg', __DIR__.'/Images/bon16.jpg');
        $image1 = new Image();
        $image1->setName('Лотос');
        $image1->setImageFile(new File(__DIR__.'/Images/bon16.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Лотос');
        $product->setCategory($category[0]);
        $product->setDescription('Одним прикосновением лепестки откроются и не позволят Вашим гостям оторваться от сладостей внутри. 3х3х7см');
        $product->setImage($image1);
        $product->setPrice(18.5);
        $product->setSku('BI0005');
        $product->setQuantity(137);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon07.jpg', __DIR__.'/Images/bon07.jpg');
        $image1 = new Image();
        $image1->setName('Влюбленные');
        $image1->setImageFile(new File(__DIR__.'/Images/bon07.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Влюбленные');
        $product->setCategory($category[0]);
        $product->setDescription('Является символом двух любящих сердец, которые тесно переплетаются между собой и таят в себе только приятные, сладкие сюрпризы. 5,5х5,5х8см');
        $product->setImage($image1);
        $product->setPrice(28.5);
        $product->setSku('BI0006');
        $product->setQuantity(27);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon024.jpg', __DIR__.'/Images/bon024.jpg');
        $image1 = new Image();
        $image1->setName('Heart');
        $image1->setImageFile(new File(__DIR__.'/Images/bon024.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Heart');
        $product->setCategory($category[0]);
        $product->setDescription('Символичный аксессуар для вашей свадьбы, а также приятный и неожиданный подаркок для гостей. 12x11x3.5см');
        $product->setImage($image1);
        $product->setPrice(52);
        $product->setSku('BI0007');
        $product->setQuantity(17);
        $product->setShowOnHomepage(true);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon09.jpg', __DIR__.'/Images/bon09.jpg');
        $image1 = new Image();
        $image1->setName('Сплочённость');
        $image1->setImageFile(new File(__DIR__.'/Images/bon09.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Сплочённость');
        $product->setCategory($category[0]);
        $product->setDescription('Ваши гости будут приятно удивлены Вашей заботой и уважением проявленными к ним. 6х6х7см');
        $product->setImage($image1);
        $product->setPrice(27);
        $product->setSku('BI0008');
        $product->setQuantity(127);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon08.jpg', __DIR__.'/Images/bon08.jpg');
        $image1 = new Image();
        $image1->setName('Butterfly');
        $image1->setImageFile(new File(__DIR__.'/Images/bon08.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Butterfly');
        $product->setCategory($category[0]);
        $product->setDescription('Коробочка образует сердце, на половинках которого написаны красивые инициалы невесты и жениха. 5,5х6х4см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0009');
        $product->setQuantity(7);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon17.jpg', __DIR__.'/Images/bon17.jpg');
        $image1 = new Image();
        $image1->setName('Сумочка');
        $image1->setImageFile(new File(__DIR__.'/Images/bon17.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Сумочка');
        $product->setCategory($category[0]);
        $product->setDescription('Благодаря своей забавной форме так и манит раскрыть и насладиться прекрасным вкусом сладостей внутри. 6х4х8см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0010');
        $product->setQuantity(7);
        $product->setShowOnHomepage(true);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon031.jpg', __DIR__.'/Images/bon031.jpg');
        $image1 = new Image();
        $image1->setName('Подушечка');
        $image1->setImageFile(new File(__DIR__.'/Images/bon031.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Подушечка');
        $product->setCategory($category[0]);
        $product->setDescription('Вы сможете выразить свою благодарность гостям, пришедшим на Вашу свадьбу. 6х6х2см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0011');
        $product->setQuantity(7);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon11.jpg', __DIR__.'/Images/bon11.jpg');
        $image1 = new Image();
        $image1->setName('Пирамида');
        $image1->setImageFile(new File(__DIR__.'/Images/bon11.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Пирамида');
        $product->setCategory($category[1]);
        $product->setDescription('Утончённый, строгий бонбоньер придаст вашему торжеству элегантности и официальности. 5х5х7см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0012');
        $product->setQuantity(7);
        $product->setShowOnHomepage(true);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon12.jpg', __DIR__.'/Images/bon12.jpg');
        $image1 = new Image();
        $image1->setName('Рафаэлло');
        $image1->setImageFile(new File(__DIR__.'/Images/bon12.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Рафаэлло');
        $product->setCategory($category[1]);
        $product->setDescription('Необычность его заключается в том, что лепестки не плотно закрываются, а чуть приоткрыты, придавая легкую небрежность и в то же время нежность и загадочность. 4х4х4см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0013');
        $product->setQuantity(7);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon01.jpg', __DIR__.'/Images/bon01.jpg');
        $image1 = new Image();
        $image1->setName('Кокетка');
        $image1->setImageFile(new File(__DIR__.'/Images/bon01.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Кокетка');
        $product->setCategory($category[1]);
        $product->setDescription('Маленький, но очень приятный сюрприз придётся по душе близким людям. 6х6х4см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0014');
        $product->setQuantity(7);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon02.jpg', __DIR__.'/Images/bon02.jpg');
        $image1 = new Image();
        $image1->setName('Коробочка');
        $image1->setImageFile(new File(__DIR__.'/Images/bon02.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Коробочка');
        $product->setCategory($category[2]);
        $product->setDescription('Бонбоньерка выполнена в классическом стиле, украшена маленьким бантиком с ленточками и включает в себя карточку благодарности. 6х6х5см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0015');
        $product->setQuantity(7);
        $product->setShowOnHomepage(true);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon04.jpg', __DIR__.'/Images/bon04.jpg');
        $image1 = new Image();
        $image1->setName('Сandy');
        $image1->setImageFile(new File(__DIR__.'/Images/bon04.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Сandy');
        $product->setCategory($category[2]);
        $product->setDescription('"Конфетка" придаст приятные эмоции и улыбки на лицах ваших гостей. 13х3х3см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0016');
        $product->setQuantity(7);
        $manager->persist($product);


        // product
        copy(__DIR__.'/ImagesVault/products/bon18.jpg', __DIR__.'/Images/bon18.jpg');
        $image1 = new Image();
        $image1->setName('Кейсик');
        $image1->setImageFile(new File(__DIR__.'/Images/bon18.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Кейсик');
        $product->setCategory($category[3]);
        $product->setDescription('Строгий и очень изысканный чемоданчик. 8х4х8см');
        $product->setImage($image1);
        $product->setPrice(25);
        $product->setSku('BI0017');
        $product->setQuantity(7);
        $manager->persist($product);

        $manager->flush();
    }
}
