<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\LoginSecurity;
use spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }


    /**
     * Display the user's profile form.
     */
    public function edit(User $user): View
    {
        if($user->hasRole('Super Admin'))
        {
            if($user->id != auth()->user()->id){
                abort(403,'Usuario no tiene los permisos suficientes.');
            }
        }
        return view('profile.edit', [
            'user' => $user,
            'roles'=>Role::pluck('name')->all(),
            'userRoles'=>$user->roles->pluck('name')->all(),
            'activado2fa'=> LoginSecurity::where('user_id','=',$user->id),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->syncRoles($request->roles);
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(User $user): RedirectResponse
    {
        if($user->hasRole('Super Admin') || $user->id == auth()->user()->id )
        {
            abort(403,'El usuario no tiene los permisos requeridos.');
        }

        $user->syncRoles([]);

        Auth::logout();

        $user->delete();

        return Redirect::to('/');
    }
}
