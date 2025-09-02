<?php

namespace App\Models;

class Review
{
    public static $list_review = [
        [
            'id' => 1,
            'produk_id' => 1,
            'user_id' => 1,
            'rating' => 4,
            'review' => 'Review 1'
        ],
        [
            'id' => 2,
            'produk_id' => 1,
            'user_id' => 2,
            'rating' => 3,
            'review' => 'Review 2'
        ]
    ];

    public static function all()
    {
        return self::$list_review;
    }

    public static function find($id)
    {
        foreach (self::$list_review as $review) {
            if ($review['id'] == $id) {
                return $review;
            }
        }

        return null;
    }
}
