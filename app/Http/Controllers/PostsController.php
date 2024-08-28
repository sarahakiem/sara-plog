<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index(){
        dd(session('test'));
        $posts = Post::paginate(12);
        return view('pages.index',compact('posts'));
    }

    /////////////////add new post////////////
    public function add(){
        session()->put('test','First Laravel session');

        return view('pages.add');
    }
    public function store(Request $Request){
        //dd($Request->all());
        $Request->validate([
            'name'=>'required|string|max:10',
            'content'=>'required|string|max:20',
            'image'=>'required|image|mimes:png,jpg,jpeg,gif'
        ]);
        $file=$Request->file('image');
        $exten=$file->getClientOriginalExtension();
        $newName=uniqid('',true).'.'.$exten;
        $destinationPath='images';
        $file->move($destinationPath,$newName);

        $data=new Post();
        $data->name=$Request->name;
        $data->content=$Request->content;
        $data->image=$newName;
        $data->save();
        session()->flash("flash_message","post added sussesfuly");
        //return back();
        return view('pages.index');

    }
    public function edit(string $id){
        $post=Post::findOrfail($id);
        return view('pages.edit',['post'=>$post]);
        //return view('pages.edit')->with('post',$post);
    }
    public function update(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255', 
        'content' => 'required|string|max:2000', 
        'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048' 
    ]);

    
    $post = Post::findOrFail($request->id);

    // Update the post's name and content
    $post->name = $request->name;
    $post->content = $request->content;

    
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $newName = uniqid('', true) . '.' . $extension;
        $destinationPath = public_path('images');
        $file->move($destinationPath, $newName);

        
        $post->image = $newName;
    }

    
    $post->save();

    
    session()->flash('flash_message', 'Post updated successfully');
    return back();
}
public function contact(){
    return view('contact');
}
public function sendContact(Request $request)
    {
        $mails = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to('hello@example.com')->send(new ContactUsMail($mails));

        return ('sent successfully');
    }
        
        
        
       

}
