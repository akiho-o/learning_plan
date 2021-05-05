<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/config.php';

$title = '';
$errors = [];
$due_date = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームに入力されたデータを受け取る
    $title = filter_input(INPUT_POST, 'title');
    // バリデーション
    $errors = insertValidate($title);
    // エラーチェック
    if (empty($errors)) {
        // タスク登録処理の実行
        insertTask($title);
    }
}

// 未完了タスクの取得
$incomplete_plans = plansDay(PLANS_DAY);

// 完了タスクの取得
$done_plans = donePlansDay(DONE_PLANS_DAY);

?>


<!DOCTYPE html>
<html lang="ja">
<!-- _head.phpの読み込み -->
<?php include_once __DIR__ . '/_head.html' ?>
<body>
    <div class="wrapper">
        <h1 class="title">学習管理アプリ</h1>
        <div class="form-area">
            <!-- エラー表示 -->
            <form action="" method="post">
                <label for="title">学習内容</label>
                <input type="text" name="title">
                <label for="due_date">期限日</label>
                <input type="date" name="due_date">
                <input type="submit" class="btn submit-btn" value="追加">
            </form>
        </div>
        <div class="incomplete-area">
            <h2 class="sub-title">未達成</h2>
            <table class="plan-list">
                <thead>
                    <th class="plan-title">学習内容</th>
                    <th class="plan-due-date">完了期限</th>
                    <th class="done-link-area"></th>
                    <th class="edit-link-area"></th>
                    <th class="delete-link-area"></th>
                </thead>
                <tbody>
                    <?php foreach ($incomplete_plans as $plan): ?>
                    <tr>
                        <!-- 未完了のデータを表示 -->
                        <td><?= h($plan['title']) ?></td>
                        <td><?= h($plan['due_date']) ?></td>
                        <td class="btn done">完了</td>
                        <td class="btn edit">編集</td>
                        <td class="btn delete">削除</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="complete-area">
            <h2 class="sub-title">完了</h2>
            <table class="plan-list">
                <thead>
                    <tr>
                        <th class="plan-title">学習内容</th>
                        <th class="plan-completion-date">完了日</th>
                        <th class="done-link-area"></th>
                        <th class="edit-link-area"></th>
                        <th class="delete-link-area"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($done_plans as $plan): ?>
                    <!-- 完了済のデータを表示 -->
                    <td><?= h($plan['title']) ?></td>
                    <td><?= h($plan['completion_date']) ?></td>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>