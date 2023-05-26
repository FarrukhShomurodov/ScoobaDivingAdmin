<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\ApplicationService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ApplicationController extends Controller
{
    private ApplicationService $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $app = \App\Models\Application::query()->get();
        return view('admin.app.applications', ['applications' => $app]);
    }

    /**
     * @param \App\Models\Application $application
     * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function change_state(\App\Models\Application $application): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $app = $this->applicationService->change_state($application);
        return redirect()->route('admin.show_done_app', ['applications' => $app]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show_done_app(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $done_app = $this->applicationService->show_done_app();
        return view('admin.app.done_applications', ['applications' => $done_app]);
    }

}
