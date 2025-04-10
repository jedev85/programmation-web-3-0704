<?php

namespace App\DataFixtures;

use App\Entity\Enclos;
use App\Entity\Enum\Speciality;
use App\Entity\Pingouin;
use App\Entity\Soigneur;
use App\Entity\User;
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
        $email = 'jeremie.devin@ynov.com';
        $password_plain = 'popopo';
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if (!$user) {
            $user = new User();
            $user->setEmail($email);
            $user->setRoles(['ROLE_ADMIN']);
            $password = $this->hasher->hashPassword($user, $password_plain);
            $user->setPassword($password);
            $manager->persist($user);
            $manager->flush();
        }

        $soigneurs = [];
        $enclos = [];

        for ($i = 0; $i < 10; $i++) {
            $soigneur = new Soigneur();
            $soigneur->setNom('Paul '.$i);
            $soigneur->setSpeciality(Speciality::GestionMédicaments);
            $manager->persist($soigneur);
            $soigneurs[] = $soigneur;
        }


        for ($i = 0; $i < 10; $i++) {
            $enclo = new Enclos();
            $enclo->setNom('Enclos '.$i);
            $enclo->setTemperature(rand(1, 30));
            $manager->persist($enclo);
            $enclos[] = $enclo;
        }

        for ($i = 0; $i < 20; $i++) {
            $pingouin = new Pingouin();
            $pingouin->setAge(rand(1,30));
            $pingouin->setCouleur('Blanc');
            $pingouin->setPrenom('Pingouin '.$i);
            $pingouin->setEnclos($enclos[rand(1,count($enclos)-1)]);
            $pingouin->setSoigneur($soigneurs[rand(1,count($soigneurs)-1)]);
            $manager->persist($pingouin);
        }

        $manager->persist($soigneur);
        $manager->flush();
    }
}
