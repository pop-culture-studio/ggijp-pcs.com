<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Material $material): RedirectResponse
    {
        dispatch(function () use ($material) {
            Material::withoutTimestamps(fn () => $material->increment('download'));
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
