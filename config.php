<?php

// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=db;dbname=learning_plan;charset=utf8');
define('USER', 'admin_user');
define('PASSWORD', '1234');

// エラーメッセージを定数として定義
define('MSG_TITLE_REQUIRED', 'タスク名を入力してください');
define('MSG_TITLE_NO_CHANGE', 'タスク名が変更されていません');

// ステータスを定数として定義
define('PLANS_DAY', NULL);
define('DONE_PLANS_DAY', '');