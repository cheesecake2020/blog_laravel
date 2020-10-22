<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    //ブログ一覧を表示する
    public function showList()
    {
        //ブログの全データの呼び出し
        $blogs = Blog::all();

        //dd($staff);
        return view('blog.list', ['blogs' => $blogs]);
    }

    //詳細画面を表示する
    public function showDetail(Request $request, $id)
    {
        /**
         * @param  Request  $request
         * @param  int  $id
         * @return view
         */
        $blog = Blog::find($id);
        if (is_null($blog)) {
            $request->session()->flash('err_msg', '※データがありません');
            return redirect(route('blogs'));
        }
        return view('blog.detail', ['blog' => $blog]);
    }

    //登録画面を表示する
    public function showCreate()
    {
        /**
         * @return view
         */
        return view('blog.form');
    }

    //ブログを登録する
    public function exeStore(BlogRequest $request)
    {
        /**
         * @return view
         * エラーがあったら登録しない
         */
        DB::connection()->beginTransaction();
        try {
            if ($file = $request->imgpath) {
                $fileName = time() . $file->getClientOriginalName();
                $target_path = public_path('uploads/');
                $file->move($target_path, $fileName);
            } else {
                $fileName = "";
            }

            $blog = new Blog;
            $blog->title = $request->input('title');
            $blog->content = $request->input('content');
            $blog->imgpath = $fileName;
            $blog->save();
            DB::connection()->commit();
        } catch (\Throwable $e) {
            //エラーが発生したら例外をなげる
            DB::connection()->rollBack();
            abort(500);
        }
        $request->session()->flash('err_msg', 'ブログを登録しました。');
        return redirect('/');
    }


    //ブログ編集フォームを表示する
    public function showEdit(Request $request, $id)
    {
        /**
         * @param  Request  $request
         * @param  int  $id
         * @return Response
         */
        $blog = Blog::find($id);
        if (is_null($blog)) {
            $request->session()->flash('err_msg', '※データがありません');
            return redirect('blogs');
        }
       
        return view('blog.edit', ['blog' => $blog]);
    }

    //ブログを更新する
    public function exeUpdate(BlogRequest $request)
    {
        /**
         *エラーがあったら登録しない
         * @param  Request  $request
         * @param  int  $id
         * @return Response
         * @return view
         */
        //dd($inputs);
        DB::connection()->beginTransaction();
        try {
            // リクエストデータ受取
            $inputs = $request->all();
            // 対象レコード取得
            $blog = Blog::find($inputs['id']);
            //画像があったら保存
            if ($file = $inputs['new_img']) {
                //保存するファイルに名前をつける  
                $fileName = time() . $file->getClientOriginalName();
                //Laravel直下のpublicディレクトリに新フォルダをつくり保存する
                $target_path = public_path('uploads/');
                $file->move($target_path, $fileName);
                // 写真削除情報取得
                $deletename = public_path('uploads/'.$inputs['old_img']);
                Storage::delete($deletename);
            } else {
                $fileName = "";
            }
            $blog->fill([
                'title' => $inputs['title'],
                'content'=>$inputs['content'],
                'imgpath'=>$fileName
                ])->save();
            DB::connection()->commit();
        } catch (\Throwable $e) {
            DB::connection()->rollBack();
            abort(500);
        }
        $request->session()->flash('err_msg', 'ブログを更新しました。');
        return redirect('/');
    }
 //ブログ削除
 public function exeDelete(Request $request, $id)
 {
     /**
      *
      * @param  Request  $request
      * @param  int  $id
      * @return Response
      */
     if (empty($id)) {
         $request->session()->flash('err_msg', '※データがありません');
         return redirect('/');
     }
     $blog = Blog::find($id);
    //  dd($blog['imgpath']);
     //例外
     try{
         $blog = Blog::destroy($id);
         if(!empty($blog['imgpath'])){
             // 写真削除情報取得
             $deletename = public_path('uploads/'.$blog['imgpath']);
             Storage::delete($deletename);

         }
         
     }catch(\Throwable $e){
         abort(500);
     }
    
     $request->session()->flash('err_msg', 'ブログを削除しました。');
     return redirect('/');
 }


    }
    

    