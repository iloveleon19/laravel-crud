<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announce;

/**
 * @OA\Get(
 *   tags={"announce"},
 *   path="/api/announce",
 *   summary="get all announce",
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(
 *       allOf={
 *         @OA\Schema(
 *           @OA\Property(
 *             property="status",
 *             type="boolean",
 *           ),
 *           @OA\Property(
 *             property="data",
 *             allOf={
 *               @OA\Schema(
 *                 ref="#/components/schemas/_paginate",
 *               ),
 *               @OA\Schema(
 *                 @OA\Property(
 *                   property="data",
 *                   type="array",
 *                   @OA\Items(
 *                     ref="#/components/schemas/Announce",
 *                   ),
 *                 ),
 *               ),
 *             },
 *           ),
 *         ),
 *       },
 *     ),
 *   ),
 * ),
 * @OA\GET(
 *   tags={"announce"},
 *   path="/api/announce/{id}",
 *   summary="get announce",
 *   @OA\Parameter(
 *     description="id",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(
 *       type="integer",
 *     ),
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(
 *       allOf={
 *         @OA\Schema(
 *           @OA\Property(
 *             property="status",
 *             type="boolean",
 *           ),
 *         ),
 *         @OA\Schema(
 *           @OA\Property(
 *             property="data",
 *             ref="#/components/schemas/Announce",
 *           ),
 *         ),
 *       },
 *     ),
 *   ),
 * ),
 * @OA\Post(
 *   tags={"announce"},
 *   path="/api/announce",
 *   summary="create announce",
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
 *       allOf={
 *         @OA\Schema(
 *           @OA\Property(
 *             property="status",
 *             type="boolean",
 *           ),
 *         ),
 *         @OA\Schema(
 *           @OA\Property(
 *             property="data",
 *             ref="#/components/schemas/Announce",
 *           ),
 *         ),
 *       },
 *     ),
 *   ),
 * ),
 * @OA\PUT(
 *   tags={"announce"},
 *   path="/api/announce/{id}",
 *   summary="edit announce",
 *   @OA\Parameter(
 *     description="id",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(
 *       type="integer",
 *     ),
 *   ),
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
 *       allOf={
 *         @OA\Schema(
 *           @OA\Property(
 *             property="status",
 *             type="boolean",
 *           ),
 *         ),
 *         @OA\Schema(
 *           @OA\Property(
 *             property="data",
 *             ref="#/components/schemas/Announce",
 *           ),
 *         ),
 *       },
 *     ),
 *   ),
 * ),
 * @OA\DELETE(
 *   tags={"announce"},
 *   path="/api/announce/{id}",
 *   summary="delete announce",
 *   @OA\Parameter(
 *     description="id",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(
 *       type="integer",
 *     ),
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(
 *       allOf={
 *         @OA\Schema(
 *           @OA\Property(
 *             property="status",
 *             type="boolean",
 *           ),
 *         ),
 *       },
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
