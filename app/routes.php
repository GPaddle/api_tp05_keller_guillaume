<?php

declare(strict_types=1);

use App\Application\Actions\Category\ViewCategoryAction;
use App\Application\Actions\Login\LoginAction;
use App\Application\Actions\MetaData\ListMetaDataAction;
use App\Application\Actions\MetaData\ViewMetaDataAction;
use App\Application\Actions\Product\ListCategoriesAction;
use App\Application\Actions\Product\ListProductsAction;
use App\Application\Actions\Product\ViewProductAction;
use App\Application\Actions\Register\RegisterAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {


    $app->group('/api', function (Group $group) {

        $group->options('/{routes:.*}', function (Request $request, Response $response) {
            // CORS Pre-Flight OPTIONS Request Handler
            return $response;
        });

        $group->get('/home', function (Request $request, Response $response) {
            $response->getBody()->write('Hello world!');
            return $response;
        })->setName('home');

        $group->post('/login', LoginAction::class)->setName('getLogin');
        $group->post('/register', RegisterAction::class)->setName('getRegistration');

        $group->group('/user', function (Group $groupUsers) {
            $groupUsers->get('', ListUsersAction::class)->setName('getUsers');
            $groupUsers->get('/{id:[0-9]+}', ViewUserAction::class)->setName('getUserByID');
        });

        $group->group('/product', function (Group $groupProducts) {
            $groupProducts->get('', ListProductsAction::class)->setName('getProducts');
            $groupProducts->get('/{id:[0-9]+}', ViewProductAction::class)->setName('getProductByID');
        });

        $group->group('/category', function (Group $groupCategories) {
            $groupCategories->get('', ListCategoriesAction::class)->setName('getCategories');
            $groupCategories->get('/{id:[0-9]+}', ViewCategoryAction::class)->setName('getCategoryByID');
        });

        $group->group('/metaData', function (Group $groupMetaData) {
            $groupMetaData->get('', ListMetaDataAction::class)->setName('getMetaData');
            $groupMetaData->get('/{id:[0-9]+}', ViewMetaDataAction::class)->setName('getMetaDataByID');
        });
    });
};
