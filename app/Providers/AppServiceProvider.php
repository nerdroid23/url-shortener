<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->listenToMigrationsEndedEvent();

        $this->registerLengthAwarePaginator();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function listenToMigrationsEndedEvent()
    {
        if (App::isLocal()) {
            Event::listen(MigrationsEnded::class, function ($event) {
                Artisan::call('ide-helper:models', [
                    '--write' => true,
                    '--reset' => true,
                    '--no-interaction' => true,
                ]);
            });
        }
    }

    protected function registerLengthAwarePaginator()
    {
        if (Request::wantsJson()) {
            $this->app->bind(LengthAwarePaginator::class, function ($app, $values) {
                return new class(...array_values($values)) extends LengthAwarePaginator {
                    public function only(...$attributes)
                    {
                        return $this->transform(function ($item) use ($attributes) {
                            return $item->only($attributes);
                        });
                    }

                    public function transform($callback)
                    {
                        $this->items->transform($callback);

                        return $this;
                    }

                    public function toArray()
                    {
                        return [
                            'data' => $this->items->toArray(),
                            'links' => $this->links(),
                        ];
                    }

                    public function previousPageUrl()
                    {
                        if ($this->currentPage() > 1) {
                            return '?page=' . ($this->currentPage() - 1);
                        }
                    }

                    public function nextPageUrl()
                    {
                        if ($this->hasMorePages()) {
                            return '?page=' . ($this->currentPage() + 1);
                        }
                    }

                    public function links($view = null, $data = [])
                    {
                        $this->appends(Request::all());

                        $window = UrlWindow::make($this);

                        $elements = array_filter([
                            $window['first'],
                            is_array($window['slider']) ? '...' : null,
                            $window['slider'],
                            is_array($window['last']) ? '...' : null,
                            $window['last'],
                        ]);

                        return Collection::make($elements)->flatMap(function ($item) {
                            if (is_array($item)) {
                                return Collection::make($item)->map(function ($url, $page) {
                                    return [
                                        'url' => "?page=${page}",
                                        'label' => $page,
                                        'active' => $this->currentPage() === $page,
                                    ];
                                });
                            } else {
                                return [
                                    [
                                        'url' => null,
                                        'label' => '...',
                                        'active' => false,
                                    ],
                                ];
                            }
                        })->prepend([
                            'url' => $this->previousPageUrl(),
                            'label' => 'Previous',
                            'active' => false,
                        ])->push([
                            'url' => $this->nextPageUrl(),
                            'label' => 'Next',
                            'active' => false,
                        ]);
                    }
                };
            });
        }
    }
}
