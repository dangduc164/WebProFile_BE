<?php

namespace App\Http\Controllers;

use App\Models\ProfilesAvatar;
use App\Models\ProfilesContent;
use App\Models\ProfilesSocial;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function uploadAvatar(Request $request): JsonResponse
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
        $path = $file->store('public/images/avatar');

        if (!$checkExtension) {
            return response()->json(['invalid_file_format'], 422);
        }

        // Get existing profile avatar (if any)
        $existingAvatar = ProfilesAvatar::where('user_id', $request->user_id)->first();
        $avatar_url_old = $existingAvatar->avatar_url;

        // Delete old file if it exists
        if (file_exists($avatar_url_old)) {
            unlink($avatar_url_old);
        }

        $informationImage = getimagesize($file);

        // Save profile avatar information
        $profileAvatar = ProfilesAvatar::updateOrCreate(
            ['user_id' => $request->user_id],
            ['avatar_url' => $path]
        );

        $response = [
            'status' => 200,
            'message' => 'Upload success',
            'information' => $informationImage,
            'user_id' => $request->user_id,
            'path_file' => $path,
            'type' => $type,
            'length' => filesize($file),
            'extension' => $extension,
        ];

        return response()->json($response);
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


    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function getInfo($id): JsonResponse
    {

        $user = User::find($id);

        if (!$user) {
            $response = [
                'data' => null,
                'message' => 'Not found user'
            ];
            return response()->json($response, 404);
        }
        $data = DB::table('users')
            ->leftJoin('profiles_content', 'profiles_content.user_id', $user->id)
            ->leftJoin('profiles_avatars', 'profiles_avatars.user_id', $user->id)
            ->leftJoin('profiles_social', 'profiles_social.user_id', $user->id)
            ->where('users.id', $user->id)
            ->get()
            ->toArray();
        $response = [
            'data' =>  $data
        ];
        return response()->json($response, 200);
    }


    public function createOrUpdate(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'content' => 'nullable|array',
        //     'content.*.title' => 'nullable|string',
        //     'content.*.description' => 'nullable|string',
        //     'content.*.icon' => 'nullable|string',
        //     'content.*.order_number' => 'required|integer',
        // ]);
        $newLinkSocial = [];
        foreach ($request['list_link_social'] as $item) {
            $newItem = ProfilesSocial::insert([
                'user_id' => $id,
                'label' => $item['label'] ?? null,
                'icon' => $item['icon'] ?? null,
                'link_url' => $item['link_url'] ?? null,
            ]);
            $newLinkSocial[] = $newItem;
        }

        ProfilesContent::where('user_id', $id)->delete();

        $newContent = [];
        foreach ($request['content'] as $item) {
            $newItem = ProfilesContent::insert([
                'user_id' => $id,
                'title' => $item['title'] ?? null,
                'description' => $item['description'] ?? null,
                'icon' => $item['icon'] ?? null,
                'order_number' => $item['order_number'],
            ]);
            $newContent[] = $newItem;
        }

        return response()->json($newContent, 200);
    }
}
