<?php

namespace App\DataFixtures;

use App\Entity\Enclos;
use App\Entity\Enum\Speciality;
use App\Entity\Pingouin;
use App\Entity\Soigneur;
use App\Entity\User;
use App\Factory\EnclosFactory;
use App\Factory\PingouinFactory;
use App\Factory\RepasFactory;
use App\Factory\SoigneurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $hasher,
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $_ENV['EMAIL']]);
        if (!$user) {
            $user = new User();
            $user->setEmail($_ENV['EMAIL']);
            $user->setRoles(['ROLE_ADMIN']);
            $password = $this->hasher->hashPassword($user, $_ENV['PASSWORD']);
            $user->setPassword($password);
            $manager->persist($user);
            $manager->flush();
        }

        SoigneurFactory::createMany(20);

        EnclosFactory::createMany(20);

        PingouinFactory::createMany(50);

        RepasFactory::createMany(100);

        $manager->flush();
    }
}
