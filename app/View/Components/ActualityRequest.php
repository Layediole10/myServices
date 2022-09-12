<?php

namespace App\View\Components;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublishArticleController;
use Illuminate\View\Component;

class ActualityRequest extends Component
{

    public $allArticles;
    public $allComments;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PublishArticleController $articles, CommentController $comments)
    {
        $this->allArticles = $articles;
        $this->allComments = $comments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.actuality-request');
    }

}
