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
        <!-- هنا يمكنك إضافة كود لعرض المراجعات السابقة -->
    </div>
</section>
document.addEventListener("DOMContentLoaded", function() {
    const chatBox = document.getElementById('chat-box');
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const messagesContainer = document.getElementById('messages');

    messageForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        const messageText = messageInput.value; 

        if (messageText.trim() !== '') { 
            const newMessage = document.createElement('div'); 
            newMessage.className = 'message user-message'; 
            newMessage.innerText = messageText; 
            messagesContainer.appendChild(newMessage); 
            animateMessage(newMessage);

            setTimeout(() => {
                const adminMessage = document.createElement('div'); 
                adminMessage.className = 'message admin-message'; 
                adminMessage.innerText = 'شكراً لتواصلك معنا. سنعود إليك قريبًا.'; 
                messagesContainer.appendChild(adminMessage); 
                animateMessage(adminMessage);
            }, 1000); 

            messageInput.value = ''; 
        }
    });

    function animateMessage(messageElement) {
        messageElement.classList.add('fade-in'); // إضافة الرسوم المتحركة
        setTimeout(() => {
            messageElement.classList.remove('fade-in');
        }, 500); // مدة الرسوم المتحركة
    }
});
let comparisonList = [];

// إضافة عقار إلى قائمة المقارنة
function addToComparison(propertyId, propertyName) {
    if (comparisonList.length >= 3) {
        alert("لا يمكنك مقارنة أكثر من 3 عقارات.");
        return;
    }

    if (!comparisonList.includes(propertyId)) {
        comparisonList.push(propertyId);
        updateComparisonList();
    } else {
        alert("العقار موجود بالفعل في قائمة المقارنة.");
    }
}

// تحديث قائمة المقارنة
function updateComparisonList() {
    const comparisonBox = document.getElementById('comparison-box');
    comparisonBox.innerHTML = '';

    comparisonList.forEach(propertyId => {
        const propertyElement = document.createElement('div');
        propertyElement.className = 'comparison-item';
        propertyElement.innerText = `عقار ID: ${propertyId}`;

        const removeButton = document.createElement('button');
        removeButton.innerText = 'إزالة';
        removeButton.onclick = function() {
            if (confirm("هل تريد إزالة هذا العقار من قائمة المقارنة؟")) {
                comparisonList = comparisonList.filter(id => id !== propertyId);
                updateComparisonList();
            }
        };

        propertyElement.appendChild(removeButton);
        comparisonBox.appendChild(propertyElement);
    });

    document.getElementById('compare-button').style.display = comparisonList.length > 0 ? 'block' : 'none';
}
document.addEventListener("DOMContentLoaded", function() {
    const filterForm = document.getElementById('filter-form');
    const advancedFiltersToggle = document.getElementById('advanced-filters-toggle');
    const advancedFilters = document.getElementById('advanced-filters');

    advancedFiltersToggle.addEventListener('click', function() {
        advancedFilters.classList.toggle('hidden');
        advancedFiltersToggle.innerText = advancedFilters.classList.contains('hidden') ? 'عرض الفلاتر المتقدمة' : 'إخفاء الفلاتر المتقدمة';
        advancedFilters.classList.toggle('fade-in'); // إضافة رسوم متحركة
    });

    filterForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(filterForm);
        const queryParams = new URLSearchParams();
        for (const pair of formData.entries()) {
            queryParams.append(pair[0], pair[1]);
        }

        // إرسال الفلاتر عبر GET للبحث عن العقارات
        alert("جارٍ تحميل النتائج...");
        window.location.href = `search_results.php?${queryParams.toString()}`;
    });
});
#reviews {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#review-form textarea {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.submit-button {
    background-color: #007BFF;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.submit-button:hover {
    background-color: #0056b3;
}

.message {
    margin: 10px 0;
    padding: 10px;
    border-radius: 4px;
    opacity: 0;
    transition: opacity 0.5s;
}

.user-message {
    background-color: #d1ecf1;
    align-self: flex-end;
}

.admin-message {
    background-color: #f8d7da;
    align-self: flex-start;
}

.fade-in {
    opacity: 1 !important;
}

#comparison-box {
    border: 1px solid #007BFF;
    border-radius: 8px;
    padding: 10px;
}

.comparison-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 5px 0;
}

.hidden {
    display: none;
}
