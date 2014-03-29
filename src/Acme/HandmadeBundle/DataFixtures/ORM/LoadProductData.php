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
        $category = $manager
            ->getRepository('AcmeHandmadeBundle:Category')
            ->findOneBy(array('id'=>1))
        ;




        // product
        copy(__DIR__.'/ImagesVault/products/bon03.jpg', __DIR__.'/Images/bon03.jpg');
        $image1 = new Image();
        $image1->setName('Кексик');
        $image1->setImageFile(new File(__DIR__.'/Images/bon03.jpg'));
        $image1->evaluateUpload();
        $manager->persist($image1);

        $product = new Product();
        $product->setName('Кексик');
        $product->setCategory($category);
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
        $product->setCategory($category);
        $product->setDescription('Бонбоньер в виде сундучка с бантом представлен в 3х вариациях, подходит для крупных конфет. 8х4х6см');
        $product->setImage($image1);
        $product->setPrice(8.5);
        $product->setSku('BI0002');
        $product->setQuantity(10);
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
        $product->setCategory($category);
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
        $product->setCategory($category);
        $product->setDescription(' Простой небольшой, но очень милый бонбоньер. Отличная мини коробочка для того ,что бы порадовать ваших дорогих гостей. 6х6х5см');
        $product->setImage($image1);
        $product->setPrice(82.5);
        $product->setSku('BI0004');
        $product->setQuantity(17);
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
        $product->setCategory($category);
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
        $product->setCategory($category);
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
        $product->setCategory($category);
        $product->setDescription('Символичный аксессуар для вашей свадьбы, а также приятный и неожиданный подаркок для гостей. 12x11x3.5см');
        $product->setImage($image1);
        $product->setPrice(52);
        $product->setSku('BI0007');
        $product->setQuantity(17);
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
        $product->setCategory($category);
        $product->setDescription('Ваши гости будут приятно удивлены Вашей заботой и уважением проявленными к ним. 6х6х7см');
        $product->setImage($image1);
        $product->setPrice(27);
        $product->setSku('BI0008');
        $product->setQuantity(127);
        $manager->persist($product);

        $manager->flush();
    }
}
