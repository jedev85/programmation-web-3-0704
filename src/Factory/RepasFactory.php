<?php

namespace App\Factory;

use App\Entity\Enum\Type;
use App\Entity\Repas;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Repas>
 */
final class RepasFactory extends PersistentProxyObjectFactory
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
        return Repas::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'date' => self::faker()->dateTime(),
            'is_eat' => self::faker()->boolean(),
            'pingouin' => PingouinFactory::random(),
            'quantite' => self::faker()->randomNumber(),
            'type' => self::faker()->randomElement(Type::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Repas $repas): void {})
        ;
    }
}
