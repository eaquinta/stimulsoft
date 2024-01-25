<?php

namespace App\Http\Controllers;
use Exception;
use Validator;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JasperPHP\JasperPHP;

class RoleController extends Controller
{
    public function __construct(){
        // $this->middleware('permissions:ver-rol | crear-rol | editar-rol | borrar-rol', ['only' => ['index']]);
        // $this->middleware('permissions:crear-rol', ['only' => ['create','store']]);
        // $this->middleware('permissions:editar-rol', ['only' => ['edit','update']]);
        // $this->middleware('permissions:borrar-rol', ['only' => ['destroy']]);
    }


    public function index(){
        return view('role.index');
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
            $permissions = Permission::all()->pluck('name','id');
            $reg = Role::find($id);
            DB::commit();
            return response()->json([
                'status' => 200,
                'messages' => 'Registro recuperado correctamente',
                'data' => $reg,
                'permissions' => $permissions
            ]);
        } catch (Exeption $e) {
            DB::rollback();
            return request()->json([
                'status' => 500,
                'messages' => $e->getMessage()
            ]);
        }
    }

    public function edit($id){
        //dd($id);
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
            $reg = Role::find($id);
            $permissions = Permission::all()->pluck('name','id');
            //
            $rolePermission = DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)->get()->pluck('permission_id');
            DB::commit();
            return response()->json([
                'status' => 200,
                'messages' => 'Registro recuperado correctamente',
                'data' => $reg,
                'permissions' => $permissions,
                'rolePermissions' => $rolePermission
            ]);
        } catch (Exeption $e) {
            DB::rollback();
            return request()->json([
                'status' => 500,
                'messages' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request) {
        $rules = self::rules();
        $messages = self::messages();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        }

        DB::beginTransaction();
        try {
            $reg = new Role;
            $reg->name = strtolower($request->name);
            $reg->save();
            $reg->syncPermissions($request->permissions);
            //if($reg)
            DB::commit();
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

    public function update(Request $request){
        $rules = self::rules();
        $messages = self::messages();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        }

        DB::beginTransaction();
        try {
            $reg = Role::find($request->id);
            //$reg->name = $request->name;
            //$reg->save();
            //dd($request->permissions);
            $reg->syncPermissions($request->permissions);
            DB::commit();
            return response()->json([
                "status"  => 200,
                "data"    => $reg,
                "messages" => "Se actualizó satisfatoriamente el registro"
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
            [ "id" => $id ],
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
            $reg = Role::find($id);
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
            $data = Role::latest()->get();
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
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function audits($id) {
        // $key = ['id' => $id ];
        // $reg = Persona::find($id);
        // $audits = $reg->audits()->with('user')->get();
        // $auditsWithModified = $audits->map(function ($audit) {
        //     $auditData = $audit->getModified();
        //     $ad = [];
        //     foreach ($auditData as $field => $value) {
        //         $findField = 'validation.attributes.'.$field;
        //         $transField = __($findField);
        //         $finalField = ($findField == $transField) ? $field : $transField;
        //         $ad[$finalField] = $value;
        //     }
        //     $audit->modified_data = $ad;
        //     return $audit;
        // });
        // return response()->json(['status' => 200,'audits' => $auditsWithModified]);
    }

    public function report(){
        // $report = new JasperPHP();
        // $input  = base_path('public/reports/personas.jrxml');
        // $output = base_path('public/reports/'.time().'-usuarios');
        // $options = [];
        // $bp = base_path('public/reports');

        // $report->process(
        //     $input,
        //     $output,
        //     ["pdf"],
	    //     ["base_path" => $bp],
	    //     [
		//         'driver'   => 'mysql',
		//         'host'     => env('DB_HOST'),
		//         'port'     => env('DB_PORT'),
		//         'username' => env('DB_USERNAME'),
		//         'password' => env('DB_PASSWORD'),
		//         'database' => env('DB_DATABASE').'?useSSL=false'
	    //     ],
	    //     'en'
        // )->execute();

        // if (!file_exists($output.'.pdf')) {
        //         abort(404);
        // }
        // return response()->file($output.'.pdf')->deleteFileAfterSend();
    }

    /*
    |--------------------------------------------------------------------------
    | Region privada
    |--------------------------------------------------------------------------
    */

    private function key_rules(){
        return  [
            'id' => 'required|exists:roles,id',
        ];
    }

    private function rules() {
        return  [
            'name' => 'required|unique:roles,name',
            //'permissions' => 'required',
            // 'tercer_nombre' => 'max:100',
            // 'primer_apellido' => 'required',
            // 'segundo_apellido' => 'max:100',
            // 'apellido_casada' => 'max:100',
        ];
    }

    private function messages() {
        return [
        ];
    }
}
