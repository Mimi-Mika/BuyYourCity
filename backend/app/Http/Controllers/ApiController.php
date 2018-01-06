<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers
 *
 * @SWG\Swagger(
 *     basePath="",
 *     host="localhost:8000",
 *     schemes={"http"},
 *     @SWG\SecurityScheme(
 *         securityDefinition="bearerAuth",
 *         type="apiKey",
 *         name="Authorization",
 *         in="header",
 *     ),
 *     @SWG\Info(
 *         version="1.0",
 *         title="BYC API",
 *         @SWG\Contact(name="YeuDeLynX", url="http://fr.lmgtfy.com/?q=buy+your+city"),
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */

class ApiController extends Controller
{
    //
}
