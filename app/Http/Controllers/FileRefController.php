<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\FileRef;

class FileRefController extends Controller
{
    // only logged in user can use the methods
    public function __construct()
    {
      $this->middleware('auth');
    }

    // This method handles the file upload and encryption
    public function upload (Request $request)
    {
      $file = $request->file('file');

      $fileContent = $file->get();

      $encryptedFile = encrypt($fileContent);

      $fileName = $file->getClientOriginalName();

      $store = Storage::disk('local')->put($fileName.'.dat', $encryptedFile);

      if($store == true) {
        FileRef::create([
          'ref' => $this->generateRandomString(),
          'filename' => $fileName
        ]);

        return redirect()->back();
      }
    }

    // This method handles the file decryption and download
    public function download ($ref)
    {
      if (FileRef::Where('ref', $ref)->exists()) {
        $file = FileRef::Where('ref', $ref)->first();

        $encryptedFile = Storage::disk('local')->get($file->filename.'.dat');

        $decryptedFile = decrypt($encryptedFile);

        $store = Storage::disk('local')->put('public/'.$file->filename, $decryptedFile);

        return response()->download(storage_path("app/public/{$file->filename}"))->deleteFileAfterSend(true);;

      }
    }

    // This method returns all encrypted files along with their download link
    public function listAll()
    {
      $infos = FileRef::get();
      return view('all', compact('infos'));
    }

    public function generateRandomString ($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
      $charactersLength = strlen($characters);
      $randomString = '';

      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }

      return $randomString;
    }
}
