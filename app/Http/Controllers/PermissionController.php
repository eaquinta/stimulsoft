<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JasperPHP\JasperPHP;

class PermissionController extends Controller
{
    public function index(){
        return view('permission.index');
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
            $reg = Permission::find($id);
            DB::commit();
            return response()->json([
                'status' => 200,
                'messages' => 'Registro recuperado correctamente',
                'data' => $reg
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
            $reg = new Permission;
            $reg->name = $request->name;
            $reg->save();
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

    public function destroy($id) {
        $validator = Validator::make([
            "id" => $id
        ],[
            "id" => "required|exists:permissions,id"
        ]);

       if($validator->fails()) {
           return request()->json([
               "status"  => 406,
               "messages" => $validator->errors()->all(),
           ]);
       }
       DB::beginTransaction();
       try {
           $reg = Permission::find($id);
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
            $data = Permission::latest()->get();
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
    /*
    |--------------------------------------------------------------------------
    | Region privada
    |--------------------------------------------------------------------------
    */
    private function key_rules(){
        return  [
            'id' => 'required|exists:permissions,id',
        ];
    }

    private function rules() {
        return  [
            'name' => 'required|unique:permissions,name',
            // 'segundo_nombre' => 'max:100',
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
