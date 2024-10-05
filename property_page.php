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
        <button type="submit">إرسال المراجعة</button>
    </form>

    <div id="reviews-list">
        <h4>المراجعات السابقة</h4>
        <?php
        // جلب المراجعات السابقة
        $review_stmt = $conn->prepare("SELECT * FROM reviews WHERE property_id = ? ORDER BY created_at DESC");
        $review_stmt->bind_param("i", $property_id);
        $review_stmt->execute();
        $reviews_result = $review_stmt->get_result();

        if ($reviews_result->num_rows > 0) {
            while ($review = $reviews_result->fetch_assoc()) {
                echo '<div class="review">';
                echo '<p><strong>اسم المراجع:</strong> <span>' . htmlspecialchars($review['reviewer_name']) . '</span></p>';
                echo '<p><strong>التقييم:</strong> ' . str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) . '</p>';
                echo '<p>' . htmlspecialchars($review['review']) . '</p>';
                echo '<p><em>تاريخ: ' . htmlspecialchars($review['created_at']) . '</em></p>';
                echo '</div>';
            }
        } else {
            echo '<p>لا توجد مراجعات بعد.</p>';
        }

        $review_stmt->close();
        ?>
    </div>
</section>

<style>
    /* تنسيقات القسم التعليقات والمراجعات */
    #reviews {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    h3 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    #review-form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    textarea {
        resize: none;
        height: 100px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    textarea:focus {
        border-color: #007bff;
        outline: none;
    }

    select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    select:focus {
        border-color: #007bff;
        outline: none;
    }

    button {
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    #reviews-list {
        margin-top: 20px;
    }

    .review {
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    }

    .review p {
        margin: 5px 0;
    }
</style>
