@extends('layouts.article')
@section('title','liste d\'articles')
@section('content')
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
                    <td>{{$article->publish}}</td>
                    <td>{{$article->created_at}}</td>
                    <td>{{'#'}}</td>
                </tr> 
            @endforeach            
        </tbody>
    </table>
@endsection