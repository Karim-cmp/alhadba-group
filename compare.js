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
    comparisonBox.innerHTML = ''; // إعادة تعيين المحتوى

    comparisonList.forEach(propertyId => {
        const propertyElement = document.createElement('div');
        propertyElement.className = 'comparison-item';
        propertyElement.innerText = `عقار ID: ${propertyId}`;
        comparisonBox.appendChild(propertyElement);
    });

    // إظهار أو إخفاء زر المقارنة بناءً على عدد العناصر
    document.getElementById('compare-button').style.display = comparisonList.length > 0 ? 'block' : 'none';
}

// مقارنة العقارات
function compareProperties() {
    if (comparisonList.length < 2) {
        alert("يرجى إضافة عقارين على الأقل للمقارنة.");
        return;
    }

    alert("مقارنة العقارات: " + comparisonList.join(', '));
    // يمكنك استخدام AJAX لإرسال القائمة إلى السيرفر وعرض صفحة مقارنة
}
