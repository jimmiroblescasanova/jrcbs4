<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $count = Company::count();
        $rand = rand(1, $count);

        return [
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
            'phone' => $this->faker->numerify('##########'),
            'email' => $this->faker->safeEmail(),
            'company_id' => (Company::where('id', $rand)->first() == null) ? null : $rand,
        ];
    }
}
