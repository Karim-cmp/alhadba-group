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

    <!-- هنا يمكنك إضافة كود لعرض المراجعات السابقة -->
    <div id="reviews-list">
        <h4>المراجعات السابقة</h4>
        <div class="review">
            <p><strong>اسم المراجع:</strong> <span>مستخدم 1</span></p>
            <p><strong>التقييم:</strong> ★★★★★</p>
            <p>مراجعة رائعة! كانت تجربة رائعة.</p>
        </div>
        <div class="review">
            <p><strong>اسم المراجع:</strong> <span>مستخدم 2</span></p>
            <p><strong>التقييم:</strong> ★★★★☆</p>
            <p>كان كل شيء جيدًا، ولكن يمكن تحسين الخدمة.</p>
        </div>
        <!-- يمكنك إضافة المزيد من المراجعات هنا -->
    </div>
</section>

<style>
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
    