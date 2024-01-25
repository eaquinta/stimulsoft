<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JasperPHP\JasperPHP;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function show($id){
        $validator = Validator::make(
            [ "id" => $id ],
            self::key_rules()
        );
        if($validator->fails()) {
            return request()->json([
                "status"  => 400,
                "messages" => $validator->errors()->all(),
            ]);
        }
        DB::beginTransaction();
        try {
            $reg = User::find($id);
            DB::commit();
            return response()->json([
                'status' => 200,
                'messages' => 'Registro recuperado correctamente',
                'data' => $reg,
            ]);
        } catch (Exeption $e) {
            DB::rollback();
            return request()->json([
                'status' => 500,
                'messages' => $e->getMessage()
            ]);
        }
    }

    public function create(){
        $roles = Role::orderBy('name')->pluck('name', 'name')->all();
        return response()->json([
            'status' => 200,
            'messages' => 'ok',
            'roles' => $roles,
        ]);
    }

    public function store(Request $request){
        //dd($request);
        $rules = self::rules();
        $messages = self::messages();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return response()->json([
                //'status' => 400,
                'messages' => $validator->getMessageBag()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $reg = new User;
            $reg->name = $request->name;
            $reg->email = $request->email;
            $reg->password = Hash::make($request->password);
            $reg->save();
            $reg->syncRoles($request->roles);
            //dd($request->roles);
            DB::commit();
            //dd($reg);
            return response()->json([
                'status' => 200,
                'messages' => 'Registro creado correctamente'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'messages' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id) {
        $validator = Validator::make(
            ["id" => $id],
            self::key_rules()
        );

       if($validator->fails()) {
           return request()->json([
               "status"  => 406,
               "messages" => $validator->errors()->all(),
           ]);
       }
       DB::beginTransaction();
       try {
           $reg = User::find($id);
           $reg->delete();
           DB::commit();
           return response()->json([
               'status' => 200,
               'messages' => 'Registro eliminado correctamente']
           );
       } catch (Exception $e) {
           DB::rollBack();
           return response()->json([
               'status'=> 500,
               'messages' => $e->getMessage()
           ]);
        }
   }

    public function datatable(Request $request) {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '<div class="dropdown d-inline-block">
                <button class="btn btn-sm btn-outline-secondary rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item view"   data-model-id="'.$row->id.'"><i class="far fa-eye"></i> Ver</a></li>
                <li><a class="dropdown-item edit"   data-model-id="'.$row->id.'"><i class="far fa-edit"></i> Editar</a></li>
                <li><a class="dropdown-item delete" data-model-id="'.$row->id.'"><i class="fas fa-trash-alt"></i> Eliminar</a></li>
                <li><a class="dropdown-item audits" data-model-id="'.$row->id.'"><i class="fas fa-history"></i> Auditoria</a></li>
                </ul>
                </div>';
            })
            ->addColumn('roles', function ($row){
                $res = '';
                foreach ($row->getRoleNames() as $rol) {
                    $res .= "<span class='badge bg-info text-dark'>".$rol."</span>";
                }
                return $res;
            })
            ->rawColumns(['action','roles'])
            ->make(true);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Region privada
    |--------------------------------------------------------------------------
    */

    private function key_rules(){
        return  [
            'id' => 'required|exists:users,id',
        ];
    }

    private function rules() {
        return  [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'roles' => 'required|array|min:1', // Ensure roles is an array and not empty
            'roles.*' => 'exists:roles,name', // Validate if the role IDs exist in the roles table
        ];
    }

    private function messages() {
        return [
        ];
    }
}
