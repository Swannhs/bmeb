<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HomeSectionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'section_key' => 'marquee',
                'title'       => 'Marquee News',
                'type'        => 'html',
                'position'    => 'main',
                'content'     => '<p><a href="/p/69b63abc4c91bada4f8654f8"><span style="color:rgb(255,0,0);font-size:20px; font-weight: bold;">শিক্ষা প্রতিষ্ঠান, শিক্ষক-কর্মচারী ও ছাত্র-ছাত্রীদের আর্থিক অনুদানের আবেদন</span></a> <span style="color:rgb(255,0,0);font-size:20px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; দাখিল প্রাইভেট পরীক্ষা ২০২৬ এর রেজিস্ট্রেশন কার্ড বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড এর রেজিস্ট্রেশন শাখা( রুম নম্বর -২১০) থেকে সংগ্রহ করার জন্য সকল কেন্দ্র সচিব অথবা তার বৈধ প্রতিনিধি পাঠানোর জন্য নির্দেশক্রমে অনুরোধ করা হলো &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; দাখিল স্থাপনের অনুমতিপ্রাপ্ত মাদ্রাসার উদ্যোক্তা কমিটি’র আবেদন এখন থেকে অনলাইনে গ্রহণ করা হবে।</span></p>',
                'sort_order'  => 1,
            ],
            [
                'section_key' => 'notice_board',
                'title'       => 'নোটিশ বোর্ড',
                'type'        => 'widget',
                'position'    => 'main',
                'content'     => null,
                'sort_order'  => 2,
            ],
            [
                'section_key' => 'news_ticker',
                'title'       => 'খবর (Ticker)',
                'type'        => 'html',
                'position'    => 'main',
                'content'     => 'দাখিল পরীক্ষা-২০২৬ এর কেন্দ্রসচিবদের সাথে জুম মিটিং...',
                'sort_order'  => 3,
            ],
            [
                'section_key' => 'service_grid',
                'title'       => 'সেবা সমূহ',
                'type'        => 'list',
                'position'    => 'main',
                'content'     => json_encode([
                    [
                        'title' => 'অনলাইন সেবা',
                        'image' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/332b5cc9bd7e41919baac882453ef550.png',
                        'links' => [
                            ['label' => 'আলিম ২০২৫ এর ফলাফল', 'url' => 'https://ebmeb.gov.bd/erps_entry_forms/disp_res.php?exam=alm&year=2025', 'target' => '_blank'],
                            ['label' => 'ই ফাইলিং', 'url' => 'http://efiling.ebmeb.gov.bd/index.php/eservice/', 'target' => '_blank'],
                            ['label' => 'EIIN সিম উত্তোলন', 'url' => 'http://efiling.ebmeb.gov.bd/index.php/eiinsim/', 'target' => '_blank'],
                            ['label' => 'পুরাতন ওয়েবসাইট', 'url' => 'http://bmeb.ebmeb.gov.bd/', 'target' => '_blank'],
                        ]
                    ],
                    [
                        'title' => 'অভ্যন্তরীণ ই-সেবা',
                        'image' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/9af460720442472b89b4961b30b474d5.png',
                        'links' => [
                            ['label' => 'e-SIF / e-FF', 'url' => 'http://www.ebmeb.gov.bd/', 'target' => '_blank'],
                            ['label' => 'পরীক্ষক তালিকা', 'url' => 'https://tinyurl.com/ebt25examiner', 'target' => '_blank'],
                            ['label' => 'রেজিস্ট্রেশন কার্ড সংশোধন', 'url' => 'https://ebmeb.gov.bd/', 'target' => '_blank'],
                            ['label' => 'বৃত্তি পরীক্ষার ফলাফল', 'url' => 'https://ebmeb.gov.bd/', 'target' => '_blank'],
                        ]
                    ],
                    [
                        'title' => 'শুদ্ধাচার ও সুশাসন',
                        'image' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/70e479c5bd4345a99d6d48ea9afefde4.png',
                        'links' => [
                            ['label' => 'শুদ্ধাচার কৌশল কর্মপরিকল্পনা', 'url' => '/p/691997b9933eb65569dde769'],
                            ['label' => 'ফোকাল পয়েন্ট কর্মকর্তা', 'url' => '/p/691997bc933eb65569ddea7d'],
                            ['label' => 'মূল্যায়ন প্রতিবেদন', 'url' => '/p/691997b1933eb65569dde10f'],
                        ]
                    ],
                    [
                        'title' => 'এসডিজি',
                        'image' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/51b80884ec7a47a1b829b608398b837b.png',
                        'links' => [
                            ['label' => 'জাতীয় দলিল', 'url' => '/p/691997a8933eb65569ddd91a'],
                            ['label' => 'এসডিজি সংক্রান্ত জিও', 'url' => '/p/691997ba933eb65569dde899'],
                            ['label' => 'কর্মপরিকল্পনা', 'url' => '/p/691997ba933eb65569dde899'],
                        ]
                    ],
                ]),
                'sort_order'  => 4,
            ],
            [
                'section_key' => 'chairman',
                'title'       => 'চেয়ারম্যান',
                'type'        => 'widget',
                'position'    => 'right',
                'content'     => json_encode([
                    'name'  => 'প্রফেসর মিঞা মোঃ নূরুল হক',
                    'image' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/cfeb055b2afb45a393c4d3c93d958c08.jpg',
                    'link'  => '/p/691997d1933eb65569ddf6e4'
                ]),
                'sort_order'  => 5,
            ],
            [
                'section_key' => 'important_links',
                'title'       => 'গুরুত্বপূর্ণ লিঙ্ক',
                'type'        => 'list',
                'position'    => 'right',
                'content'     => json_encode([
                    ['label' => 'BANBEIS', 'url' => 'http://www.moedu.gov.bd/index.php?option=com_weblinks&task=view&catid=1&id=24', 'target' => '_blank'],
                    ['label' => 'শিক্ষক বাতায়ন', 'url' => 'https://www.teachers.gov.bd/', 'target' => '_blank'],
                    ['label' => 'শিক্ষা মন্ত্রণালয়', 'url' => 'http://www.moedu.gov.bd/', 'target' => '_blank'],
                    ['label' => 'ডায়াবেটিস ও কোভিড-১৯', 'url' => 'https://diabetes-covid19.org/', 'target' => '_blank'],
                ]),
                'sort_order'  => 6,
            ],
            [
                'section_key' => 'hotline',
                'title'       => 'জরুরি হটলাইন',
                'type'        => 'widget',
                'position'    => 'right',
                'content'     => json_encode([
                    'image' => '/site-assets/images/hotline_bn.png',
                    'url'   => 'https://bangladesh.gov.bd/site/page/aaebba14-f52a-4a3d-98fd-a3f8b911d3d9'
                ]),
                'sort_order'  => 7,
            ],
        ];

        foreach ($data as $item) {
            $this->db->table('home_sections')->insert($item);
        }
    }
}
