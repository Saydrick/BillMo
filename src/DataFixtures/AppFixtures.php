<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use DateTimeZone;
use DateTimeImmutable;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Generates admin customer & user
        $billmo_customer = new Customer();
        $billmo_customer->setName('BillMo');

        $manager->persist($billmo_customer);

        $admin = new User();
        $admin->setEmail('admin@billmoapi.com');
        $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'password'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setCustomer($billmo_customer);

        $manager->persist($admin);

        // Generates fictitious customers
        for ($i = 0; $i < 3; $i++) {
            $customer = new Customer();
            $number_customer = $i + 1;

            $customer->setName('Client ' . $number_customer);

            $manager->persist($customer);

            // Generates fictitious users linked to the customer
            for ($j = 0; $j < 5; $j++) {
                $user = new User();
                $number_user = $j + 1;

                $user->setEmail('user' . $number_user . '.customer' . $number_customer . '@billmoapi.com');
                $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
                $user->setRoles(['ROLE_USER']);
                $user->setCustomer($customer);

                $manager->persist($user);
            }
        }

        // Generates fictitious products
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $number = $i + 1;
            $timezone = new DateTimeZone('Europe/Paris');


            $product->setName('BiPhone ' . $number);
            $product->setDescription('Ceci est le téléphone mobile n°' . $number . ' de l\'entreprise BillMo.');
            $product->setPrice(mt_rand(8000, 100000) / 100);
            $product->setCreatedAt(new DateTimeImmutable('now', $timezone));
            $product->setUpdatedAt(new DateTimeImmutable('now', $timezone));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
