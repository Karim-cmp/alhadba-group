<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "alhadba_group";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "تسجيل دخول ناجح! مرحباً بك، " . $row['username'];
        } else {
            echo "كلمة المرور غير صحيحة.";
        }
    } else {
        echo "اسم المستخدم غير موجود.";
    }
}

$conn->close();
?>
<form action="login.php" method="POST">
    <label for="username">اسم المستخدم:</label>
    <input type="text" name="username" required><br>
    
    <label for="password">كلمة المرور:</label>
    <input type="password" name="password" required><br>
    
    <input type="submit" value="تسجيل الدخول">
</form>
<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            echo "تم تسجيل الدخول بنجاح.";
        } else {
            echo "كلمة المرور غير صحيحة.";
        }
    } else {
        echo "اسم المستخدم غير موجود.";
    }
}
?>
<form method="POST" action="">
    <input type="text" name="username" placeholder="اسم المستخدم" required>
    <input type="password" name="password" placeholder="كلمة المرور" required>
    <input type="submit" value="تسجيل الدخول">
</form>
