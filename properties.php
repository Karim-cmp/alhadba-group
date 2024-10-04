<?php
session_start();
require 'db_connection.php'; // تأكد من وجود هذا الملف للإتصال بقاعدة البيانات

// جلب جميع العقارات من قاعدة البيانات
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);
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
    </header>
    <div class="container">
        <?php if ($result->num_rows > 0): ?> <!-- إذا كان هناك عقارات -->
            <?php while ($row = $result->fetch_assoc()): ?> <!-- حلقة لجلب كل عقار -->
                <div class="property-card">
                    <img src="<?php echo $row['image_url']; ?>" alt="Property Image"> <!-- صورة العقار -->
                    <h2><?php echo $row['property_name']; ?></h2> <!-- اسم العقار -->
                    <p><?php echo $row['description']; ?></p> <!-- وصف العقار -->
                    <p>السعر: <?php echo $row['price']; ?></p> <!-- سعر العقار -->
                    <p>عدد الغرف: <?php echo $row['number_of_rooms']; ?></p> <!-- عدد الغرف -->
                    <p>عدد الحمامات: <?php echo $row['number_of_bathrooms']; ?></p> <!-- عدد الحمامات -->
                    <a href="property_details.php?id=<?php echo $row['id']; ?>">عرض التفاصيل</a> <!-- رابط تفاصيل العقار -->
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>لا توجد عقارات لعرضها.</p> <!-- رسالة إذا لم يكن هناك عقارات -->
        <?php endif; ?>
    </div>
</body>
</html>
