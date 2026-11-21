<?php

return [

    // ルールごとのメッセージ
    'required' => ':attributeは必須です。',
    'integer' => ':attributeは整数で入力してください。',
    'email' => ':attributeは正しい形式で入力してください。',
    'date' => ':attributeは正しい日時を入力してください。',
    'exists' => '選択された:attributeは存在しません。',

    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
        'numeric' => ':attributeは:max以下で入力してください。',
    ],

    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。',
        'numeric' => ':attributeは:min以上で入力してください。',
    ],

    // 項目名（name 属性）の日本語名
    'attributes' => [
        'title' => 'タイトル',
        'content' => '本文',
        'category' => 'カテゴリー',
        'name' => '商品名',
        'price' => '価格',
        'stock' => '在庫数',
        'description' => '説明',
        'email' => 'メールアドレス',
        'number_of_people' => '人数',
        'reserved_at' => '日時',
        'event_id' => 'イベント',
    ],

];
