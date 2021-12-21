<?php
declare(strict_types=1);

//use App\Domain\Category\CategoryRepository;
//use App\Domain\MetaData\MetaDataRepository;
//use App\Domain\Product\ProductRepository;
//use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Category\InMemoryCategoryRepository;
use App\Infrastructure\Persistence\MetaData\InMemoryMetaDataRepository;
use App\Infrastructure\Persistence\Product\InMemoryProductRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        CategoryRepository::class => \DI\autowire(InMemoryCategoryRepository::class),
        ProductRepository::class => \DI\autowire(InMemoryProductRepository::class),
        MetaDataRepository::class => \DI\autowire(InMemoryMetaDataRepository::class),
    ]);
};
