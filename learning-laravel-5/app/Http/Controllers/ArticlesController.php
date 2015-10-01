<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Requests\ArticleRequest as ArticleRequest;
//use Symfony\Component\HttpFoundation\Request;
use Illuminate\Http\Request;

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

    public function store(ArticleRequest $request) {


        //Request only one input values
        //$input = Request::get('title');

        /**
         * This is one by one Assingment
         * $article = new Article;
        $article->title = $input['title'];
        $article->body = $input['body'];
        **/

        /** This is mass assignment but this has no validation*/
        //Article::create(Request::all());

        /** This has vaildation */
        Article::create($request->all());

        return redirect('article');
    }

    public function edit($id) {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update($id, ArticleRequest $request) {
        $article = Article::findOrFail($id);

        $article->update($request->all());

        return redirect('article');
    }

}
