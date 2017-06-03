<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'avatar' => $faker->imageUrl(256, 256),
        'phone' => $faker->unique()->phoneNumber(11),
        'statusid' => $faker->randomDigit(1, 5),
        'uid' => str_random(18),
    ];
});

//$factory->define(App\Hostpital::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'title' => $faker->name,
//        'description' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//
//        $table->string('title');
//    $table->string('description');
//    $table->string('domain');
//    $table->string('token');
//    $table->string('level');
//    $table->boolean('top');
//    $table->integer('category_id')->references('id')->on('categories')->onDelete('cascade');
//    $table->integer('area_id')->references('id')->on('area')->onDelete('cascade');
//    $table->integer('contact_id')->references('id')->on('contact')->onDelete('cascade');
//    $table->tinyInteger('published')->references('id')->on('article_statuses');
//    $table->date('publish_date');
//    $table->date('close_date');
//    $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
//    $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
//    $table->integer('updated_by')->references('id')->on('users')->onDelete('cascade');
//    $table->integer('created_by')->references('id')->on('users')->onDelete('cascade');
//    ];
//});

$factory->define(App\Diary::class, function (Faker\Generator $faker) {
    $userIDs = \App\User::pluck('id')->toArray();

    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence(3, 1),
        'images' => $faker->biasedNumberBetween(0, 5),
        'content' => $faker->paragraph(5, true),
        'avatar' => $faker->imageUrl(260,260),
        'hospital_id' => $faker->randomDigit(1, 500),
        'in_hospital' => $faker->boolean(50),
        'medicine_id' => $faker->randomDigit(1, 500),
        'disease_id' => $faker->randomDigit(1, 500),
        'checked_count' => $faker->randomDigit(1, 10),
        'medicine_count' => $faker->randomDigit(1, 8),
        'top' => $faker->boolean(5),
        'category_id' => $faker->randomDigit(1, 8),
        'type_id' => $faker->randomDigit(1, 5),
        'published' => $faker->boolean(70),
        'publish_date' => $faker->date(),
//        'close_date' => $faker->paragraph,
        'comments' => $faker->randomDigit(0, 500),
        'approved' => $faker->randomDigit(0, 500),
//        'created_at' => $faker->biasedNumberBetween(0, 5),
//        'updated_at' => $faker->paragraph,
        'updated_by' => $faker->randomElement($userIDs),
        'created_by' => $faker->randomElement($userIDs),

    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $userIDs = \App\User::pluck('id')->toArray();
    $diaryIDs = \App\Diary::pluck('id')->toArray();

    return [
        'content' => $faker->paragraph(5, true),
        'diary_id' => $faker->randomElement($diaryIDs),
        'published' => $faker-> boolean(90),
        'approved' => $faker->randomDigit(0, 500),
        'approved' => $faker->randomDigit(0, 500),
        'updated_by' => $faker->randomElement($userIDs),
        'created_by' => $faker->randomElement($userIDs),
    ];
});