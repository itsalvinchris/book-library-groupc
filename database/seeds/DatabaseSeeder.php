<?php

use Illuminate\Database\Seeder;
/*
    Christopher Alvin
    30 May 2019
*/

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('asdasd'),
            ]
        );
        DB::table('users')->insert([
            [
                'nim' => '2101626683',
                'name' => 'Christopher Alvin',
                'email' => 'alvzz99@gmail.com',
                'password' => bcrypt('asdasd'),
            ],
            [
                'nim' => '2101628820',
                'name' => 'Aaron Christian Hansel',
                'email' => 'aaron.hansel99@yahoo.com',
                'password' => bcrypt('asdasd'),
            ],
            [
                'nim' => '2101632225',
                'name' => 'Hendy',
                'email' => 'stefanushendy69@gmail.com',
                'password' => bcrypt('asdasd'),
            ],
            [
                'nim' => '2101639925',
                'name' => 'Ignatius Ryan Yonata',
                'email' => 'iry@binus.ac.id',
                'password' => bcrypt('asdasd'),
            ],
            [
                'nim' => '2101626626',
                'name' => 'Jonathan Sebastian',
                'email' => 'jsp@binus.ac.id',
                'password' => bcrypt('asdasd'),
            ],
            [
                'nim' => '1234567890',
                'name' => 'Test Account',
                'email' => 'asd@asd.com',
                'password' => bcrypt('asdasd'),
            ],
        ]);

        factory(App\Book::class,500)->create();
            //$table->integer('user_id')->unsigned();
            // $table->integer('book_id')->unsigned();
            // $table->string('date_borrowed');
            // $table->string('date_due');
            // $table->string('returned');
            // $table->string('date_returned');
        for($i = 1; $i<=6;$i++){
            DB::table('borrowed_books')->insert([
                [
                    'user_id' => $i,
                    'book_id' => 1 + (8* ($i -1)),
                    'date_borrowed' => '2019-05-26',
                    'date_due' => '2019-06-02',
                    'returned' => '1',
                    'date_returned' => '2019-05-29',
                ],
            ]);
            DB::table('borrowed_books')->insert([
                [
                    'user_id' => $i,
                    'book_id' => 2 + (8* ($i -1)),
                    'date_borrowed' => '2019-05-20',
                    'date_due' => '2019-05-27',
                    'returned' => '1',
                    'date_returned' => '2019-05-26',
                ],
            ]);
            DB::table('borrowed_books')->insert([
                [
                    'user_id' => $i,
                    'book_id' => 3 + (8* ($i -1)),
                    'date_borrowed' => '2019-06-04',
                    'date_due' => '2019-06-11',
                    'returned' => '0',
                    'date_returned' => 'asd',
                ],
            ]);
            DB::table('borrowed_books')->insert([
                [
                    'user_id' => $i,
                    'book_id' => 4 + (8* ($i -1)),
                    'date_borrowed' => '2019-05-23',
                    'date_due' => '2019-05-30',
                    'returned' => '0',
                    'date_returned' => 'asd',
                ],
            ]);
            DB::table('borrowed_books')->insert([
                [
                    'user_id' => $i,
                    'book_id' => 5 + (8* ($i -1)),
                    'date_borrowed' => 'asd',
                    'date_due' => '2019-06-01',
                    'returned' => '-1',
                    'date_returned' => 'asd',
                ],
            ]);
            DB::table('borrowed_books')->insert([
                [
                    'user_id' => $i,
                    'book_id' => 6 + (8* ($i -1)),
                    'date_borrowed' => 'asd',
                    'date_due' => '2019-06-01',
                    'returned' => '-1',
                    'date_returned' => 'asd',
                ],
            ]);
            DB::table('borrowed_books')->insert([
                [
                    'user_id' => $i,
                    'book_id' => 7 + (8* ($i -1)),
                    'date_borrowed' => 'asd',
                    'date_due' => '2019-06-01',
                    'returned' => '-2',
                    'date_returned' => 'asd',
                ],
            ]);
            DB::table('borrowed_books')->insert([
                [
                    'user_id' => $i,
                    'book_id' => 8 + (8* ($i -1)),
                    'date_borrowed' => 'asd',
                    'date_due' => '2019-06-01',
                    'returned' => '-2',
                    'date_returned' => 'asd',
                ],
            ]);
        }

        DB::table('videos')->insert([
            [
                'title' => 'Mars Binusian',
                'description' => 'Mars Binusian',
                'video' => 'video/Mars Binusian - YouTube.mp4',
                'thumbnail' => 'video_thumbnail/Mars Binusian - YouTube.png'
            ],
            [
                'title' => 'Himne Perguruan Tinggi Bina Nusantara',
                'description' => 'Himne Perguruan Tinggi Bina Nusantara',
                'video' => 'video/Himne Perguruan Tinggi Binus - YouTube.mp4',
                'thumbnail' => 'video_thumbnail/Himne Perguruan Tinggi Binus - Youtube.png'
            ],
            [
                'title' => 'BNCC Hackathon 2018  Code Your Future',
                'description' => 'BNCC Hackathon 2018  Code Your Future',
                'video' => 'video/BNCC Hackathon 2018  Code Your Future - YouTube.mp4',
                'thumbnail' => 'video_thumbnail/BNCC Hackathon 2018  Code Your Future - YouTube.png'
            ],
            [
                'title' => 'BNCC Opening Season 2018 (Kemanggisan)',
                'description' => 'BNCC Opening Season 2018 (Kemanggisan)',
                'video' => 'video/BNCC Opening Season 2018 (Kemanggisan) - YouTube.mp4',
                'thumbnail' => 'video_thumbnail/BNCC Opening Season 2018 (Kemanggisan) - YouTube.png'
            ],
            [
                'title' => 'BNCC Meetup 2019 How to Attract Millennials Talent Highlight',
                'description' => 'BNCC Meetup 2019 How to Attract Millennials Talent Highlight',
                'video' => 'video/BNCC Meetup 2019 How to Attract Millennials Talent Highlight - YouTube.mp4',
                'thumbnail' => 'video_thumbnail/BNCC Meetup 2019 How to Attract Millennials Talent Highlight - YouTube.png'
            ],
        ]);
    }
}
