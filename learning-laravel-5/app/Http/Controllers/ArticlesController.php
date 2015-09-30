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
        //$articles = Article::latest('published_at')->get();

        /**
         * limit the record using Where
         */
        //$articles = Article::latest('published_at')->where('published_at', '<=', Carbon::now())->get();

        /**
         * using Query Scope to write query
         * The Query Scope function will be on Article Model
         */
        $articles = Article::latest('published_at')->published()->get();

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

        /**
         * This is one by one Assingment
         * $article = new Article;
        $article->title = $input['title'];
        $article->body = $input['body'];
        **/

        /** This is mass assignment */
        Article::create(Request::all());

        return redirect('article');
    }
}
