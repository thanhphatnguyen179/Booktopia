<?php 
include('../../../includes/db.php');

// Lấy giá trị tìm kiếm từ AJAX
$search = isset($_POST['search']) ? trim($_POST['search']) : "";

// Kiểm tra và xử lý giá trị tìm kiếm
$search = $connection->real_escape_string($search); // Tránh SQL Injection

// Truy vấn tìm kiếm
if ($search == "") {
    // Truy vấn tất cả sản phẩm khi ô tìm kiếm trống
    $sql = "
        SELECT 
    s.S_Ma, 
    s.S_Ten, 
    s.S_HinhAnh, 
    gny.GNY_DonGia,
    tg.TG_Ten,
    nxb.NXB_Ten,
    ncc.NCC_Ten,
    cd.CD_Ten
    
FROM 
    sach s 
JOIN 
    tacgia tg ON tg.TG_Ma = s.TG_Ma 
JOIN 
    nhaxuatban nxb ON nxb.NXB_Ma = s.NXB_Ma 
JOIN 
    nhacungcap ncc ON ncc.NCC_Ma = s.NCC_Ma 
JOIN 
    chude cd ON cd.CD_Ma = s.CD_Ma 
JOIN 
    gianiemyet gny ON gny.S_Ma = s.S_Ma  

WHERE 
    gny.GNY_NgayHieuLuc = (
        SELECT MAX(GNY_NgayHieuLuc)
        FROM gianiemyet g
        WHERE g.S_Ma = s.S_Ma
    ) 
    
ORDER BY 
    s.S_Ma DESC;

    ";
} else {
    // Tìm kiếm theo từ khóa
    $sql = "
        SELECT 
            s.S_Ma, 
            s.S_Ten, 
            s.S_HinhAnh, 
            gny.GNY_DonGia ,
            tg.TG_Ten,
            nxb.NXB_Ten,
            ncc.NCC_Ten,
            cd.CD_Ten
        FROM 
            sach s 
        JOIN 
            tacgia tg ON tg.TG_Ma = s.TG_Ma 
        JOIN 
            nhaxuatban nxb ON nxb.NXB_Ma = s.NXB_Ma 
        JOIN 
            nhacungcap ncc ON ncc.NCC_Ma = s.NCC_Ma 
        JOIN 
            chude cd ON cd.CD_Ma = s.CD_Ma 
        JOIN 
            gianiemyet gny ON gny.S_Ma = s.S_Ma  

        WHERE 
            gny.GNY_NgayHieuLuc = (
                SELECT MAX(GNY_NgayHieuLuc)
                FROM gianiemyet g
                WHERE g.S_Ma = s.S_Ma
            ) 

            AND (
                s.S_Ten LIKE '%" . $search . "%' 
                OR tg.TG_Ten LIKE '%" . $search . "%' 
                OR nxb.NXB_Ten LIKE '%" . $search . "%' 
                OR ncc.NCC_Ten LIKE '%" . $search . "%' 
                OR cd.CD_Ten LIKE '%" . $search . "%'
            )
        ORDER BY 
            s.S_Ma DESC;
    ";
}

$result = $connection->query($sql);

// Hiển thị kết quả
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $S_HinhAnh = $row['S_HinhAnh'];
        $DonGia = number_format($row['GNY_DonGia'], 0, ',', '.') . ' VND'; // Format price with VND
        echo '<a S_Ma href="#" data-id="'.$row['S_Ma'].'" class="dropdown-item" onclick=phieunhaphang_themsach('.'"' .  $row['S_Ma'].'"' .')>';

        echo '<div class="book-info">';  // Info về sách
        echo '<span class="book_id">' . htmlspecialchars($row['S_Ma']) . '</span>';
        echo '<img class="book-image" src="/booktopia/' . htmlspecialchars($S_HinhAnh) . '" alt="book">';
        echo '<span class="book-title">' . htmlspecialchars($row['S_Ten']) . '</span>';
        echo '</div>';

        echo '<div class="book-details">';  // Chi tiết sách
        echo '<span class="author">' . htmlspecialchars($row['TG_Ten']) . '</span>';
        echo '<span class="publisher">' . htmlspecialchars($row['NXB_Ten']) . '</span>';
        echo '<span class="supplier">' . htmlspecialchars($row['NCC_Ten']) . '</span>';
        echo '<span class="category">' . htmlspecialchars($row['CD_Ten']) . '</span>';
        echo '</div>';
        echo '<span class="price" s-dongia="' . htmlspecialchars($row['GNY_DonGia']) . '">' . $DonGia . '</span>';
        echo '</a>';
    }
} else {
    echo '<div class="dropdown-item text-muted">Không tìm thấy kết quả.</div>';
}

$connection->close();
?>
