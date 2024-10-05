<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];  // استلام رقم التليفون
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // الاتصال بقاعدة البيانات
    $conn = new mysqli('localhost', 'username', 'password', 'database');

    // التأكد من الاتصال بقاعدة البيانات
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // إغلاق الاتصال بقاعدة البيانات
    $conn->close();
}
?>
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
    $phone = $_POST['phone'];

    // التحقق من وجود المستخدم
    $sql_check = "SELECT * FROM users WHERE username = '$username'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows == 0) {
        $sql_insert = "INSERT INTO users (username, password, phone) VALUES ('$username', '$password', '$phone')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "تم إنشاء السجل بنجاح<br>";
        } else {
            echo "خطأ: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        echo "اسم المستخدم '$username' موجود بالفعل.<br>";
    }
}

$conn->close();
?>
