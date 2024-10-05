// قائمة لتخزين معرفات العقارات المقارنة
let comparisonList = [];

// وظيفة لإضافة العقار إلى قائمة المقارنة
function addToComparison(propertyId, propertyName) {
    // التحقق مما إذا كانت القائمة قد وصلت إلى الحد الأقصى
    if (comparisonList.length >= 3) {
        alert("لا يمكنك مقارنة أكثر من 3 عقارات.");
        return;
    }

    // التحقق مما إذا كان العقار موجودًا بالفعل في القائمة
    if (!comparisonList.some(item => item.id === propertyId)) {
        // إضافة العقار إلى القائمة
        comparisonList.push({ id: propertyId, name: propertyName });
        updateComparisonList();
    } else {
        alert("العقار موجود بالفعل في قائمة المقارنة.");
    }
}

// وظيفة لتحديث عرض قائمة المقارنة
function updateComparisonList() {
    const comparisonDisplay = document.getElementById('comparison-display');
    comparisonDisplay.innerHTML = ""; // تفريغ المحتوى الحالي

    // إضافة العقارات المضافة للقائمة إلى العرض
    comparisonList.forEach(item => {
        const listItem = document.createElement('li');
        listItem.textContent = item.name; // استخدام اسم العقار
        comparisonDisplay.appendChild(listItem);
    });
}

// وظيفة لمقارنة العقارات
function compareProperties() {
    if (comparisonList.length < 2) {
        alert("يرجى إضافة عقارين على الأقل للمقارنة.");
        return;
    }

    // عرض قائمة العقارات للمقارنة
    const propertyNames = comparisonList.map(item => item.name).join(', ');
    alert("مقارنة العقارات: " + propertyNames);

    // يمكنك استخدام AJAX لإرسال القائمة إلى السيرفر وعرض صفحة مقارنة
}

// مثال لاستخدام الدالة
// addToComparison(1, "عقار في الجيزة");
// addToComparison(2, "شقة في القاهرة");
// addToComparison(3, "فيلا في الإسكندرية");
