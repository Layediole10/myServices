<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Article, Comment, Demande, Like, User};

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * admin home
     */
    public function index()
    {
        return view('admin.dashbord');
    }
    public function actualityAdmin(){

        $requests = Demande::orderBy('created_at', 'DESC')->simplePaginate(1);
        $articles = Article::orderBy('created_at', 'DESC')->get();
        $comments = Comment::all();
        // dd($requests);
        return view('admin.homeAdmin', [
            'requests'=>$requests,
            'articles'=>$articles,
            'comments'=>$comments,
        ]);
        
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $valid = $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string',
            
        ]);

        $article = $valid;
        $article['category_id'] = $request->category;
        $article['region'] = $request->region;
        $article['department'] = $request->department;
        $article['municipality'] = $request->municipality;
        $article['district'] = $request->district;
        $article['publish'] = $request->publish?true:false;
        $article['author_id'] = Auth::user()->id;
        $article['occupation'] = $request->occupation;
        $article['contact'] = $request->contact;
       
        $newArticle = Article::create($article);
        // dd($newArticle);
        if ($request->has('images')) {
            foreach($request->file('images')as $image){
                $imageName = 'image-'.time().rand(1,1000).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('articleImages'),$imageName);

                Image::create([
                    'article_id'=>$newArticle->id,
                    'image'=>$imageName
                ]);
            }
        }
        
        return redirect('/admin/articles')->with('articleConfirm', 'article crée avec succès!');  

    }

    public function liker(){

        $articles = Article::find(request()->id);
        if ($articles->isLikedByUser()) {
           $result = Like::where([
                'user_id' => auth()->user()->id,
                'article_id' => request()->id
            ])->delete();
            if ($result) {
                return response()->json([
                    'count' => Article::find(request()->id)->likes->count(),

                ]);
            }
        }else{
           
            $like = new Like();

            $like->user_id = auth()->user()->id;
            $like->article_id = request()->id;

            $like->save();
            return response()->json([
                'count' => Article::find(request()->id)->likes->count(),

            ]);
        }
    }

    public function contact($id){
        
        $article = Article::find($id);
        return view('admin.contactAdmin', ['article'=> $article]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return  view('admin.adminEdited', ['user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        // if (Auth::user()->id == $id) {
            $user = User::find($id);
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255' ],       
                'contact' => 'required|string',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            ]);

            // dd($path);
            $register = $validate;
            $register['name'] = $request->name;
            $register['email'] = $request->email;            
            $register['contact'] = $request->contact;
            
            
            if ($request->file('photo')) {
                $photo = $request->file('photo');
                $photoName = time().'.'.$photo->getClientOriginalExtension();
                $photo->move(public_path('profile'), $photoName);
                $path = '/profile/'.$photoName;
                $register['photo'] = $path;
            }
    
            $user->update($register);
        
            if ($user) {
                return redirect('/admin')->with('compteUpdate', 'Votre compte a été bien mis à jour!');
            
             }else{
                 return back()->with("errorRegister","registration failed")->withInput();
                }
        }

        public function show($id)
    {
        $article = Article::findOrFail($id);
        $comments = Comment::where('article_id', $id)->get();
        return view('admin.adminCommentArticle', [
            'article' => $article,
            'comments' => $comments
        ]); 
        
    }
    
}
