<?php

return [
    /**
     * 未来図倉庫チームのID。
     */
    'team_id' => env('PCS_TEAM_ID', 1),

    /**
     * お問い合わせメールの送信先。
     */
    'contact' => [
        'mail' => env('CONTACT_MAIL'),
    ],

    /**
     * アップロードできる最大ファイルサイズ。MB。
     * S3に直接アップロードされるのでphp.iniやLambdaの制限とは無関係。
     */
    'max_upload' => 100,

    /**
     * 動作確認済のファイルタイプ。
     * VRMなどマイナーなファイルに対応するため、この設定に関わらずどんなファイルでもアップロードはできるけどサムネイルの表示やダウンロード時の動作は保障しない、という形。
     * VRMは強引に対応。他のファイルはアップロード時の拡張子とダウンロード時の拡張子が変わるかもしれない。
     */
    'mimes' => 'jpg,png,mp3,mp4,zip,vrm',

    /**
     * 基本カテゴリー。
     * IDは本番環境に依存。
     */
    'category' => [
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
            'id' => 19,
            'title' => '動物・植物',
            'image' => 'animal.png'
        ],
        [
            'id' => 18,
            'title' => '職業・仕事',
            'image' => 'work.png'
        ],
        [
            'id' => 15,
            'title' => '音声素材',
            'image' => 'voice.png'
        ],
        [
            'id' => 12,
            'title' => 'BGM',
            'image' => 'BGM.png'
        ],
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
    ],

    /**
     * 季節カテゴリーのID
     */
    'months' => [
        [
            'id' => 21,
        ],
        [
            'id' => 22,
        ],
        [
            'id' => 23,
        ],
        [
            'id' => 24,
        ],
        [
            'id' => 25,
        ],
        [
            'id' => 26,
        ],
        [
            'id' => 27,
        ],
        [
            'id' => 28,
        ],
        [
            'id' => 29,
        ],
        [
            'id' => 30,
        ],
        [
            'id' => 31,
        ],
        [
            'id' => 32,
        ],
    ],
];
