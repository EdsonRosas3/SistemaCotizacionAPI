<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\RequestQuotitation; 
use App\RequestDetail; 
use Validator;

class RequestQuotitationController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestQuotitation = RequestQuotitation::with('reports','request_details')->get();
        return response()->json(['request_quotitations'=>$requestQuotitation],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only('nameUnidadGasto', 'aplicantName','requestDate','amount');
        $arrayDetails = $request->only('details');
        $arrayDetails=$arrayDetails['details'];
        $validator = Validator::make($request->all(), [ 
            'nameUnidadGasto' => 'required', 
            'aplicantName' => 'required', 
            'requestDate' => 'required', 
            'amount' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
         $requestQuotitation = RequestQuotitation::create($input);
         $idQuotitation = $requestQuotitation['id'];
         $countDetails = count($arrayDetails);
         for ($i = 0; $i < $countDetails; $i++)
         {
             $detailI=$arrayDetails[$i];
             $detailI['request_quotitations_id']= $idQuotitation;
             RequestDetail::create($detailI);
            
         }
         return response()->json(['success' => $requestQuotitation], $this-> successStatus);
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $filename= pathinfo($filename, PATHINFO_FILENAME);
            $name_File = str_replace(" ","_",$filename);

            $extension = $file->getClientOriginalExtension();

            $picture = date('His') . "-" . $name_File . "." .$extension;
            $file->move(public_path('Files/'),$picture);
            return response()->json(["messaje"=>"File upload succesfully"]);
        }else{
            return response()->json(["messaje"=>"Error"]);
        }
    }
    public function fileDowload(){
        return response()->download(public_path('Files/db.pdf'), "base de datos");
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requestQuotitations = RequestQuotitation::with('reports','request_details')->get();
        $requestQuotitation = $requestQuotitations->find($id);
        return response()->json($requestQuotitation,200);
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
