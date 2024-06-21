<?php

if (!function_exists('setActive')) {
    function setActive(array $route): string
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return 'active';
                }
            }
        }
        return ''; // Return an empty string if no route matches
    }
}

if (!function_exists('checkDiscount')) {
    function checkDiscount($product): bool {
        $currentDate = date('Y-m-d');

        if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
            return true;
        }
        return false;
    }
}

function calculateDiscountPercent($originalPrice, $discountPrice): int
{
    $discountAmount = $originalPrice - $discountPrice;
    return ($discountAmount / $originalPrice) * 100;
}

function productType(string $type) : string
{
    return match ($type) {
        'new_arrival' => "New",
        'featured' => "Featured",
        'top_product' => "Top",
        'best_product' => "Best",
        default => ""
    };
}
/*Get total cart amount*/
function getCartTotal(){

}
