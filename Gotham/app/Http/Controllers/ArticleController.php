<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\ArticleValidator;
use App\Policies\ArticlePolicy;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $article = Article::all();

        return response()->json($article, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleValidator $request)
    {
        $articleData = new Article();
        $articleData->title = $request->title;
        $articleData->description = $request->description;
        $articleData->creator_id = 1;


        $articleData->Save();
        $article  = Article::all();


        $client = new \GuzzleHttp\Client();

        $url = "http://localhost:8080/api/articles";

        $data = $client->post($url, ['data' => $articleData]);

        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $article = Article::find($id);



        return response()->json($article, 200);
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
    public function update(ArticleValidator $request, $id)
    {
        $article = Article::find($id);
        $article->title = $request->title;
        $article->description = $request->description;

        $article->Save();

        $article = Article::all();
        return response()->json($article, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id)->delete();

        $article  = Article::all();
        return response()->json($article, 201);
    }
}
