<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Topic;
use App\Models\SubTopic;

use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::orderBy('pos', 'ASC')->get();
        foreach($topics as $id => $topic) {
            $subtopics = DB::select('SELECT title, pos FROM sub_topics WHERE topic = ' . ($id + 1));
            $topic["subtopics"] = $subtopics;
        }
        return response($topics, 201);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'pos' => 'required|integer'
        ]);

        $topic = Topic::create([
            "title" => $data["title"],
            "pos" => $data["pos"]
        ]);

        return response([
            "topic" => $data,
            "message" => "Tópico criado com sucesso"
        ]);
    }

    public function show($id)
    {
       $topic = Topic::findOrFail($id);
       $topic["subtopics"] = DB::select('SELECT title, pos FROM sub_topics WHERE topic = ' . $id);
       return response($topic, 201);
    }

    public function update(Request $request, $id)
    {
        if(Topic::where('id', $id)->exists()) {
            $topic = Topic::find($id);
            $topic->title = is_null($request->title) ? $topic->title : $request->title;
            $topic->pos = is_null($request->pos) ? $topic->pos : $request->pos;
            $topic->save();

            return response([
                "topic" => $topic,
                "message" => "Tópico atualizado com sucesso"
            ], 200);
        } else {
            return response()->json([
                "message" => "Tópico não encontrado"
            ], 404);
        }
    }

    public function destroy($id)
    {
        if(Topic::where('id', $id)->exists()) {
            $topic = Topic::find($id);
            $topic->delete();

            return response()->json([
                "message" => "Tópico removido com sucesso"
            ], 202);
            } else {
            return response()->json([
                "message" => "Tópico não encontrado"
            ], 404);
        }
    }
}
