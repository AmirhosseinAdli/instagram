<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\Media;
use App\Models\ProfilePicture;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function show()
    {
        return view('settings');
    }

    public function update(UpdateRequest $request)
    {
        $arr = $request->all();
        $arr['password'] = Hash::needsRehash($arr['password']) ? Hash::make($arr['password']) : $arr['password'];
        auth()->user()->update($arr);
        if ($request->has('picture')) {
            $path = $request->file('picture')->storePublicly('users');
            if ($profilePicture = ProfilePicture::where('user_id',auth()->id())->first()) {
                $profilePicture->update([
                    'path' => $path,
                    'user_id' => auth()->id(),
                ]);
            } else {
                ProfilePicture::create([
                    'path' => $path,
                    'user_id' => auth()->id(),
                ]);
            }
        }
        return redirect()->route('profile', auth()->user());
    }
}
