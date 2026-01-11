<?php
// login.php - Admin Login
require 'conn.php';
$msg = ""; $msg_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_user = trim($_POST['username']);
    $input_pass = trim($_POST['password']);
    $input_code = trim($_POST['captcha']);
    
    if (empty($_SESSION['captcha']) || $input_code != $_SESSION['captcha']) {
        $msg = "验证码错误"; $msg_type = "error";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin'");
        $stmt->execute([$input_user]);
        $user = $stmt->fetch();

        if ($user && password_verify($input_pass, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $user['username'];
            unset($_SESSION['captcha']);
            header("Location: admin.php");
            exit;
        } else {
            $msg = "账号或密码错误"; $msg_type = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台登录</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Alive.SYS 管理后台</h1>
        </div>
        <?php if(!empty($msg)): ?>
            <div class="mb-4 p-3 rounded text-sm text-center <?php echo $msg_type=='error'?'bg-red-100 text-red-700':'bg-green-100 text-green-700';?>"><?php echo $msg; ?></div>
        <?php endif; ?>
        <form method="POST" class="space-y-6">
            <div><label class="block text-sm font-medium mb-1">账号</label><input type="text" name="username" required class="w-full px-4 py-3 rounded border focus:ring-2 focus:ring-blue-500 outline-none"></div>
            <div><label class="block text-sm font-medium mb-1">密码</label><input type="password" name="password" required class="w-full px-4 py-3 rounded border focus:ring-2 focus:ring-blue-500 outline-none"></div>
            <div><label class="block text-sm font-medium mb-1">验证码</label><div class="flex items-center gap-3"><input type="text" name="captcha" required maxlength="4" class="w-full px-4 py-3 rounded border outline-none"><img src="captcha.php" onclick="this.src='captcha.php?'+Math.random()" class="h-12 border rounded cursor-pointer"></div></div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded transition">登录</button>
        </form>
    </div>
</body>
</html>
