<?php

return [
    /**
     * 未来図倉庫チームのID。
     */
    'team_id' => env('PCS_TEAM_ID', 1),

    /**
     * ユーザー登録時の合言葉。正しく入力した場合のみ自動でチームに招待。
     */
    'team' => env('PCS_TEAM'),

    /**
     * お問い合わせメールの送信先。
     */
    'contact' => [
        'mail' => env('CONTACT_MAIL', env('MAIL_FROM_ADDRESS')),
        'subject' => env('CONTACT_SUBJECT', '【'.config('app.name').'】お問い合わせ'),
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
    'mimes' => 'jpg,png,webp,mp3,mp4,zip,vrm',

    /**
     * 基本カテゴリー。
     * IDは本番環境に依存。
     */
    'category' => [
        [
            'id' => 36,
            'title' => 'イラスト',
            'image' => '2d.png',
            'color' => 'text-[#9ed8f6]',
        ],
        [
            'id' => 38,
            'title' => '背景',
            'image' => 'bg.png',
            'color' => 'text-[#f7c8d5]',
        ],
        [
            'id' => 37,
            'title' => '写真',
            'image' => 'photo.png',
            'color' => 'text-[#f9ddad]',
        ],
        [
            'id' => 12,
            'title' => 'BGM',
            'image' => 'BGM.png',
            'color' => 'text-[#dbe8a7]',
        ],
        [
            'id' => 39,
            'title' => 'ボイス',
            'image' => 'voice.png',
            'color' => 'text-[#d4bad9]',
        ],
        [
            'id' => 40,
            'title' => '3D',
            'image' => '3d.png',
            'color' => 'text-[#c1e3de]',
        ],
        [
            'id' => 41,
            'title' => 'Live2D',
            'image' => 'live2d.png',
            'color' => 'text-[#f3a593]',
        ],
    ],

    /**
     * 季節カテゴリーのID.
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
