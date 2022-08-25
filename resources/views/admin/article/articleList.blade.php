@extends('layouts.admin')
@section('title','liste d\'articles')
@section('content')

    @if (session('delete'))
        <div class="alert alert-success">
            {{session('delete')}}
        </div>  
    @endif

    @if (session('update'))
        <div class="alert alert-success">
            {{session('update')}}
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-success">
            {{session('error')}}
        </div>
    @endif

    <table class="table table-bordered border-primary">
        <thead>
            <tr>
                <th>#</th>
                <th>title</th>
                <th>content</th>
                <th>author</th>
                <th>total images</th>
                <th>category</th>
                <th>publish</th>
                <th>publish date</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{$article->id}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->content}}</td>
                    <td>{{$article->author->name}}</td>
                    <td>{{$article->images->count()}}</td>
                    <td>{{$article->category->title}}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="publish"  role="switch" id="publish" onchange="if(confirm('Voulez vous publié cet article?')){document.getElementById('publish-{{$article->id}}').submit()}" @if ($article->publish)
                            checked
                          @endif>
                            
                            <form id="publish-{{$article->id}}" action="{{route('articles.publish',['id'=>$article->id])}}" method="post">
                                @csrf
                                @method('put')
                            </form>
                        </div>
                    </td>
                    <td>{{$article->created_at}}</td>
                    <td>
                        <a href="{{route('articles.edit',['article'=>$article->id])}}">
                            <i class="bi bi-pencil-square px-1"></i>
                        </a>
                        <a href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet article?')){document.getElementById('delete-{{$article->id}}').submit()}">
                            <i class="bi bi-trash px-1"></i>
                        </a>
                        <a href="{{route('articles.view',['id'=>$article->id])}}">
                            <i class="bi bi-eye"></i>
                        </a>

                        <form id="delete-{{$article->id}}" action="{{route('articles.destroy',['article'=>$article->id])}}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr> 
            @endforeach            
        </tbody>
    </table>
    {{$articles->links()}}
@endsection