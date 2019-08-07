<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GalleryImage;

class GalleryImageController extends Controller
{
    // Listing of images gallery
    public function index()
    {
        $images = DB::table('gallery_images')->orderBy('updated_at', 'desc')->simplePaginate(12);

        return view('image-gallery',compact('images'));
    }
}
