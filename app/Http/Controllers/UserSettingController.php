<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\User;
use App\Traits\Spaceremoval;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserSettingController extends Controller
{
    use Spaceremoval;

    public function showSettings($id)
    {
        $isMyPage = (int)$id === Auth::id();

        if ($isMyPage) {
            $user = User::getUserInfo($id);
            return view('settings', compact('user', 'isMyPage'));
        }
        return back();
    }

    public function updateSettings(SettingRequest $request)
    {
        $introduction = Spaceremoval::spaceRemoval($request->introduction);
        $url = Spaceremoval::spaceRemoval($request->url);

        DB::beginTransaction();

        try {
            $settings = User::where('id', Auth::id())->update(
                [
                    'introduction' => $introduction,
                    'url' => $url,
                ]
            );

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::critical($e);
            return back()
                ->with(['class' => 'text-red-500 body-font bg-red-100 shadow-md', 'message' => '設定を保存できませんでした']);
        }

        return redirect()->route('userpage', ['id' => Auth::id()]);
    }
}
