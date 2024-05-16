<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function createOrUpdate(Request $request)
    {
        //
    }



    public function uploadFiles(Request $request): JsonResponse
    {
        if (!$request->hasFile('file')) {
            return response()->json([
                'status' => 400,
                'message' => 'Upload file not found'
            ], 400);
        }

        if (!$request->has('type')) {
            return response()->json([
                'status' => 400,
                'message' => 'Type of image is field require'
            ], 400);
        }

        $type = $request['type'];
        $allowedFileExtension = ['jpg', 'jpeg', 'png', 'bmp', 'svg', 'webp'];
        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $checkExtension = in_array($extension, $allowedFileExtension);

        if (!$checkExtension) {
            return response()->json(['invalid_file_format'], 422);
        }

        $informationImage = getimagesize($file);
        $path = $file->store('public/images/avatar');

        return response()->json([
            'path_file' => $path,
            'type' => $type,
            'length' => filesize($file), //byte
            'extension' => $extension
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
