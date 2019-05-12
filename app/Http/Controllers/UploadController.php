<?php

namespace App\Http\Controllers;

use App\Upload;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     

        // -------- Retrieving the logged in user --
        $user = Auth::user();

         // -------- Retreving all upload instance of the  logged in user ----
        $userUploads = Upload::where('user_id', Auth::id())->latest()->paginate(5);

         // -------- Passing required data to the view ----
        return view('uploads.index', compact('userUploads', 'user'));

        

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // -------- Retrieving the logged in user ----
        $user = Auth::user();

        // -------- Validating http request ----
        $this->validate($request, [
            'description' => 'required|string',
        ]);

        $sessionRemainingSize  = session('remainingSize');

        $backToKb = $sessionRemainingSize * 1024* 1024 ;

         if ($file = $request->file('file') and $backToKb < 209715200 ) {
            $name = $file->getClientOriginalName();

            if (strlen($name) > 25 ) {

                $nameCheckedLength = substr($name, 0,20);
            }else{
                $nameCheckedLength = $name;
            }
            $file->move('files', $name);
            $request->path = $nameCheckedLength; 

            $size = $file->getClientSize();

              
                if ($size > 1048576 ) {

                  $sizeConverted = round($size/1048576, 3);
                  $sizeType = 'Mb';
                }
                  elseif ($size > 1024) {
                    
                    $sizeConverted = round($size/1024, 3);
                    $sizeType = 'Kb';
                }

             //   return $sizeConverted.$sizeType;

              
            $extension = $file->getClientOriginalExtension();

            $manipulateCase = strtolower($extension);

            $imageExtensionInstance = array('jpg', 'jpeg', 'png');

            $audioExtensionInstance = array('mp3', 'wav');

            $videoExtensionInstance = array('mp4', 'hd');

            $documentExtensionInstance = array('docx', 'dox', 'pptx', 'pdf');



            if (in_array($manipulateCase, $imageExtensionInstance)) {

                $fileType = 'Image';

            }elseif (in_array($manipulateCase, $documentExtensionInstance)) {

                 $fileType = 'Document';

            }elseif (in_array($manipulateCase, $audioExtensionInstance)) {
                
                $fileType = 'Audio';

            }elseif (in_array($manipulateCase, $videoExtensionInstance)) {
                
                 $fileType = 'Video';
            }

            else{

                $fileType = 'Don\'t know for now';
            }

        }elseif (empty($request->file('file')) || $backToKb >= 209715200) {
          
                return redirect()->route('uploads.create');
       
        }

        // to get the title passed its also the same thing as $request->title;
        //  Post::create( $request->all()); could also be used to send data to the database

         $upload = new Upload([

             'description' => $request->description,
             'path' => $request->path,
             'size' => $sizeConverted,
             'extension' => $extension,
             'type' => $fileType,
             'sizeType' => $sizeType,

         ]);

         $user->uploads()->save($upload);
        return redirect()->route('uploads.index')->with('success','You uploaded one new file');


        
       
         


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        //
    }
}
