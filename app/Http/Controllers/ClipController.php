<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClipRequest;

use App\Clip;
use App\Tag;
use App\User;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Facades\Auth;

class ClipController extends Controller
{
    // 認可（ポリシーの設定）
    public function __construct()
    {
        $this->authorizeResource('App\Clip', 'clip');
    }


    // クリップ一覧
    public function index()
    {
        $clips = Clip::with(['likes', 'user', 'tags'])->orderBy('created_at', 'desc')->paginate(8);
        return view('clips.index', ['clips' => $clips]);


        // サムネイル取得
        // $listResponse = $youtube->videos->listVideos('snippet', ['id' => $video_id]);
        // $video_items = $listResponse[0];
        // $video_snippet = $video_items['snippet'];
        // $thumnail = $video_snippet['thumbnails']['maxres'] -> url;
    }
    // クリップいいね順
    public function indexLikes()
    {
        $clips = Clip::with(['user', 'likes','tags'])->withCount('likes')->orderBy('likes_count', 'desc')->paginate(8);
        return view('clips.index_likes', ['clips' => $clips]);
    }
    // 自分のクリップ
    public function myClip(Request $request) {
        $user = $request->user();
        $user->load(['clips.likes','clips.tags','clips.user']);
        $clips = $user->clips()->orderBy('created_at','desc')->paginate(8);
        return view('clips.index_myclips',['user' => $user,'clips'=>$clips]);
    }
    // フォローしているユーザーのクリップ
    public function followClips(Request $request) {
        $clips = Clip::query()
        ->with(['user', 'likes', 'tags'])
        ->whereIn('user_id',$request->user()->follows()
        ->pluck('follower_id'))->orderBy('created_at','desc')->paginate(8);

        return view('clips.index_follow_clips',['clips'=>$clips]);
    }


    // クリップ作成フォーム
    public function create()
    {
        return view('clips.create_form');
    }
    // クリップ作成 リダイレクト
    public function store(ClipRequest $request, Clip $clip)
    {
        $clip->fill($request->all());
        $clip->user_id = $request->user()->id;

        // ユーザーが入力したビデオIDの取得
        $video_id = $request->video_id;

        // YOUTUBE URLも対応 {文字列変換}
        if (strstr($video_id, 'v=')) {
            $video_id = strstr($video_id, 'v=');
            $video_id = str_replace('v=', '', $video_id);
            if (strstr($video_id, '&t=')) {
                $video_id = strstr($video_id, '&t=', TRUE);
            }
        }
        // レコードにVideo_IDを保存挿入
        $clip->video_id = $video_id;

        // dd($video_id);

        // YOUTUBE接続
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        $youtube = new Google_Service_YouTube($client);

        // 動画埋め込みHTMLを取得 存在しないIDだったら "" 空文字
        $listResponse = $youtube->videos->listVideos('player', ['id' => $video_id]);
        if (!isset($listResponse[0])) {
            $clip->video_html = '';
        } else {
            $video_items = $listResponse[0];
            $clip->video_html = $video_items->player['embedHtml'];
        }

        // レコードを保存
        $clip->save();

        // タグの登録
        $request->tags->each(function ($item) use ($clip) {
            $tag = Tag::firstOrCreate(['name' => $item]);
            $clip->tags()->attach($tag);
        });

        // リダイレクト
        return redirect()->route('clips.index');
    }

    // クリップ詳細
    public function show(Clip $clip)
    {
        return view('clips.show', ['clip' => $clip]);
    }

    // クリップ編集フォーム
    public function edit(Clip $clip)
    {
        $tagNames = $clip->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        return view('clips.edit_form', ['clip' => $clip, 'tagNames' => $tagNames]);
    }
    // クリップ編集 リダイレクト
    public function update(ClipRequest $request, Clip $clip)
    {
        $clip->fill($request->all())->save();
        $clip->tags()->detach();
        $request->tags->each(function ($item) use ($clip) {
            $tag = Tag::firstOrCreate(['name' => $item]);
            $clip->tags()->attach($tag);
        });

        return redirect()->route('clips.index');
    }

    // クリップ削除 リダイレクト
    public function destroy(Clip $clip)
    {
        $clip->delete();
        return redirect()->route('clips.index');
    }

    // いいね！
    public function like(Request $request, Clip $clip)
    {
        $clip->likes()->detach($request->user()->id);
        $clip->likes()->attach($request->user()->id);

        return ['countLikes' => $clip->likes_count];
    }

    // いいね解除
    public function unlike(Request $request, Clip $clip)
    {
        $clip->likes()->detach($request->user()->id);

        return ['countLikes' => $clip->likes_count];
    }
}
