<?php
session_start();
require 'db_connection.php'; // تأكد من وجود هذا الملف للإتصال بقاعدة البيانات

// التحقق من الاتصال بقاعدة البيانات
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التحقق من وجود استعلام بحث
$search_query = '';
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

// جلب جميع العقارات من قاعدة البيانات (مع إمكانية البحث)
$sql = "SELECT * FROM properties WHERE title LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($sql);
$like_query = '%' . $search_query . '%';
$stmt->bind_param('ss', $like_query, $like_query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض العقارات</title>
    <link rel="stylesheet" href="styles.css"> <!-- تأكد من ربط ملف CSS لتنسيق الصفحة -->
</head>
<body>
    <header>
        <h1>عرض العقارات</h1>
        <form method="POST" action="">
            <input type="text" name="search" placeholder="ابحث عن عقار..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit">بحث</button>
        </form>
    </header>
    <div class="container">
        <?php if ($result->num_rows > 0): ?> <!-- إذا كان هناك عقارات -->
            <?php while ($row = $result->fetch_assoc()): ?> <!-- حلقة لجلب كل عقار -->
                <div class="property-card">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Property Image"> <!-- صورة العقار -->
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2> <!-- اسم العقار -->
                    <p><?php echo htmlspecialchars($row['description']); ?></p> <!-- وصف العقار -->
                    <p>السعر: <?php echo htmlspecialchars($row['price']); ?> جنيهاً</p> <!-- سعر العقار -->
                    <p>عدد الغرف: <?php echo htmlspecialchars($row['number_of_rooms']); ?></p> <!-- عدد الغرف -->
                    <p>عدد الحمامات: <?php echo htmlspecialchars($row['number_of_bathrooms']); ?></p> <!-- عدد الحمامات -->
                    <p>الموقع: <?php echo htmlspecialchars($row['location']); ?></p> <!-- الموقع -->
                    <a href="property_details.php?id=<?php echo $row['id']; ?>">عرض التفاصيل</a> <!-- رابط تفاصيل العقار -->
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>لا توجد عقارات لعرضها.</p> <!-- رسالة إذا لم يكن هناك عقارات -->
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$stmt->close(); // غلق الاستعلام
$conn->close(); // إغلاق الاتصال بقاعدة البيانات
?>
