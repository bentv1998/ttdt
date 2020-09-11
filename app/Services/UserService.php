<?php


namespace App\Services;


use App\User;

class UserService
{
    static function save($request, $mode, $model)
    {
        $rules['name'] = 'required';
        if ($mode === 'create') {
            $user = new User();
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|min:6';
        }
        else {
            $id = $model->user_id;
            $user = User::find($id);
            $rules['email'] = "required|email|unique:users,email,$id";
        }
        $request->validate($rules);

        $user->name = $request->name;
        if ($request->file) {
            $user->image = UploadService::decodeBase64($request->image, $request->file, 'media/upload');
        }
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();

        return $user;
    }

    static function destroy($id)
    {
        $deleted = false;
        $model = User::find($id);
        if ($model) {
            unlink(public_path($model->image));
            $deleted = $model->delete();
        }
        return $deleted;
    }
}
