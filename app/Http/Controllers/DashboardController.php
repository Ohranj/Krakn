<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $builderActionsJson = file_get_contents('../json/stepBuilderActionsList.json');
        return Inertia::render('Dashboard', [
            'stepBuilderActions' => json_decode($builderActionsJson)
        ]);
    }
}
