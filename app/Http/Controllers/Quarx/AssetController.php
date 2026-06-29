<?php

namespace App\Http\Controllers\Quarx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    public function asPreview($encFileName)
    {
        return response('Not implemented', 501);
    }

    public function asPublic($encFileName)
    {
        return response('Not implemented', 501);
    }

    public function asDownload($encFileName, $encRealFileName)
    {
        return response('Not implemented', 501);
    }

    public function asset($path, $contentType)
    {
        return response('Not implemented', 501);
    }
}
