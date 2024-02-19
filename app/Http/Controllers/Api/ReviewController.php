<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // ricordarsi di passare anche il doctors_id
    /**
     * {account_id}
     * {name}
     * {title}
     * {email}
     * {content}
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //$review = new Review();
        //$review->fill($data);
        //$review->save();
        $review = Review::create($data);
    }
}
