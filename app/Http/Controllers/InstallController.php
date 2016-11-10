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

          29 => "'default' => 'mysql',",
          69 => "'host' =>  'localhost',",
          70 => "'database'  => '$request->db_name',",
          71 => "'username'  => '$request->db_user',",
          72 => "'password'  => '$request->db_pass',",

        ];


        function edit($content){
            $filename = config_path('database.php');
            chmod($filename, 0777);
            foreach($content as $line => $modifiedContent ) {
                $line_i_am_looking_for = $line-1;
                $lines = file( $filename , FILE_IGNORE_NEW_LINES );
                $lines[$line_i_am_looking_for] = $modifiedContent;
                file_put_contents( $filename , implode( "\n", $lines ) );
            }
        }

          // app('App\Http\Controllers\UserController')->post_register($request);

        edit($content);
        $this->show();
        // return url('/');

        // $del = unlink(app_path('Http/Controllers/InstallController.php'));
        //
        // if ($del) {
        //    return url('/');
        // } else {
        //   echo "Error setting up your instance";
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $conn = \Schema::connection('mysql');

        $conn::create('apps', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('token')->default(md5(uniqid()));
            $table->timestamps();
        });
        echo 'Done';
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
