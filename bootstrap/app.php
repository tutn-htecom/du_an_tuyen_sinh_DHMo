<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

use App\Models\Marjors;
use App\Services\Authentication\AuthInterface;
use App\Services\Authentication\AuthServices;
use App\Services\BlockAdminssions\BlockAdminssionsInterface;
use App\Services\BlockAdminssions\BlockAdminssionsServices;
use App\Services\EducationsTypes\EducationsTypesInterface;
use App\Services\EducationsTypes\EducationsTypesServices;
use App\Services\Employees\EmployeesInterface;
use App\Services\Employees\EmployeesServices;
use App\Services\FormAdminssions\FormAdminssionsInterface;
use App\Services\FormAdminssions\FormAdminssionsServices;
use App\Services\Leads\LeadsInterface;
use App\Services\Leads\LeadsServices;
use App\Services\Marjors\MarjorsInterface;
use App\Services\Marjors\MarjorsServices;
use App\Services\MethodAdminssions\MethodAdminssionsInterface;
use App\Services\MethodAdminssions\MethodAdminssionsServices;
use App\Services\ScoreAdminssions\ScoreAdminssionsInterface;
use App\Services\ScoreAdminssions\ScoreAdminssionsServices;
use App\Services\Sources\SourcesInterface;
use App\Services\Sources\SourcesServices;
use App\Services\Status\StatusInterface;
use App\Services\Status\StatusServices;
use App\Services\Supports\SupportsInterface;
use App\Services\Supports\SupportsServices;
use App\Services\SupportsStatus\SupportsStatusInterface;
use App\Services\SupportsStatus\SupportsStatusServices;
use App\Services\Tags\TagsInterface;
use App\Services\Tags\TagsServices;

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);
$app->singleton(AuthInterface::class, AuthServices::class);
$app->singleton(SourcesInterface::class, SourcesServices::class);
$app->singleton(MarjorsInterface::class, MarjorsServices::class);
$app->singleton(TagsInterface::class, TagsServices::class);
$app->singleton(StatusInterface::class, StatusServices::class);
$app->singleton(LeadsInterface::class, LeadsServices::class);
$app->singleton(EducationsTypesInterface::class, EducationsTypesServices::class);
$app->singleton(MethodAdminssionsInterface::class, MethodAdminssionsServices::class);
$app->singleton(FormAdminssionsInterface::class, FormAdminssionsServices::class);
$app->singleton(BlockAdminssionsInterface::class, BlockAdminssionsServices::class);
$app->singleton(ScoreAdminssionsInterface::class, ScoreAdminssionsServices::class);
$app->singleton(SupportsInterface::class, SupportsServices::class);
$app->singleton(SupportsStatusInterface::class, SupportsStatusServices::class);
$app->singleton(EmployeesInterface::class, EmployeesServices::class);



/*$app->singleton(FormAdminssionsInterface::class, FormAdminssionsServices::class);
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
