<?php

namespace Modules\CongregateTheme\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Modules\CongregateTheme\Console\InstallTheme;
use Modules\CongregateTheme\Console\ListThemes;
use Modules\CongregateTheme\Console\NewTheme;
use Modules\CongregateTheme\Console\UninstallTheme;
use Modules\CongregateContract\Theme\FlashMessageInterface;
use Modules\CongregateTheme\Services\FlashMessage;

use function Modules\CongregateSetting\settings;

class CongregateThemeServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'CongregateTheme';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'congregatetheme';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerCommands();

        View::share('flash_message', app(FlashMessageInterface::class));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        require_once dirname(__DIR__) .'/theme_helpers.php';
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(FlashMessageInterface::class, FlashMessage::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');

        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $this->setupFrontendTheme();
        $this->setupBackendTheme();

    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    private function registerCommands()
    {
        $this->commands([
            InstallTheme::class,
            ListThemes::class,
            NewTheme::class,
            UninstallTheme::class
        ]);
    }

    private function setupFrontendTheme()
    {
        // theme setup
        $themeBasePath = module_path($this->moduleName, 'Resources/views/themes/base');
        $currentTheme = Config::get('congregatetheme.active_theme_directory') .'/'. (settings('app.theme', Config::get('congregatetheme.theme')));

        // the base theme
        $this->loadViewsFrom([
            $themeBasePath
        ],'base_theme');

        // the current active theme
        $this->loadViewsFrom([
            $currentTheme,
            $themeBasePath
        ],'theme');

        // the current active theme's layouts
        $this->loadViewsFrom([
            $currentTheme .'/layouts',
            $themeBasePath .'/layouts'
        ],'theme_layout');

        // the current active theme's templates
        $this->loadViewsFrom([
            $currentTheme .'/templates',
            $themeBasePath .'/templates',
            resource_path('views')
        ],'theme_template');

        // the current active theme's sections
        $this->loadViewsFrom([
            $currentTheme .'/sections',
            $themeBasePath .'/sections'
        ],'theme_section');

        // the current active theme's fragments
        $this->loadViewsFrom([
            $currentTheme .'/fragments',
            $themeBasePath .'/fragments'
        ],'theme_fragments');
    }

    private function setupBackendTheme()
    {
        // theme setup
        $themeBasePath = module_path($this->moduleName, 'Resources/views/themes/base');
        $currentTheme = Config::get('congregatetheme.active_backend_theme_directory') .'/'. (settings('app.backend_theme', Config::get('congregatetheme.backend_theme')));

        // the base theme
        $this->loadViewsFrom([
            $themeBasePath
        ],'backend_base_theme');

        // the current active theme
        $this->loadViewsFrom([
            $currentTheme,
            $themeBasePath
        ],'backend_theme');

        // the current active theme's layouts
        $this->loadViewsFrom([
            $currentTheme .'/layouts',
            $themeBasePath .'/layouts'
        ],'backend_theme_layout');

        // the current active theme's templates
        $this->loadViewsFrom([
            $currentTheme .'/templates',
            $themeBasePath .'/templates',
            resource_path('views')
        ],'backend_theme_template');

        // the current active theme's sections
        $this->loadViewsFrom([
            $currentTheme .'/sections',
            $themeBasePath .'/sections'
        ],'backend_theme_section');

        // the current active theme's fragments
        $this->loadViewsFrom([
            $currentTheme .'/fragments',
            $themeBasePath .'/fragments'
        ],'backend_theme_fragments');
    }
}
