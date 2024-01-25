<?php

namespace App\Http\Controllers;

use Hash;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function change_password() {
        return view('auth.passwords.change');
    }

    public function update_password(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        }

        $current_user = auth()->user();

        if(Hash::check($request->old_password, $current_user->password)) {
            $current_user->update([
                'password' => bcrypt($request->new_password)
            ]);

            return response()->json([
                'status' => 200,
                'messages' => 'Contraseña actualizada',
            ]);
        }

        return response()->json([
            'status' => 401,
            'messages' => 'La constraseña anterior es incorrecta.'
        ]);
    }

    public function profile(){
        $data = ['reg' => $reg = auth()->user()];
        return view('auth.profile', $data);
    }

    public function profile_image(Request $request){
        $reg = auth()->user();
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/images',$fileName);

            if($reg->foto){
                if (Storage::exists('public/images'.$reg->foto)){
                    Storage::delete('public/images'.$reg->foto);
                }
            }

            User::where('id', $reg->id)->update([
                'foto' => $fileName
            ]);

            return response()->json([
                'status' => 200,
                'messages' => 'Se actualizo correctamente la imagen',
            ]);
        }
    }

    public function profile_ajax(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'genero' => ['required', 'string', 'min:8', 'confirmed'],
            //'fecha_nacimiento' => ['required', 'string', 'min:8'],
            'telefono' => ['required', 'string'],
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        }
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            //'genero' => $request->genero,
            //'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
        ]);
        return response()->json([
            'status' => 200,
            'messages' => 'Su perfil se actualizado correctamente'
        ]);
    }
}
