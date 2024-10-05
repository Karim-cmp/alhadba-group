document.addEventListener("DOMContentLoaded", function() {
    const filterForm = document.getElementById('filter-form');
    const advancedFiltersToggle = document.getElementById('advanced-filters-toggle');
    const advancedFilters = document.getElementById('advanced-filters');

    // إدارة ظهور الفلاتر المتقدمة
    advancedFiltersToggle.addEventListener('click', function() {
        advancedFilters.classList.toggle('hidden');
        advancedFiltersToggle.innerText = advancedFilters.classList.contains('hidden') ? 'عرض الفلاتر المتقدمة' : 'إخفاء الفلاتر المتقدمة';
        advancedFilters.classList.toggle('fade-in'); // إضافة رسوم متحركة
    });

    // إرسال النموذج عند الضغط على زر البحث
    filterForm.addEventListener('submit', function(event) {
        event.preventDefault(); // منع الإرسال التلقائي للنموذج
        const formData = new FormData(filterForm);
        const queryParams = new URLSearchParams();

        // تحويل البيانات إلى سلسلة من استعلامات URL
        for (const pair of formData.entries()) {
            if (pair[1]) { // التأكد من أن القيمة ليست فارغة
                queryParams.append(pair[0], pair[1]);
            }
        }

        // إرسال الفلاتر عبر GET للبحث عن العقارات
        alert("جارٍ تحميل النتائج...");
        window.location.href = `search_results.php?${queryParams.toString()}`;
    });
});
