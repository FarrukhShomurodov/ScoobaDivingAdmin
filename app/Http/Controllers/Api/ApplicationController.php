<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Services\ApplicationService;
use http\Env\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApplicationController extends Controller
{
    private ApplicationService $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $app = $this->applicationService->index();
        return ApplicationResource::collection($app);
    }

    /**
     * @param ApplicationRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ApplicationRequest $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $this->applicationService->store($request->validated());
        return redirect(url('http://127.0.0.1:5500/'));
    }

    /**
     * @param Application $application
     * @return ApplicationResource
     */
    public function change_state(Application $application): ApplicationResource
    {
        $app = $this->applicationService->change_state($application);
        return ApplicationResource::make($app);
    }
}
