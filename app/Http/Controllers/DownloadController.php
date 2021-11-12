<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Material $material)
    {
        $material->increment('download');

        return Storage::download($material->file, null, [
            'X-Vapor-Base64-Encode' => 'True',
        ]);
    }
}
