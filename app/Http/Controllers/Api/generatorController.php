<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class generatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validatedData = Validator::make($request->all(),[
                'no_surat' => 'required',
                'nama_ttd' => 'required',
                'tanggal_ttd' => 'required'
            ]);

            if($validatedData->fails()){
                return response()->json([
                    'messages' => $validatedData->messages()
                ],400);
            };

            $rand_id = rand(1000,100000);

            $post = Generator::create([
                'rand_id' => $rand_id,
                'no_surat' => $request->no_surat,
                'nama_ttd' => $request->nama_ttd,
                'tanggal_ttd' => $request->tanggal_ttd,
                'email_no_hp' => $request->email_no_hp,
                'perihal' => $request->perihal,
            ]);

            if($post){
                Generator::where('rand_id', $rand_id)->get();
                $file = public_path('storage\barcode-'.$rand_id.'.png');
                $path = asset('storage\barcode-'.$rand_id.'.png');
                $id = Generator::where('rand_id', $rand_id)->first();
                // @dd($id);
                \QRCode::url(url('/view-barcode?id='.$id->id))->setSize(7)->setOutfile($file)->png();
                return response()->json([
                    'status' => 'Berhasil',
                    'code' => '200',
                    'messages' => 'Generate berhasil',
                    'data' => [
                        'messages' => 'Generate Berhasil',
                        'files' => [
                            'path' => $file,
                            'asset' => $path
                        ],
                        'data' => $id
                    ]
                ],200);
            }
            else{
                return response()->json([
                    'messages' => 'Generate Gagal'
                ]);
            }

        }
        catch(\Exception $e){
            @dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = Generator::find($id);
            // @dd($data);
            return response()->json($data,200);
        }
        catch(\Exception $e){
            return response()->json(
                ['message' => $e->getMessage]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
