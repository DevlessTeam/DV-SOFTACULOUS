<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstallController extends Controller
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
        //Accept params to configure database for shared hosting
        $content = [

          1 => "DB_CONNECTION=mysql",
          3 => "DB_DATABASE=$request->database",
          4 => "DB_USERNAME=$request->username",
          5 => "DB_PASSWORD=$request->password"

        ];


        function edit($content){
            $filename = base_path('.env');
            chmod($filename, 0777);
            foreach($content as $line => $modifiedContent ) {
                $line_i_am_looking_for = $line-1;
                $lines = file( $filename , FILE_IGNORE_NEW_LINES );
                $lines[$line_i_am_looking_for] = $modifiedContent;
                file_put_contents( $filename , implode( "\n", $lines ) );
            }
        }

        edit($content);

        $del = unlink(app_path('Http/Controllers/InstallController.php'));

        if ($del) {
           return url('/');
        } else {
          echo "Error setting up your instance";
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
        //
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
