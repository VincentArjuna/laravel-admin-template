<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'menus' => function () {
                if ($user = request()->user()) {
                    $menus = Menu::whereNull('parent_id')->orderBy('position')->with(['childs'])->get();

                    return $menus->filter(function ($menu) use ($user) {
                        $permissions = $menu->permissions->pluck('name')->toArray();

                        return $permissions ? $user->can($permissions) : true;
                    });
                }

                return [];
            },
        ]);
    }
}
