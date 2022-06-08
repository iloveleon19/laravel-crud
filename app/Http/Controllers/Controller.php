<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="L5 OpenApi",
 *   description="L5 Swagger OpenApi description",
 *   @OA\Contact(
 *     email="xebermen@gmail.com",
 *   ),
 *   @OA\License(
 *     name="Apache 2.0",
 *     url="http://www.apache.org/licenses/LICENSE-2.0.html",
 *   ),
 * )
 *  @OA\Server(
 *      description="dev",
 *      url=""
 *  ),
 *  @OA\PathItem(
 *    path="/api",
 *  ),
 *  @OA\Schema(
 *   schema="_paginate",
 *   title="_paginate",
 *   description="_paginate",
 *   @OA\Property(
 *     property="current_page",
 *     type="integer",
 *   ),
 *   @OA\Property(
 *     property="first_page_url",
 *     type="string",
 *     format="uri",
 *   ),
 *   @OA\Property(
 *     property="from",
 *     type="integer",
 *     nullable=true
 *   ),
 *   @OA\Property(
 *     property="last_page",
 *     type="integer",
 *   ),
 *   @OA\Property(
 *     property="last_page_url",
 *     type="string",
 *     format="uri",
 *   ),
 *   @OA\Property(
 *     property="links",
 *     type="array",
 *     @OA\Items(
 *       type="object",
 *       @OA\Property(
 *         property="url",
 *         type="string",
 *         format="uri",
 *         nullable=true,
 *       ),
 *       @OA\Property(
 *         property="label",
 *         type="string",
 *       ),
 *       @OA\Property(
 *         property="active",
 *         type="boolean",
 *         default=false,
 *       ),
 *     ),
 *   ),
 *   @OA\Property(
 *     property="next_page_url",
 *     type="string",
 *     format="uri",
 *     nullable=true,
 *   ),
 *   @OA\Property(
 *     property="path",
 *     type="string",
 *     format="uri",
 *   ),
 *   @OA\Property(
 *     property="pre_page",
 *     type="integer",
 *     default=15,
 *   ),
 *   @OA\Property(
 *     property="prev_page_url",
 *     type="string",
 *     format="uri",
 *     nullable=true,
 *   ),
 *   @OA\Property(
 *     property="to",
 *     type="integer",
 *     nullable=true,
 *   ),
 *   @OA\Property(
 *     property="total",
 *     type="integer",
 *   ),
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
