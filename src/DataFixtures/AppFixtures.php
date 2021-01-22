<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var Product[] $products */
        $products = [];
        foreach ($this->productProvider() as $product) {
            $products[] = $product;

            $manager->persist($product);
        }

        $customer = new Customer();
        $customer->setEmail('john@example.com');
        $customer->setPhoneNumber('+1 123 456 78 90');

        $manager->persist($customer);

        $order = new Order();
        $order->setCreatedAt(new \DateTime());
        $order->setCustomer($customer);
//        $order->setComment('Order contains 2 items.');

        foreach ($products as $product) {
            if ($product->getCode() === 'AMBAR13' || $product->getCode() === 'AMBPR16') {
                $order->addProduct($product);
            }
        }

        $manager->persist($order);

        $manager->flush();
    }

    private function productProvider()
    {
        yield (new Product())
            ->setCode('AMBAR13')
            ->setTitle('Apple MacBook Air 13 inch')
            ->setPrice(999.00)
            ->setDescription(
                'Our thinnest, lightest notebook, completely transformed by the Apple M1 chip. CPU speeds up to 
                3.5x faster. GPU speeds up to 5x faster. Our most advanced Neural Engine for up to 9x faster machine learning. 
                The longest battery life ever in a MacBook Air. And a silent, fanless design. This much power has never been this ready to go.'
            );
        yield (new Product())
            ->setCode('AMBPR13')
            ->setTitle('Apple MacBook Pro 13 inch')
            ->setPrice(1299.00)
            ->setDescription(
                'The Apple M1 chip gives the 13‑inch MacBook Pro speed and power beyond belief. 
        With up to 2.8x CPU performance. Up to 5x the graphics speed. Our most advanced Neural Engine for up to 11x faster 
        machine learning. And up to 20 hours of battery life — the longest of any Mac ever. It’s our most popular pro 
        notebook, taken to a whole new level.'
            );
        yield (new Product())
            ->setCode('AMBPR16')
            ->setTitle('Apple MacBook Pro 16 inch')
            ->setPrice(2399.00)
            ->setDescription(
                'Designed for those who defy limits and change the world, the 16-inch MacBook Pro is by far the 
                most powerful notebook we have ever made. With an immersive Retina display, superfast processors, advanced 
                graphics, the largest battery capacity ever in a MacBook Pro, Magic Keyboard, and massive storage, it\'s 
                the ultimate pro notebook for the ultimate user.'
            );
    }
}
