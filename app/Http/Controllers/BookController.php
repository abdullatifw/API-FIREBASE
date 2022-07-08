<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $database;
    
    public function __construct()
    {
        $this->database = \App\Services\FirebaseService::connect();
    }

    public function create(Request $request) 
    {
        $this->database
            ->getReference('test/books/' . $request['name'])
            ->set([
                'price' => $request['price'],
                'desc' => $request['desc']
            ]);

        return response()->json('book has been created');
    }

    public function index() 
    {
        return response()->json($this->database->getReference('test/books')->getValue());
    }

    public function edit(Request $request) 
    {
        $this->database->getReference('test/books/' . $request['name'])
            ->update([
                'price/' => $request['price'],
                'desc/' => $request['desc']
            ]);

        return response()->json('book has been edited');
    }

    public function delete(Request $request)
    {
        $this->database
            ->getReference('test/books/' . $request['name'])
            ->remove();

        return response()->json('book has been deleted');
    }


}
