<?php

namespace App\Helpers;

use App\Models\User\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\UnableToCheckFileExistence;
use Nette\FileNotFoundException;

class Helper
{
    public static function error($message, $code)
    {
        return Response::json([
            'status' => 'error',
            'success' => false,
            'code' => $code,
            'message' => $message], $code);
    }

    public static function success($message, $code)
    {
        return Response::json([
            'status' => 'success',
            'success' => true,
            'code' => $code,
            'message' => $message], $code);
    }

    public static function imageResponse($request)
    {

        $url = [];
        foreach ($request['data'] as $data) {
            if (Storage::disk('s3')->exists($data->path)) {
                $value = [
                    'id' => $data->id,
                    'path' => Storage::disk('s3')->url($data->path)
                ];
                array_push($url , $value);
            }
        }
        return [
            'url' => $url,
        ];
    }

    public static function isSuperAdmin()
    {
        return Auth::user()->userLevel->scope == 'super_admin' ? true : null;
    }

    public static function superAdmin()
    {
        return User::where('user_level_id',1)->first();
    }

    public static function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }



}
