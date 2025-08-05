<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function slink(Request $request)
    {
        $validated = $request->validate([
            'panel' => 'sometimes|boolean',
        ]);

        if(isset($validated['panel'])) {
            symlink('/home/any/core.osuss.net/storage/app/public', '/home/any/core.osuss.net/public/storage');
        }
        else{
            Artisan::call('storage:link');
        }

        return response()->json(['message' => 'linked ^_*']);
    }

    public function optimize()
    {
        Artisan::call('optimize:clear');
        //Artisan::call('filament:optimize-clear');
        //Artisan::call('filament:optimize');
        //Artisan::call('app:generate-sitemap');
        Artisan::call('optimize');
        return response()->json(['message' => 'optimized ^_*']);
    }
}
