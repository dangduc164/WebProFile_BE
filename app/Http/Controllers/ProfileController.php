<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilesConentRequest;
use App\Models\InformationUser;
use App\Models\ProfilesAvatar;
use App\Models\ProfilesContent;
use App\Models\ProfilesSocial;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function Psy\debug;

class ProfileController extends Controller
{

    public function uploadAvatar(Request $request): JsonResponse
    {

        $data = ProfilesAvatar::where('user_id', $request->user_id)->get()->toArray();

        $old_img_avatar = $data[0]['image_avatar'];

        if (file_exists($old_img_avatar)) {
            unlink($old_img_avatar);
        }

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
        $filePath = Storage::url($path);

        if (!$checkExtension) {
            return response()->json(['invalid_file_format'], 422);
        }

        $informationImage = getimagesize($file);

        // Save profile avatar information
        $profileAvatar = ProfilesAvatar::updateOrCreate(
            ['user_id' => $request->user_id],
            ['image_avatar' => $filePath]
        );

        $response = [
            'status' => 200,
            'message' => 'Upload success',
            'information' => $informationImage,
            'user_id' => $request->user_id,
            'type' => $type,
            'length' => filesize($file),
            'extension' => $extension,
            'image_avatar' => $filePath,
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

        try {
            if ($id) {
                $dataUser = User::find($id)->get()->toArray();
                if (empty($dataUser)) {
                    $response = [
                        'user' => null,
                        'message' => 'Not found user'
                    ];
                    return response()->json($response, 404);
                }
                $dataInfor = User::select(
                    'users.*',
                    'profiles_avatars.image_avatar',
                    'information_users.*',
                    // 'profiles_contents.*'
                )
                    ->leftJoin('profiles_avatars', 'users.id', '=', 'profiles_avatars.user_id')
                    ->leftJoin('information_users', 'users.id', '=', 'information_users.user_id')
                    // ->leftJoin('profiles_contents', 'users.id', '=', 'profiles_contents.user_id')
                    ->where('users.id', $id)
                    ->get()
                    ->toArray();

                $dataContent = ProfilesContent::where('user_id', $id)->orderBy('order_number', 'asc')->get()->toArray();

                $dataSocial = ProfilesSocial::select(
                    'profiles_socials.facebook_url',
                    'profiles_socials.zalo_url',
                    'profiles_socials.github_url',
                    'profiles_socials.instagram_url',
                    'profiles_socials.twitter_url',
                )
                    ->where('profiles_socials.user_id', $id)
                    ->get()
                    ->toArray();


                $response = [
                    'infor' => $dataInfor[0],
                    'content' => $dataContent,
                    'link_social' => $dataSocial[0],
                ];
                return response()->json($response, 200);
            }
        } catch (Exception $e) {
            // Handle database errors here (e.g., log the error, return a generic error response)

        }
    }


    public function getInforCustomer($id): JsonResponse
    {

        try {
            if ($id) {
                $dataUser = User::find($id)->get()->toArray();
                if (empty($dataUser)) {
                    $response = [
                        'user' => null,
                        'message' => 'Not found user'
                    ];
                    return response()->json($response, 404);
                }
                $dataInfor = User::select(
                    'users.*',
                    'profiles_avatars.image_avatar',
                    'information_users.*',
                    // 'profiles_contents.*'
                )
                    ->leftJoin('profiles_avatars', 'users.id', '=', 'profiles_avatars.user_id')
                    ->leftJoin('information_users', 'users.id', '=', 'information_users.user_id')
                    // ->leftJoin('profiles_contents', 'users.id', '=', 'profiles_contents.user_id')
                    ->where('users.id', $id)
                    ->get()
                    ->toArray();

                $dataContent = ProfilesContent::where('user_id', $id)->orderBy('order_number', 'asc')->get()->toArray();

                $dataSocial = ProfilesSocial::select(
                    'profiles_socials.facebook_url',
                    'profiles_socials.zalo_url',
                    'profiles_socials.github_url',
                    'profiles_socials.instagram_url',
                    'profiles_socials.twitter_url',
                )
                    ->where('profiles_socials.user_id', $id)
                    ->get()
                    ->toArray();


                $response = [
                    'data' => [
                        'infor' => $dataInfor[0],
                        'content' => $dataContent,
                        'link_social' => $dataSocial[0],
                    ]
                ];
                return response()->json($response, 200);
            }
        } catch (Exception $e) {
            // Handle database errors here (e.g., log the error, return a generic error response)

        }
    }


    public function createOrUpdate(Request $request, $id)
    {
        $infor = $request->infor;
        $newInfor = InformationUser::updateOrCreate(
            [
                'user_id'   => $id,
            ],
            [
                'email' => $infor['email'],
                'full_name' => $infor['full_name'],
                'work_experience' => $infor['work_experience'],
                'position_application' => $infor['position_application'],
                'phone_number' => $infor['phone_number'],
                'day' => $infor['day'],
                'month' => $infor['month'],
                'year' => $infor['year'],
                'birthday_inder' => $infor['birthday_inder'],
                'address' => $infor['address'],
                'gender' => $infor['gender'],
            ]
        );

        ProfilesSocial::where('user_id', $id)->delete();
        $linkSocial =  $request->link_social;
        $newLinkSocial = ProfilesSocial::updateOrCreate(
            [
                'user_id' => $id,
            ],
            [
                'facebook_url' => $linkSocial['facebook_url'] ?? null,
                'twitter_url' => $linkSocial['twitter_url'] ?? null,
                'github_url' => $linkSocial['github_url'] ?? null,
                'zalo_url' => $linkSocial['zalo_url'] ?? null,
                'instagram_url' => $linkSocial['instagram_url'] ?? null,
            ]
        );

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

        $response = [
            'info' => $newInfor,
            'link_social' => $newLinkSocial,
            'content' => $newContent
        ];

        return response()->json($response, 200);
    }
}
