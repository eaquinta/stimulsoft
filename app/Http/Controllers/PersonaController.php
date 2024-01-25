<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use DataTables;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JasperPHP\JasperPHP;

class PersonaController extends Controller
{
    public function index(){
        return view('persona.index');
    }

    public function show($id){
        $validator = Validator::make([
            "id" => $id
        ],[
            "id" => "required|exists:personas,id"
        ]);
        if($validator->fails()) {
            return request()->json([
                "status"  => 400,
                "messages" => $validator->errors()->all(),
            ]);
        }
        DB::beginTransaction();
        try {
            $reg = Persona::find($id);
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

        $fileName = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        }

        DB::beginTransaction();
        try {
            $reg = new Persona;
            $reg->primer_nombre = $request->primer_nombre;
            $reg->segundo_nombre = $request->segundo_nombre;
            $reg->tercer_nombre = $request->tercer_nombre;
            $reg->primer_apellido = $request->primer_apellido;
            $reg->segundo_apellido = $request->segundo_apellido;
            $reg->apellido_casada = $request->apellido_casada;
            $reg->foto = $fileName;
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

        $fileName = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        }

        DB::beginTransaction();
        try {
            $reg = Persona::find($request->id);
            $fileNameToDelete = $reg->foto;
            $reg->primer_nombre = $request->primer_nombre;
            $reg->segundo_nombre = $request->segundo_nombre;
            $reg->tercer_nombre = $request->tercer_nombre;
            $reg->primer_apellido = $request->primer_apellido;
            $reg->segundo_apellido = $request->segundo_apellido;
            $reg->apellido_casada = $request->apellido_casada;
            $reg->foto = $fileName;
            $reg->save();
            DB::commit();
            if ($fileNameToDelete && Storage::exists('public/images/' . $fileNameToDelete)) {
                Storage::delete('public/images/' . $fileNameToDelete);
            }
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
         $validator = Validator::make([
             "id" => $id
         ],[
             "id" => "required|exists:personas,id"
         ]);

        if($validator->fails()) {
            return request()->json([
                "status"  => 406,
                "messages" => $validator->errors()->all(),
            ]);
        }
        DB::beginTransaction();
        try {
            $reg = Persona::find($id);
            if (Storage::exists('public/images/' . $reg->foto)) {
                Storage::delete('public/images/' . $reg->foto);
                //Persona::destroy($id);
            }
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
            $data = Persona::latest()->get();
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
        $key = ['id' => $id ];
        $reg = Persona::find($id);
        $audits = $reg->audits()->with('user')->get();
        $auditsWithModified = $audits->map(function ($audit) {
            $auditData = $audit->getModified();
            $ad = [];
            foreach ($auditData as $field => $value) {
                $findField = 'validation.attributes.'.$field;
                $transField = __($findField);
                $finalField = ($findField == $transField) ? $field : $transField;
                $ad[$finalField] = $value;
            }
            $audit->modified_data = $ad;
            return $audit;
        });
        return response()->json(['status' => 200,'audits' => $auditsWithModified]);
    }

    public function report(){
        $report = new JasperPHP();
        $input  = base_path('public/reports/personas.jrxml');
        $output = base_path('public/reports/'.time().'-usuarios');
        $options = [];
        $bp = base_path('public/reports');

        $report->process(
            $input,
            $output,
            ["pdf"],
	        ["base_path" => $bp],
	        [
		        'driver'   => 'mysql',
		        'host'     => env('DB_HOST'),
		        'port'     => env('DB_PORT'),
		        'username' => env('DB_USERNAME'),
		        'password' => env('DB_PASSWORD'),
		        'database' => env('DB_DATABASE').'?useSSL=false'
	        ],
	        'en'
        )->execute();

        if (!file_exists($output.'.pdf')) {
                abort(404);
        }
        return response()->file($output.'.pdf')->deleteFileAfterSend();
    }

    /*
    |--------------------------------------------------------------------------
    | Region privada
    |--------------------------------------------------------------------------
    */

    private function rules() {
        return  [
            'primer_nombre' => 'required',
            'segundo_nombre' => 'max:100',
            'tercer_nombre' => 'max:100',
            'primer_apellido' => 'required',
            'segundo_apellido' => 'max:100',
            'apellido_casada' => 'max:100',
        ];
    }

    private function messages() {
        return [
        ];
    }
}
