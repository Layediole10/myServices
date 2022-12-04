<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedNotification;
use App\Models\Like;

// use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        $article = Article::all();

        return view('admin.user.userList', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.userForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => 'required|string',
            'role' => ['required', 'string'],
        ]);

        $register = $validate;
        $pass = Str::random(8);
        $register['pass']=$pass;
        $register['name'] = $request->name;
        $register['email'] = $request->email;
        $register['password'] = Hash::make($pass);
        $register['contact'] = $request->contact;
        $register['role'] = $request->role;

        // dd($register);
        $newUser = User::create($register);
        if ($newUser) {
            Mail::to($newUser->email)->send(new UserCreatedNotification($register));
           return  redirect()->route('users.index')->with(["status"=>"$newUser->name Added successfully"]);
        }else{
            return back()->with("errorRegister","Failed to create the Article")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showArticle($id)
    {
        $article = Article::findOrFail($id);
        $comments = Comment::where('article_id', $id)->get();
        return view('userService.userCommentArticle', [
            'article' => $article,
            'comments' => $comments
        ]); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return  view('admin.user.userEdited', ['user'=>$user]);
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
        if (Auth::user()->id == $id) {
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
                return redirect('/home')->with('compteUpdate', 'Votre compte a été bien mis à jour!');
            
             }else{
                 return back()->with("errorRegister","registration failed")->withInput();
                }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $articles = Article::all()->where('author_id', $user->id);
    //    dd($articles);
       foreach($articles as $article){
            if ($article->has('images')) {
                Image::where('article_id', $article->id)->delete();
            }  
       }
        Article::where('author_id', $user->id)->delete();
        // Comment::where('author_id', $user->id)->delete();
        // Like::where('author_id', $user->id)->delete();
        $user->delete();
        return back()->with('delete', "L'utilisateur n° $user->id a été supprimé avec succès!");
    }

    public function view($id){
        
    }


    public function search(){
        $search = request()->input('q');
        $results = User::where('name', 'like', "%$search%")->orwhere('email', 'like', "%$search%")->orwhere('role', 'like', "%$search%")->orwhere('contact', 'like', "%$search%")->paginate(5);
        return view('admin.user.searchUser', ['results'=>$results]);
    }



}
