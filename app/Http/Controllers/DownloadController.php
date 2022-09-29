<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Material  $material
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Material $material)
    {
        dispatch(function () use ($material) {
            Model::withoutTimestamps(fn () => $material->increment('download'));
        });

        return redirect(
            Storage::temporaryUrl(
                $material->file,
                now()->addHour(),
                [
                    'ResponseContentType' => 'application/octet-stream',
                    'ResponseContentDisposition' => 'attachment; filename='.basename($material->file),
                ]
            )
        );
    }
}
