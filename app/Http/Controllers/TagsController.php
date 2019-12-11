<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
class TagsController extends Controller
{
    //

    public function adminTags(Request $request)
    {
        $q = $request->get('q');

        return Tag::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
