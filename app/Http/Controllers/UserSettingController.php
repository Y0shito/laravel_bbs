<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\User;
use App\Traits\Spaceremoval;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserSettingController extends Controller
{
    use Spaceremoval;

    public function showSettings($id)
    {
        $isMyPage = (int)$id === Auth::id();

        if ($isMyPage) {
            $user = User::where('id', $id)->withCount(['userFollowers' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->first();

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
            return redirect()->route('userpage', ['id' => Auth::id()]);
        } catch (Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
            return back();
        }
    }
}
