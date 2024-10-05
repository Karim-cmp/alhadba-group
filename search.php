<form method="GET" action="">
    <input type="text" name="query" placeholder="بحث عن عقار">
    <input type="submit" value="بحث">
</form>

<?php
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $conn->prepare("SELECT * FROM properties WHERE name LIKE ?");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($property = $result->fetch_assoc()) {
        echo $property['name'] . "<br>";
    }
}
?>
