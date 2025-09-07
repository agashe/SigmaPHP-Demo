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
                'body' => "Space, the final frontier. This article delves into the wonders of the universe, from black holes to distant galaxies, and what they teach us about reality.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Getting Started with PHP',
                'summary' => 'A beginner-friendly guide to PHP programming.',
                'body' => "PHP is a powerful scripting language widely used for web development. In this guide, we cover the basics to help you get up and running with PHP quickly.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Healthy Habits for Developers',
                'summary' => 'Tips on maintaining health while coding.',
                'body' => "Long hours at the desk can take a toll on your health. Here are some simple habits every developer can adopt to stay healthy and productive.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'The Future of Artificial Intelligence',
                'summary' => 'How AI is shaping our world.',
                'body' => "Artificial Intelligence is evolving rapidly. This post explores its current impact and speculates on how it might change our lives in the coming years.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Traveling on a Budget',
                'summary' => 'Maximize your adventures without breaking the bank.',
                'body' => "Travel does not have to be expensive. Learn how to plan affordable trips and enjoy rich experiences with minimal spending.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Mastering Remote Work',
                'summary' => 'Strategies for effective remote working.',
                'body' => "Remote work is here to stay. Discover essential strategies and tools to remain productive and maintain a healthy work-life balance from anywhere.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'The Art of Minimalist Living',
                'summary' => 'Simple steps to a more mindful and clutter-free life.',
                'body' => "Minimalism isn\'\'t about having nothing; it\'\'s about making room for what truly matters. This article offers practical tips on decluttering your home and your mind.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Understanding Cryptocurrencies',
                'summary' => 'A basic guide to Bitcoin, Ethereum, and beyond.',
                'body' => "The world of digital currency can be confusing. This guide breaks down the core concepts of cryptocurrencies, blockchain technology, and how they work.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Beginner\'\'s Guide to Photography',
                'summary' => 'Capture stunning photos with your camera or phone.',
                'body' => "You don\'\'t need expensive gear to take great pictures. Learn the fundamentals of composition, lighting, and editing to elevate your photography skills.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'The Psychology of Productivity',
                'summary' => 'How to hack your brain for better focus and output.',
                'body' => "Productivity is more than just managing time. This article explores the psychological principles behind focus, motivation, and getting more done in less time.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Gardening for Urban Dwellers',
                'summary' => 'Grow your own food, even in a small space.',
                'body' => "Think you need a big yard to garden? Think again. This guide provides creative solutions for growing fresh herbs and vegetables on balconies, windowsills, and rooftops.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Cybersecurity Essentials for Everyone',
                'summary' => 'Protect yourself and your data in a digital world.',
                'body' => "From strong passwords to phishing awareness, this article outlines the essential steps everyone should take to secure their personal information online.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'The Rise of Electric Vehicles',
                'summary' => 'Exploring the future of transportation.',
                'body' => "Electric vehicles are more than just a trend. This post examines the technology, environmental impact, and economic factors driving the shift to EVs.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Mindfulness Meditation for Stress Relief',
                'summary' => 'Simple techniques to calm your mind.',
                'body' => "In a fast-paced world, finding a moment of calm can be a challenge. Learn basic mindfulness meditation techniques to reduce stress and improve mental clarity.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Cooking with Seasonal Ingredients',
                'summary' => 'Elevate your meals with fresh, local produce.',
                'body' => "Using ingredients that are in season not only makes your food taste better but is also more sustainable. Discover recipes and tips for cooking with what\'\'s fresh.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'A Guide to Financial Planning',
                'summary' => 'Building a solid foundation for your financial future.',
                'body' => "From creating a budget to investing for retirement, this article covers the fundamental steps you can take to manage your money wisely and achieve your financial goals.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Home Fitness: No Gym Required',
                'summary' => 'Effective workouts you can do from your living room.',
                'body' => "Staying active is important, and you don\'\'t need a gym membership to do it. This guide provides workout routines and tips for staying fit at home.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Understanding the Basics of HTML and CSS',
                'summary' => 'Your first steps into web development.',
                'body' => "HTML and CSS are the building blocks of the web. This article explains the core concepts and syntax of these languages to help you create your first webpage.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'The Power of Storytelling in Marketing',
                'summary' => 'How to connect with your audience through narrative.',
                'body' => "In a crowded market, a good story can make all the difference. This post explores how businesses can use storytelling to build brand loyalty and engage customers.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Exploring the World of Craft Beer',
                'summary' => 'A connoisseur\'\'s guide to a global phenomenon.',
                'body' => "From IPAs to stouts, the world of craft beer is diverse and delicious. This article explores different beer styles, brewing techniques, and how to start your own tasting journey.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'The Benefits of Learning a New Language',
                'summary' => 'Beyond travel: how language learning improves your brain.',
                'body' => "Learning a new language is more than just a skill for your next vacation. This article delves into the cognitive benefits, from improved memory to enhanced problem-solving skills.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Sustainable Living: A Practical Guide',
                'summary' => 'Small changes for a big environmental impact.',
                'body' => "Making your lifestyle more sustainable doesn\'\'t have to be overwhelming. This guide offers simple, actionable tips for reducing your carbon footprint, from recycling to reducing waste.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Demystifying Home Renovation',
                'summary' => 'Tips and tricks for your next DIY project.',
                'body' => "Planning a home renovation can be daunting. This article provides essential advice on everything from budgeting and project management to common pitfalls to avoid.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'The Importance of a Good Night\'\'s Sleep',
                'summary' => 'How sleep impacts your health and productivity.',
                'body' => "Sleep is often overlooked, but it is crucial for physical and mental well-being. Learn why sleep matters and how to improve your sleep hygiene for a better quality of life.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
            [
                'title' => 'Getting into Podcasting',
                'summary' => 'A guide for aspiring podcasters.',
                'body' => "Interested in starting your own podcast? This article walks you through the essential steps, from choosing a topic and recording equipment to editing and publishing your first episode.",
                'user_id' => 1,
                'author_name' => 'John Doe',
                'comments_count' => 0,
            ],
        ];
        
        foreach ($posts as $post) {
            $this->insert('posts', [$post]);
        }
    }
}
