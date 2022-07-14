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
            'color' => '2d',
            'text' => 'text-2d',
            'bg' => 'bg-2d',
            'ring' => 'ring-2d',
        ],
        [
            'id' => 38,
            'title' => '背景',
            'image' => 'bg.png',
            'color' => 'bg',
            'text' => 'text-bg',
            'bg' => 'bg-bg',
            'ring' => 'ring-bg',
        ],
        [
            'id' => 37,
            'title' => '写真',
            'image' => 'photo.png',
            'color' => 'photo',
            'text' => 'text-photo',
            'bg' => 'bg-photo',
            'ring' => 'ring-photo',
        ],
        [
            'id' => 12,
            'title' => 'BGM',
            'image' => 'BGM.png',
            'color' => 'bgm',
            'text' => 'text-bgm',
            'bg' => 'bg-bgm',
            'ring' => 'ring-bgm',
        ],
        [
            'id' => 39,
            'title' => 'ボイス',
            'image' => 'voice.png',
            'color' => 'voice',
            'text' => 'text-voice',
            'bg' => 'bg-voice',
            'ring' => 'ring-voice',
        ],
        [
            'id' => 40,
            'title' => '3D',
            'image' => '3d.png',
            'color' => '3d',
            'text' => 'text-3d',
            'bg' => 'bg-3d',
            'ring' => 'ring-3d',
        ],
        [
            'id' => 41,
            'title' => 'Live2D',
            'image' => 'live2d.png',
            'color' => 'live2d',
            'text' => 'text-live2d',
            'bg' => 'bg-live2d',
            'ring' => 'ring-live2d',
        ],
    ],

    /**
     * text-{{ $material->categoryColor }}などで使うカラー。ここに書いてビルド後のcssファイルに含まれるようにする。
     */
    'colors' => [
        'text-indigo-500',
        'bg-indigo-500',
        'ring-indigo-500',
    ],
];
