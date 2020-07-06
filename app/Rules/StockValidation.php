<?php

namespace App\Rules;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class StockValidation implements Rule
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  array  $products
     * @return bool
     */
    public function passes($attribute, $products)
    {
        try {
            foreach ($products as $product) {
                // TODO: Implement
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
