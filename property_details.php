<?php
session_start();
require 'db_connection.php';

// استلام معرف العقار من الرابط
$property_id = intval($_GET['id']);

// جلب بيانات العقار المحدد
$stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();
$property = $result->fetch_assoc();
$stmt->close();

if (!$property) {
    echo "عقار غير موجود.";
    exit;
}

// جلب المراجعات السابقة
$review_stmt = $conn->prepare("SELECT * FROM reviews WHERE property_id = ? ORDER BY created_at DESC");
$review_stmt->bind_param("i", $property_id);
$review_stmt->execute();
$reviews_result = $review_stmt->get_result();
$reviews = $reviews_result->fetch_all(MYSQLI_ASSOC);
$review_stmt->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($property['property_name']); ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- تأكد من ربط ملف CSS -->
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($property['property_name']); ?></h1>
    </header>
    <div class="container">
        <img src="<?php echo htmlspecialchars($property['image_url']); ?>" alt="Property Image">
        <p><?php echo htmlspecialchars($property['description']); ?></p>
        <p>السعر: <?php echo htmlspecialchars($property['price']); ?></p>
        <p>عدد الغرف: <?php echo htmlspecialchars($property['number_of_rooms']); ?></p>
        <p>عدد الحمامات: <?php echo htmlspecialchars($property['number_of_bathrooms']); ?></p>
    </div>

    <section id="reviews">
        <h3>التعليقات والمراجعات</h3>
        <form id="review-form" action="submit_review.php" method="POST">
            <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
            <textarea name="review" placeholder="اكتب مراجعتك هنا..." required></textarea>
            <select name="rating" required>
                <option value="">اختر تقييمًا</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit" class="submit-button">إرسال المراجعة</button>
        </form>
        <div id="previous-reviews">
            <?php if (count($reviews) > 0): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <p><strong>التقييم: <?php echo htmlspecialchars($review['rating']); ?></strong></p>
                        <p><?php echo htmlspecialchars($review['review']); ?></p>
                        <p><em>تاريخ: <?php echo htmlspecialchars($review['created_at']); ?></em></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>لا توجد مراجعات بعد.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
