<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Topic;
use App\Models\SubTopic;

use Illuminate\Support\Facades\DB;

class SubTopicController extends Controller
{
    public function index()
    {
       return SubTopic::orderBy('pos', 'ASC')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'pos' => 'required|integer',
            'topic' => 'required|integer'
        ]);

        $topic = Topic::where('id', '=', $data["topic"]);
        if($topic == null) {
            return response([
                "message" => "Tópico não existe"
            ]);
        }

        $subtopic = SubTopic::create([
            "title" => $data["title"],
            "pos" => $data["pos"],
            "topic" => $data["topic"]
        ]);

        return response([
            "subtopic" => $data,
            "message" => "Subtópico criado com sucesso"
        ]);
    }

    public function show($id)
    {
        return SubTopic::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        if(SubTopic::where('id', $id)->exists()) {
            $subtopic = SubTopic::find($id);
            $subtopic->title = is_null($request->title) ? $subtopic->title : $request->title;
            $subtopic->pos = is_null($request->pos) ? $subtopic->pos : $request->pos;
            $subtopic->topic = is_null($request->topic) ? $subtopic->topic : $request->topic;
            $subtopic->save();

            return response([
                "subtopic" => $subtopic,
                "message" => "Subtópico atualizado com sucesso"
            ], 200);
        } else {
            return response()->json([
                "message" => "Subtópico não encontrado"
            ], 404);
        }
    }

    public function destroy($id)
    {
        if(SubTopic::where('id', $id)->exists()) {
            $subtopic = SubTopic::find($id);
            $subtopic->delete();

            return response()->json([
                "message" => "Subtópico removido com sucesso"
            ], 202);
            } else {
            return response()->json([
                "message" => "Subtópico não encontrado"
            ], 404);
        }
    }
}
