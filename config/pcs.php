<?php

return [
    /**
     * 未来図倉庫チームのID。
     */
    'team_id' => env('PCS_TEAM_ID', 1),

    /**
     * アップロードできる最大ファイルサイズ。MB。
     * S3に直接アップロードされるのでphp.iniやLambdaの制限とは無関係。
     */
    'max_upload' => 100,

    /**
     * アップロードできるファイルタイプ。
     */
    'mimes' => 'jpg,jpeg,png,mp3,mp4,zip',

    /**
     * 基本カテゴリー。
     * IDは本番環境に依存。
     */
    'category' => [
        [
            'id' => 10,
            'title' => '2Dモデル',
            'image' => '2d.png'
        ],
        [
            'id' => 11,
            'title' => '3Dモデル',
            'image' => '3d.png'
        ],
        [
            'id' => 12,
            'title' => 'BGM',
            'image' => 'BGM.png'
        ],
        [
            'id' => 13,
            'title' => 'たべもの',
            'image' => 'food.png'
        ],
        [
            'id' => 14,
            'title' => 'のりもの',
            'image' => 'vehicle.png'
        ],
        [
            'id' => 15,
            'title' => '音声素材',
            'image' => 'voice.png'
        ],
        [
            'id' => 16,
            'title' => '行事・イベント',
            'image' => 'event.png'
        ],
        [
            'id' => 17,
            'title' => '写真・背景',
            'image' => 'photo.png'
        ],
        [
            'id' => 18,
            'title' => '職業・仕事',
            'image' => 'work.png'
        ],
        [
            'id' => 19,
            'title' => '動物・植物',
            'image' => 'animal.png'
        ],
    ],
];
