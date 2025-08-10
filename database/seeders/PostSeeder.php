<?php

use SigmaPHP\DB\Seeders\Seeder;

class PostSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Exploring the Universe',
                'summary' => 'A deep dive into the mysteries of space and time.',
                'body' => 'Space, the final frontier. This article delves into the wonders of the universe, from black holes to distant galaxies, and what they teach us about reality.',
                'user_id' => 1,
            ],
            [
                'title' => 'Getting Started with PHP',
                'summary' => 'A beginner-friendly guide to PHP programming.',
                'body' => 'PHP is a powerful scripting language widely used for web development. In this guide, we cover the basics to help you get up and running with PHP quickly.',
                'user_id' => 1,
            ],
            [
                'title' => 'Healthy Habits for Developers',
                'summary' => 'Tips on maintaining health while coding.',
                'body' => 'Long hours at the desk can take a toll on your health. Here are some simple habits every developer can adopt to stay healthy and productive.',
                'user_id' => 1,
            ],
            [
                'title' => 'The Future of Artificial Intelligence',
                'summary' => 'How AI is shaping our world.',
                'body' => 'Artificial Intelligence is evolving rapidly. This post explores its current impact and speculates on how it might change our lives in the coming years.',
                'user_id' => 1,
            ],
            [
                'title' => 'Traveling on a Budget',
                'summary' => 'Maximize your adventures without breaking the bank.',
                'body' => 'Travel does not have to be expensive. Learn how to plan affordable trips and enjoy rich experiences with minimal spending.',
                'user_id' => 1,
            ],
            [
                'title' => 'Mastering Remote Work',
                'summary' => 'Strategies for effective remote working.',
                'body' => 'Remote work is here to stay. Discover essential strategies and tools to remain productive and maintain a healthy work-life balance from anywhere.',
                'user_id' => 1,
            ],
        ];
        
        foreach ($posts as $post) {
            $this->insert('posts', [$post]);
        }
    }
}
