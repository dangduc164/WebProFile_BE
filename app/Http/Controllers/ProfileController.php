<?php

namespace App\Http\Controllers;

use App\Models\ProfilesAvatar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function uploadAvatar(Request $request): JsonResponse
    {

        // dd($request->toArray());
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
        $profileAvatar = new ProfilesAvatar();
        $profileAvatar->avatar_url = $path;
        $profileAvatar->save();


        return response()->json([
            'path_file' => $path,
            'type' => $type,
            'length' => filesize($file), //byte
            'extension' => $extension
        ]);
    }



    /**
     * @param AreaOptionUpdateRequest $request
     * @param  int  $id
     * @return JsonResponse
     * @throws RecordNotFoundException
     */
    // public function update(AreaOptionUpdateRequest $request, $id): JsonResponse
    // {
    //     $area = TsAreaOption::find($id);

    //     if(!$area){
    //         $response = [
    //             'data' => null,
    //             'message' => 'Not found item area option'
    //         ];
    //         return response()->json($response, 404);
    //     }

    //     //delete old icon
    //     $old_icon_path =  $area->icon_path;
    //     if (file_exists($old_icon_path)) {
    //         unlink($old_icon_path);
    //     }

    //     $area->update($request->all());
    //     $content = TsAreaOptionContent::where("ts_area_option_id", $id)->delete();
    //     foreach($request->all()['contents'] as $item) {
    //         TsAreaOptionContent::updateOrCreate(
    //             [
    //                'id'   => $item['id'],
    //             ],
    //             [
    //                'ts_area_option_id' =>  $item['ts_area_option_id'],
    //                'title' =>  $item['title'],
    //                'description' =>  $item['description'],
    //             ],
    //         );
    //     }

    //     $response = [
    //         'data' => $area
    //     ];
    //     return response()->json($response, 200);

    // }
}
