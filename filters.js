<form id="filter-form">
    <div class="filter-group">
        <label for="location">الموقع:</label>
        <input type="text" id="location" name="location" placeholder="أدخل الموقع" required>
    </div>
    <div class="filter-group">
        <label for="price-range">نطاق السعر:</label>
        <input type="number" id="min-price" name="min-price" placeholder="الحد الأدنى" min="0">
        <input type="number" id="max-price" name="max-price" placeholder="الحد الأقصى" min="0">
    </div>
    
    <button type="button" id="advanced-filters-toggle">عرض الفلاتر المتقدمة</button>
    
    <div id="advanced-filters" class="hidden">
        <div class="filter-group">
            <label for="bedrooms">عدد الغرف:</label>
            <select id="bedrooms" name="bedrooms">
                <option value="">--اختر--</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4+</option>
            </select>
        </div>
        <div class="filter-group">
            <label for="property-type">نوع العقار:</label>
            <select id="property-type" name="property-type">
                <option value="">--اختر--</option>
                <option value="apartment">شقة</option>
                <option value="villa">فيلا</option>
                <option value="commercial">تجاري</option>
            </select>
        </div>
    </div>

    <button type="submit">بحث</button>
</form>
