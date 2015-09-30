<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Request;

class ArticlesController extends Controller
{
    public function index() {
        /** @var fetch all record $articles */
        //$articles = Article::all();

        /** Fetch the end of record, Order by Des order*/
        $articles = Article::latest('published_at')->get();

        return view('articles.index', compact('articles'));
    }

    public function show($id) {
        $articles = Article::findOrFail($id);

        return view('articles.show',compact('articles'));
    }

    public function create() {
        return view('articles.create');
    }

    public function store() {

        //Request only one input values
        //$input = Request::get('title');
        $input = Request::all();

        /**
         * This is one by one Assingment
         * $article = new Article;
        $article->title = $input['title'];
        $article->body = $input['body'];
        **/

        /** This is mass assignment */
        $input['published_at'] = Carbon::now();
        Article::create($input);

        return redirect('article');
    }
}
