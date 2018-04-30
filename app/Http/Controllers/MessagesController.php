<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Message; // 追加

class MessagesController extends Controller
{
    /**
     * getでmessages/にアクセスされた場合の「一覧表示処理」
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();

        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    /**
     * getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message = new Message;

        return view('messages.create', [
            'message' => $message,
        ]);
    }

    /**
     * postでmessages/にアクセスされた場合の「新規登録処理」
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',   // 追加
            'content' => 'required|max:255',
        ]);
        
        $message = new Message;
        $message->title = $request->title;    // 追加
        $message->content = $request->content;
        $message->save();

        return redirect('/');
    }

    /**
     * getでmessages/idにアクセスされた場合の「取得表示処理」
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);

        return view('messages.show', [
            'message' => $message,
        ]);
    }

    /**
     * getでmessages/id/editにアクセスされた場合の「更新画面表示処理」
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);

        return view('messages.edit', [
            'message' => $message,
        ]);
    }

    /**
     * putまたはpatchでmessages/idにアクセスされた場合の「更新処理」
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',   // 追加
            'content' => 'required|max:255',
        ]);

        $message = Message::find($id);
        $message->title = $request->title;    // 追加
        $message->content = $request->content;
        $message->save();

        return redirect('/');
    }

    /**
     * deleteでmessages/idにアクセスされた場合の「削除処理」
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect('/');
    }
}
