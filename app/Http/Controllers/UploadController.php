<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class UploadController extends Controller
{
    public function uploadImg(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png|max:4096',
        ]);

        $user = User::find($request->userId);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extention = $file->getClientOriginalExtension();
            $nameimg = 'HS-' . time() . '.' . $extention;
            $file->move(public_path() . '/media/upload/', $nameimg);
            if ($user->img) {
                unlink(public_path("media/upload/$user->img"));
            }
            return response()->json([
                'status' => true,
                'img' => asset("/media/upload/$user->img")
            ]);
        }

        return response(['status' => false], 403);
    }
}
