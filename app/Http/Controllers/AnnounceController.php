<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announce;

/**
 * @OA\Get(
 *   tags={"announce"},
 *   path="/api/announce",
 *   summary="announce",
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(
 *       allOf={
 *         @OA\Schema(
 *           @OA\Property(
 *             property="data",
 *             type="array",
 *             @OA\Items(
 *               ref="#/components/schemas/Announce",
 *             ),
 *           ),
 *         ),
 *       },
 *     ),
 *   ),
 * ),
 * @OA\Post(
 *   tags={"announce"},
 *   path="/api/announce",
 *   summary="announce",
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\MediaType(
 *       mediaType="application/json",
 *       @OA\Schema(
 *         @OA\Property(
 *           property="title",
 *           type="string",
 *           nullable=false,
 *         ),
 *         @OA\Property(
 *           property="content",
 *           type="string",
 *           nullable=false,
 *         ),
 *         required={"title", "content"},
 *       ),
 *     ),
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(
 *       ref="#/components/schemas/Announce",
 *     ),
 *   ),
 * )
 */

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["status" => true, "data" => Announce::paginate(15)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
        ]);

        $announce = Announce::create($request->all());
        return response()->json(["status" => true, "data" => $announce]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(["status" => true, "data" => Announce::findOrFail($id)]);
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
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
        ]);

        $announce = Announce::findOrFail($id);
        $announce->fill($request->all());
        $announce->save();
        return response()->json(["status" => true, "data" => $announce]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announce = Announce::findOrFail($id);
        $announce->delete();
        return response()->json(["status" => true]);
    }
}
