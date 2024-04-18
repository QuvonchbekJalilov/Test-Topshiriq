<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return $this->response($user);
    }



    public function store(UserStoreRequest $request)
    {
        $user = auth()->user();

        if ($user->profile) {
            return $this->response($user->profile);
        }

        if ($request->has('photo')) {
            $path = $request->file('photo')->storeAs('user_images', uniqid() . '.' . $request->file('photo')->getClientOriginalExtension(), 'public');
        }

        UserProfile::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'photo' => $path,
        ]);
        return $this->success('user stored information successfully');
    }


    public function show($id)
    {
        $user = User::with('profile')->find($id);
        if (!$user) {
            return $this->error('profile not found');
        }

        $userData = [
            'id' => $user->id,
            'first_name' => $user->profile->first_name ?? null,
            'last_name' => $user->profile->last_name ?? null,
            'photo' => $user->profile->photo ?? null,
            'data' => new UserResource($user)
        ];
        return $this->response($userData);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = UserProfile::find($id);

        if (!$user) {
            return $this->error('User profile not found');
        }

        if ($request->has('first_name')) {
            $user->first_name = $request->first_name;
        }

        if ($request->has('last_name')) {
            $user->last_name = $request->last_name;
        }

        if ($request->hasFile('photo')) {
            Storage::delete($user->photo);
            $path = $request->file('photo')->storeAs('user_photos', uniqid() . '.' . $request->file('photo')->getClientOriginalExtension(), 'public');
            $user->photo = $path;
        }

        $user->save();

        return $this->success('Profile updated');
    }



    public function destroy(string $id)
    {
        $user = UserProfile::find($id);
        if (isset($user->photo)) {
            Storage::delete($user->photo);
        }
        $user->delete();
        return $this->success('Profile deleted');
    }
}
