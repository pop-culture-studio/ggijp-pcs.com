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
        [
            'id' => 0,
            'title' => 'その他',
            'image' => 'other.png',
            'color' => 'indigo-500',
            'text' => 'text-indigo-500',
            'bg' => 'bg-indigo-500',
            'ring' => 'ring-indigo-500',
        ],
    ],

    'keywords' => [
        'イラスト' => [
            '人物', '男性', '女性', '大人', '子供', '老人',
            '職業', '現代', 'ファンタジー', '時代劇',
            '芸能', '学生', '社会人', '美形', '医療', 'サービス業',
            '家族', '家庭', '学校', '会社', '福祉', '芸術',
        ],
        '背景' => [
            '背景', '風景', '景色', '写真', '都会', '田舎', '花',
            '街中', '住宅街', 'ビジネス街', 'ショッピング', '公園',
            '虫', '生活', 'お店', '飲み屋', '喫茶店', '乗り物',
            '自然', '日本', '海外', 'ヨーロッパ', 'アジア',
            'アミューズメント', '施設', '昼', '夜景', '交通', '旅行',
        ],
        '写真' => [
            '風景', '動物', '昆虫', '虫', '鳥', '野鳥', '野生',
            '自然', '花', 'トカゲ', '猫', '水辺', '森林',
            '空', '景色', '都会', '街中', '住宅街',
            '公園', '乗り物', '日本', '昼', '夜景',
        ],
        'BGM' => [
            'ショート', 'ロング', 'ポップ', 'ロック', 'クラシック',
            'エレクトロニカ', 'R＆B', 'ジャズ', 'レゲェ', 'EDM',
            'ラテン', '民族', 'ニューエイジ', 'インストゥルメンタル',
            '明るい', '暗い', 'アップテンポ', 'スローテンポ',
            '激しい', '穏やか',
        ],
        'ボイス' => [
            '挨拶', '返事', 'リアクション', '笑い', '泣き', '怒り',
            '感謝', '謝罪', '喜び', '悲しみ', 'ハッピー', '叫び',
            '絶叫', '友人', '恋人', '大人', '子供', '老人', '男', '女',
            'アニメ', '萌え', 'イケボ', '美声', '癒し', 'クール',
        ],
        '3D' => [
            '道具', '3D', '武器', '家具', '建物', 'キャンプ', '飲み物',
            'アウトドア', '家電', 'デジタル', 'アクセサリー', '小物',
            '食べ物', '乗り物',
        ],
        'Live2D' => [
            'アバター', '配信', 'Vtuber', '男', '女', '学生', '大人',
            'ゆるかわ', '動物', '自然',
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
