<?php

namespace Database\Factories;

use App\Models\Author;
use GuzzleHttp\Client;
use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Alirezasedghi\LaravelImageFaker\Services\FakePeople;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //composer require guzzlehttp/guzzle
        $client = new Client();
        $response = $client->get('https://randomuser.me/api/');
        $data = json_decode($response->getBody()->getContents(), true);

        $imageUrl = $data['results'][0]['picture']['large'];

        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            //'image' => 'https://picsum.photos/400/400',
            //1.installato picsum provider : composer require --dev smknstd/fakerphp-picsum-images
            //2. generato un nuovo provider : php artisan make:provider FakerServiceProvider
            //3. aggiunto in app.php : App\Providers\FakerServiceProvider::class,
            // 'image' => $this->faker->imageUrl(640, 480, mt_rand(0, 1084), true, 'people'),
            'image' => $imageUrl,
            'nationality' => $this->faker->country,
            'year_born' => $this->faker->numberBetween(1700, 2000),
            'year_die' => $this->faker->optional(0.7, null)->numberBetween(1800, 2023),
        ];
    }
}
