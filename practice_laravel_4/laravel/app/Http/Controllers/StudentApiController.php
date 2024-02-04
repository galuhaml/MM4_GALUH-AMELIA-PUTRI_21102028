<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use File;
use App\Models\Student;

class StudentApiController extends Controller
{
    public function store(Request $request){ 
        $validateData = Validator::make($request->all(), [
        'nim' => 'required|size:8,unique:student,nim',
        'nama' => 'required|min:3|max:50',
        'jenis_kelamin' => 'required|in:P,L',
        'jurusan' => 'required',
        'alamat' => '',
        'image' => 'required|file|image|max:1000',
    ]);
    if ($validateData->fails()) {
        return response($validateData->errors(), 400);
    }else{
        $mahasiswa = new Student();
        $mahasiswa->nim = $request->nim;
        $mahasiswa->name = $request->nama;
        $mahasiswa->gender = $request->jenis_kelamin;
        $mahasiswa->departement = $request->jurusan;
        $mahasiswa->address = $request->alamat;
        if($request->hasFile('image')){
            $extFile = $request->image->getClientOriginalExtension();
            $namaFile = 'user-'.time().".".$extFile;
            $path = $request->image->move('assets/images',$namaFile);
            $mahasiswa->image = $path;
        }
        $mahasiswa->save();
        return response()->json([
            "message" => "student record created"
        ], 201);
        $students = Student::all()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
    }}
    public function update(Request $request, Student $student){
        if (Student::where('id', $id)->exists()) {
            $validateData = Validator::make($request->all(), [
            'nim' => 'required|size:8,unique:student,nim',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            'image' => 'required|file|image|max:1000',
            ]);
            if ($validateData->fails()) {
                return response($validateData->errors(), 400);
            }else{
                $mahasiswa = Student::find($id);
                $mahasiswa->nim = $request->nim;
                $mahasiswa->name = $request->nama;
                $mahasiswa->gender = $request->jenis_kelamin;
                $mahasiswa->departement = $request->jurusan;
                $mahasiswa->address = $request->alamat;
                if (Student::where('id', $id)->exists()) {
                    $mahasiswa = Student::find($id);
                    File::delete($mahasiswa->image);
                    $mahasiswa->delete();
                    return response()->json([
                        "message" => "student record deleted"
                    ], 201);
                }else {
                    return response()->json([
                        "message" => "Student not found"
                    ], 404);
                }
            }
        }
        
}
}