<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\SqlSandboxService;

class SqlSandboxController extends Controller
{
    public function execute(Request $request)
    {
        $request->validate([
            'sql' => ['required', 'string'],
        ]);

        $result = app(SqlSandboxService::class)
            ->execute($request->input('sql'));

        return view('sandbox.result', compact('result'));
    }

    public function form()
    {
        return view('sandbox.form');
    }
}
