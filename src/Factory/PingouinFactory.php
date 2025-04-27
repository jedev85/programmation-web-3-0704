<?php

namespace App\Factory;

use App\Entity\Enum\Color;
use App\Entity\Pingouin;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Pingouin>
 */
final class PingouinFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Pingouin::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'age' => self::faker()->randomNumber(),
            'color' => self::faker()->randomElement(Color::cases()),
            'enclos' => EnclosFactory::randomOrCreate(),
            'soigneur' => SoigneurFactory::randomOrCreate(),
            'prenom' => self::faker()->firstName(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Pingouin $pingouin): void {})
        ;
    }
}
